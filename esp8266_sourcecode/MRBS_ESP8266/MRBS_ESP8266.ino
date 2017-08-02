#include "PIRWiFiClient.h"
#include "ESPWebServerConfiguaration.h"
#include "EEPROMHelper.h"
#include <Ticker.h>
#include "DebugDefine.h"
#include "FlagType.h"
#include "Define.h"

byte numOfSensor = 3;
byte *pinNum;

ESPWebServerConfiguaration *espServer;
PIRWiFiClient *pirWifiClient;

Ticker sendStatusTicker;
Ticker readSensorTicker;
volatile bool flagAllowSend = false;
volatile bool flagAllowRead = false;
volatile FlagButtonAPMode_t flagButtonAPMode = NOT_IN_AP_MODE;
volatile FlagButtonBreaktime_t flagButtonBreaktime = NOT_IN_BREAKTIME_MODE;
volatile unsigned long lastDebounceTime = 0;

void setup()
{
    EEPROMHelper eHelper;

    EEPROM.begin(EEPROM_SIZE);
    Serial.begin(SERIAL_BAURATE);
    delay(TIME_100MS);
    SERIAL_DEBUG_PRINTLN("\n\nBegin");

    SERIAL_DEBUG_PRINTLN("\nAll configuaration valid or invalid in EEPROM:");
    espServer->printConfigInfoFromEEPROM();

    initPIRPin();
    pirWifiClient = new PIRWiFiClient(numOfSensor, pinNum);
    espServer = new ESPWebServerConfiguaration();

    SERIAL_DEBUG_PRINTLN("\nSet valid configuaration info in EEPROM:");
    setConfigInfoFromEEPROM();

    pirWifiClient->doConnectWiFi();
    espServer->webServerStop();

    delay(TIME_500MS);
    configButtonTurnAPMode();
    configButtonTurnBreaktime();
    configLedAlertBreaktime();

    readSensorTicker.attach(SEQ_TIME_READ_SEC, timerReadHandler);
    sendStatusTicker.attach(SEQ_TIME_SEND_SEC, timerSendHandler);
}

void initPIRPin()
{
    pinNum = new byte[numOfSensor];
    pinNum[0] = PIR1_PIN;
    pinNum[1] = PIR2_PIN;
    pinNum[2] = PIR3_PIN;
}

void configButtonTurnAPMode()
{
    pinMode(TURN_AP_MODE_BUTTON_PIN, INPUT);
    attachInterrupt(digitalPinToInterrupt(TURN_AP_MODE_BUTTON_PIN), buttonTurnAPModeHandler, RISING);
}

void buttonTurnAPModeHandler()
{
    if (millis() - lastDebounceTime > DEBOUNCE_DELAY_IN_MS)
    {
        if (flagButtonAPMode == IN_AP_MODE)
        {
            digitalWrite(ALERT_LED_PIN, LED_OFF);
            flagButtonAPMode = TURN_OFF_AP_MODE;
        }
        else if (flagButtonAPMode == NOT_IN_AP_MODE)
        {
            digitalWrite(ALERT_LED_PIN, LED_ON);
            flagButtonAPMode = TURN_ON_AP_MODE;
        }
    }
    lastDebounceTime = millis();
}

void configButtonTurnBreaktime()
{
    pinMode(TURN_BREAKTIME_BUTTON_PIN, INPUT);
    attachInterrupt(digitalPinToInterrupt(TURN_BREAKTIME_BUTTON_PIN), buttonTurnBreaktimeHandler, RISING);
}

void configLedAlertBreaktime()
{
    pinMode(BREAKTIME_LED_PIN, OUTPUT);
    digitalWrite(BREAKTIME_LED_PIN, LED_BREAKTIME_OFF);
}

void buttonTurnBreaktimeHandler()
{
    if (millis() - lastDebounceTime > DEBOUNCE_DELAY_IN_MS)
    {
        if (flagButtonBreaktime == IN_BREAKTIME_MODE)
        {
            digitalWrite(BREAKTIME_LED_PIN, LED_BREAKTIME_OFF);
            flagButtonBreaktime = NOT_IN_BREAKTIME_MODE;
            SERIAL_DEBUG_PRINTLN("\n>>> Exit breaktime mode");
        }
        else
        {
            digitalWrite(BREAKTIME_LED_PIN, LED_BREAKTIME_ON);
            flagButtonBreaktime = IN_BREAKTIME_MODE;
            SERIAL_DEBUG_PRINTLN("\n>>> Enter breaktime mode");
        }
    }
    lastDebounceTime = millis();
}

void timerReadHandler()
{
    flagAllowRead = true;
}

void timerSendHandler()
{
    flagAllowSend = true;
}

/*--------------------------------------------------*
  ---------------------LOOP-------------------------
 *--------------------------------------------------*/
void loop()
{
    bool sensorStatusAtNow;
    static byte oldSensorStatus;
    static String breaktimeValue;

    switch (flagButtonAPMode)
    {
    case TURN_ON_AP_MODE:
    {
        espServer->webServerBegin();
        flagButtonAPMode = IN_AP_MODE;
        break;
    }

    case TURN_OFF_AP_MODE:
    {
        espServer->webServerStop();
        flagButtonAPMode = NOT_IN_AP_MODE;
        break;
    }

    default:
        break;
    }

    if (flagAllowRead)
    {
        pirWifiClient->readAllSensorStatus();
        sensorStatusAtNow = (bool)pirWifiClient->getGeneralStatus();
        if (sensorStatusAtNow == EXIST_HUMAN)
            SERIAL_DEBUG_PRINTLN("Maybe exist human right now");
        else
            SERIAL_DEBUG_PRINTLN("Not exist human right now");
        addToOldStatus(&oldSensorStatus, sensorStatusAtNow);
        flagAllowRead = false;
        SERIAL_DEBUG_PRINTF("Old status code: %d\n", oldSensorStatus);

        breaktimeValue = (flagButtonBreaktime == IN_BREAKTIME_MODE) ? "true" : "false";
        SERIAL_DEBUG_PRINT("Breaktime value: ");
        SERIAL_DEBUG_PRINTLN(breaktimeValue);
    }

    if (flagAllowSend && WiFi.isConnected())
    {
        SERIAL_DEBUG_PRINTLN("\nWifi is connecting");
        if (pirWifiClient->connectAndSendDataToServer(oldSensorStatus, breaktimeValue) == FAIL)
        {
            delay(TIME_5SEC);
            pirWifiClient->connectAndSendDataToServer(oldSensorStatus, breaktimeValue);
        }
        flagAllowSend = false;
    }
    espServer->handlClient();
    delay(TIME_200MS);
}
/*--------------------------------------------------*
  --------------------------------------------------
 *--------------------------------------------------*/

void addToOldStatus(byte *oldSensorStatus, bool sensorStatusAtNow)
{
    *oldSensorStatus = (byte)(((*oldSensorStatus) << 1) | (byte)sensorStatusAtNow);
}

void setConfigInfoFromEEPROM()
{
    pirWifiClient->setMRBSConfigInfoFromEEPROM();
    pirWifiClient->setSTAConfigInfoFromEEPROM();
    espServer->setAPConfigInfoFromEEPROM();
}
