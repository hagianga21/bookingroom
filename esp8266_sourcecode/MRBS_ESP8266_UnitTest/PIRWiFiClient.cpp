#include "PIRWiFiClient.h"

extern volatile FlagButtonBreaktime_t flagButtonBreaktime;

PIRWiFiClient::PIRWiFiClient()
{
}

PIRWiFiClient::PIRWiFiClient(byte _numOfSensor, byte *_pinNum) : PIR(_numOfSensor, _pinNum)
{
    this->staConfigInfo = new STANetworkConfigInfo();
    pinMode(ALERT_LED_PIN, OUTPUT);
    digitalWrite(ALERT_LED_PIN, LED_OFF);
}

void PIRWiFiClient::setMRBSConfigInfo(MRBSConfigInfo _mrbsConfigInfo)
{
    this->mrbsConfigInfo = _mrbsConfigInfo;
}

void PIRWiFiClient::setMRBSConfigInfoFromEEPROM()
{
    mrbsConfigInfo.setMRBSConfigInfoFromEEPROMIfExist();
}

void PIRWiFiClient::setSTAConfigInfo(NetworkConfigInfo *_staConfigInfo)
{
    this->staConfigInfo = new STANetworkConfigInfo(_staConfigInfo->getSSID(), _staConfigInfo->getPassword());
}

void PIRWiFiClient::setSTAConfigInfoFromEEPROM()
{
    staConfigInfo->setNetworkConfigInfoFromEEPROMIfExist();
}

MRBSConfigInfo PIRWiFiClient::getMRBSConfigInfo()
{
    return this->mrbsConfigInfo;
}

NetworkConfigInfo *PIRWiFiClient::getSTAConfigInfo()
{
    return this->staConfigInfo;
}

void PIRWiFiClient::doConnectWiFi()
{
    printConnectSSID();
    if (connectWiFi() == SUCCESS)
        printConnectedAndIP();
    else
    {
        printNotConnected();
        alertError(TIME_200MS_PER_30SEC);
    }
}

void PIRWiFiClient::printConnectSSID()
{
    SERIAL_DEBUG_PRINT("\n\nConnecting to ");
    SERIAL_DEBUG_PRINTLN(staConfigInfo->getSSID());
}

bool PIRWiFiClient::connectWiFi()
{
    byte timeout = TIME_500MS_PER_1MIN;

    WiFi.mode(WIFI_STA);
    WiFi.begin(staConfigInfo->getSSID().c_str(), staConfigInfo->getPassword().c_str());
    while (WiFi.status() != WL_CONNECTED && timeout != 0)
    {
        delay(TIME_500MS);
        timeout--;
        SERIAL_DEBUG_PRINT(".");
    }
    if (timeout == 0)
        return FAIL;
    else
        return SUCCESS;
}

void PIRWiFiClient::printConnectedAndIP()
{
    SERIAL_DEBUG_PRINTLN("\n>>> WiFi connected");
    SERIAL_DEBUG_PRINT("IP address: ");
    SERIAL_DEBUG_PRINTLN(WiFi.localIP());
}

void PIRWiFiClient::printNotConnected()
{
    SERIAL_DEBUG_PRINTLN("\n>>> WiFi connect FAILED");
    digitalWrite(ALERT_LED_PIN, LED_ON);
}

void PIRWiFiClient::blinkLED()
{
    byte ledState = digitalRead(ALERT_LED_PIN);
    digitalWrite(ALERT_LED_PIN, !ledState);
}

void PIRWiFiClient::alertError(int timeout)
{
    byte ledState = digitalRead(ALERT_LED_PIN);
    while (timeout--)
    {
        blinkLED();
        delay(TIME_200MS);
    }
    digitalWrite(ALERT_LED_PIN, ledState);
}

bool PIRWiFiClient::connectAndSendDataToServer(byte sensorStatus, String breaktimeValue)
{
    bool statusFlag = FAIL;
    String responseResult;

    if (connectTCPToHost() == SUCCESS)
    {
        sendStatusToServerWithGET(sensorStatus, breaktimeValue);

        if (checkNoTimeOut() == SUCCESS)
        {
            responseResult = readResponeData();
            if (responseResult.indexOf(RECEIVE_SUCCESS_STRING) != FIND_NOT_FOUND)
            {
                checkStopBreaktimeCommandFromServer(responseResult);
                statusFlag = SUCCESS;
            }
        }
        else
        {
            alertError(TIME_200MS_PER_5SEC);
        }
    }
    else
    {
        alertError(TIME_200MS_PER_5SEC);
    }
    return statusFlag;
}

bool PIRWiFiClient::connectTCPToHost()
{
    SERIAL_DEBUG_PRINT("\nConnecting to ");
    SERIAL_DEBUG_PRINTLN(mrbsConfigInfo.getServerHost());

    if (!espClient.connect(mrbsConfigInfo.getServerHost().c_str(), mrbsConfigInfo.getServerPort()))
    {
        SERIAL_DEBUG_PRINTLN(">>> Connection FAILED");
        return FAIL;
    }
    return SUCCESS;
}

void PIRWiFiClient::sendStatusToServerWithGET(byte sensorStatus, String breaktimeValue)
{
    String url = mrbsConfigInfo.getPathName();
    url += roomFeild;
    url += mrbsConfigInfo.getIDRoom();
    url += statusFeild;
    url += String(sensorStatus);
    url += breaktimeFeild;
    url += breaktimeValue;
    url += apiFeild;
    url += mrbsConfigInfo.getAPIKey();
    url += "\r\n";

    SERIAL_DEBUG_PRINT("Requesting URL: ");
    SERIAL_DEBUG_PRINTLN(url);

    espClient.print(String("GET ") + url + " HTTP/1.1\r\n" +
                    "Host: " + mrbsConfigInfo.getServerHost() + "\r\n" +
                    "Connection: close\r\n\r\n");
}

bool PIRWiFiClient::checkNoTimeOut()
{
    unsigned long timeout = millis();

    while (espClient.available() == 0)
    {
        if (millis() - timeout > TIMEOUT_SEND_MS)
        {
            SERIAL_DEBUG_PRINTLN(">>> Client Timeout !");
            espClient.stop();
            return FAIL;
        }
    }
    return SUCCESS;
}

String PIRWiFiClient::readResponeData()
{
    String response;
    if (espClient.available())
    {
        response = espClient.readString();
        SERIAL_DEBUG_PRINT(response);
    }
    SERIAL_DEBUG_PRINTLN("\n>>> Closing connection\n");
    delay(TIME_1SEC);
    return response;
}

void PIRWiFiClient::checkStopBreaktimeCommandFromServer(String responseResult)
{
    if (responseResult.indexOf(STOP_BREAKTIME_COMMAND_STRING) != FIND_NOT_FOUND)
    {
        digitalWrite(BREAKTIME_LED_PIN, LED_OFF);
        flagButtonBreaktime = NOT_IN_BREAKTIME_MODE;
        SERIAL_DEBUG_PRINTLN("\n>>> Exit breaktime mode");
    }
}
