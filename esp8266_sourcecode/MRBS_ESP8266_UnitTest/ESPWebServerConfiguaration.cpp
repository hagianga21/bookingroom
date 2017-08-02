#include "ESPWebServerConfiguaration.h"

ESPWebServerConfiguaration::ESPWebServerConfiguaration(String _apSSID, String _apPassword, int _espServerPort)
{
    this->apConfigInfo = new APNetworkConfigInfo(_apSSID, _apPassword);
    this->webServer = new ESP8266WebServer(_espServerPort);
}

void ESPWebServerConfiguaration::setAPConfigInfo(NetworkConfigInfo *_apConfigInfo)
{
    this->apConfigInfo = new APNetworkConfigInfo(_apConfigInfo->getSSID(), _apConfigInfo->getPassword());
}

void ESPWebServerConfiguaration::setAPConfigInfoFromEEPROM()
{
    apConfigInfo->setNetworkConfigInfoFromEEPROMIfExist();
}

NetworkConfigInfo *ESPWebServerConfiguaration::getAPConfigInfo()
{
    return this->apConfigInfo;
}

void ESPWebServerConfiguaration::webServerBegin(bool passwordNull)
{
    if (enterAPMode(passwordNull) == SUCCESS)
    {
        printEnteredAPModeAndIP();
        this->webServerRegisterHandler();
        webServer->begin();
        SERIAL_DEBUG_PRINTLN(">>> ESP8266 website for configuaration started");
    }
    else
        printFailAPMode();
}

bool ESPWebServerConfiguaration::enterAPMode(bool passwordNull)
{
    String password;
    byte timeout = TIME_500MS_PER_1MIN;

    password = (passwordNull) ? "" : apConfigInfo->getPassword();

    WiFi.mode(WIFI_AP_STA);
    while (!WiFi.softAP(apConfigInfo->getSSID().c_str(), password.c_str()) && timeout != 0)
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

void ESPWebServerConfiguaration::printEnteredAPModeAndIP()
{
    SERIAL_DEBUG_PRINTLN("\n>>> Access point mode is ready");
    SERIAL_DEBUG_PRINT("AP SSID: ");
    SERIAL_DEBUG_PRINTLN(apConfigInfo->getSSID());
    SERIAL_DEBUG_PRINT("Host IP address: ");
    SERIAL_DEBUG_PRINTLN(WiFi.softAPIP());
}

void ESPWebServerConfiguaration::printFailAPMode()
{
    SERIAL_DEBUG_PRINTLN("\n>>> Access point mode turn on FAILED");
}

void ESPWebServerConfiguaration::webServerRegisterHandler()
{
    webServer->on("/", [this]() {
        rootAccessHandler();
    });
    webServer->on("/thanks", [this]() {
        submitHandler();
    });
}

void ESPWebServerConfiguaration::webServerStop()
{
    webServer->stop();
    //WiFi.mode(WIFI_OFF);
    //WiFi.mode(WIFI_STA);
    SERIAL_DEBUG_PRINTLN("");
    if (WiFi.softAPdisconnect(true))
        SERIAL_DEBUG_PRINTLN("Soft AP disconnected");
    else
        SERIAL_DEBUG_PRINTLN("Soft AP disconnect FAILED");
    if (WiFi.reconnect())
        SERIAL_DEBUG_PRINTLN("Wifi reconnected");
    else
        SERIAL_DEBUG_PRINTLN("Wifi reconnect FAILED");
    delay(TIME_100MS);
    SERIAL_DEBUG_PRINTLN(">>> ESP8266 Access point mode turn off");
}

void ESPWebServerConfiguaration::rootAccessHandler()
{
    SERIAL_DEBUG_PRINTLN("\n>>> Client enter ESP8266 server");
    webServer->send(200, "text/html", _mainPage);
}

void ESPWebServerConfiguaration::submitHandler()
{
    if (webServer->hasArg("save_button") || webServer->hasArg("reset_button"))
    {
        SERIAL_DEBUG_PRINTLN("\n*** Client has pushed submit button");
        webServer->send(200, "text/html", _thanksPage);

        if (webServer->arg("save_button") == "SAVE")
        {
            SERIAL_DEBUG_PRINTLN("*** SAVE button has been pushed");
            SERIAL_DEBUG_PRINTLN("Here is all reconfig information");
            this->saveButtonHandler();
        }
        if (webServer->arg("reset_button") == "RESET")
        {
            SERIAL_DEBUG_PRINTLN("*** RESET button has been pushed");
            this->resetButtonHandler();
        }
        webServerStop();
        SERIAL_DEBUG_PRINTLN("\n>>>> Restart after 5 seconds <<<<");
        delay(TIME_5SEC);
        SERIAL_DEBUG_PRINTLN("\n\n>>>> RESTART <<<<");
        delay(TIME_100MS);
        ESP.restart();
    }
    else
        rootAccessHandler();
}

/* Save all config info if exist into EEPROM.
   Set all corresponding flag true */
void ESPWebServerConfiguaration::saveButtonHandler()
{
    String tmp;

    tmp = webServer->arg("apSSID");
    APNetworkConfigInfo::staticSaveSSIDToEEPROM(tmp);

    tmp = webServer->arg("apPassword");
    if (tmp.length() > 0 || webServer->arg("apPasswordNull") == "null_password")
    {
        APNetworkConfigInfo::staticSavePasswordToEEPROM(tmp);
    }

    tmp = webServer->arg("staSSID");
    STANetworkConfigInfo::staticSaveSSIDToEEPROM(tmp);

    tmp = webServer->arg("staPassword");
    if (tmp.length() > 0 || webServer->arg("staPasswordNull") == "null_password")
    {
        STANetworkConfigInfo::staticSavePasswordToEEPROM(tmp);
    }

    tmp = webServer->arg("serverHost");
    MRBSConfigInfo::staticSaveServerHostToEEPROM(tmp);

    tmp = webServer->arg("serverPort");
    MRBSConfigInfo::staticSaveServerPortToEEPROM(tmp);

    tmp = webServer->arg("pathName");
    MRBSConfigInfo::staticSavePathNameToEEPROM(tmp);

    tmp = webServer->arg("idRoom");
    MRBSConfigInfo::staticSaveIDRoomToEEPROM(tmp);

    tmp = webServer->arg("apiKey");
    MRBSConfigInfo::staticSaveAPIKeyToEEPROM(tmp);
}

/* Use default configuaration which have set when MRBSConfigInfo and NetworkConfigInfo was created.
   Set all flag in EEPROM to false */
void ESPWebServerConfiguaration::resetButtonHandler()
{

    EEPROM.write(FLAG_AP_SSID_CONFIGURED_ADDR, EMPTY_CHAR);
    //EHelper.writeDataToEEPROM(AP_SSID_ADDR, AP_SSID_DEFAULT, AP_SSID_LENGTH);

    EEPROM.write(FLAG_AP_PASSWORD_CONFIGURED_ADDR, EMPTY_CHAR);
    //EHelper.writeDataToEEPROM(AP_PASSWORD_ADDR, AP_PASSWORD_DEFAULT, AP_PASSWORD_LENGTH);

    EEPROM.write(FLAG_STA_SSID_CONFIGURED_ADDR, EMPTY_CHAR);
    //EHelper.writeDataToEEPROM(STA_SSID_ADDR, STA_SSID_DEFAULT, STA_SSID_LENGTH);

    EEPROM.write(FLAG_STA_PASSWORD_CONFIGURED_ADDR, EMPTY_CHAR);
    //EHelper.writeDataToEEPROM(STA_PASSWORD_ADDR, STA_PASSWORD_DEFAULT, STA_PASSWORD_LENGTH);

    EEPROM.write(FLAG_SERVER_HOST_CONFIGURED_ADDR, EMPTY_CHAR);
    //EHelper.writeDataToEEPROM(SERVER_HOST_ADDR, SERVER_HOST_DEFAULT, SERVER_HOST_LENGTH);

    EEPROM.write(FLAG_SERVER_PORT_CONFIGURED_ADDR, EMPTY_CHAR);
    //EHelper.writeDataToEEPROM(SERVER_PORT_ADDR, String(SERVER_PORT_DEFAULT), SERVER_PORT_LENGTH);

    EEPROM.write(FLAG_PATH_NAME_CONFIGURED_ADDR, EMPTY_CHAR);
    //EHelper.writeDataToEEPROM(PATH_NAME_ADDR, PATH_NAME_DEFAULT, PATH_NAME_LENGTH);

    EEPROM.write(FLAG_ID_ROOM_CONFIGURED_ADDR, EMPTY_CHAR);
    //EHelper.writeDataToEEPROM(ID_ROOM_ADDR, String(ID_ROOM_DEFAULT), ID_ROOM_LENGTH);

    EEPROM.write(FLAG_API_KEY_CONFIGURED_ADDR, EMPTY_CHAR);
    //EHelper.writeDataToEEPROM(API_KEY_ADDR, API_KEY_DEFAULT, API_KEY_LENGTH);

    EEPROM.commit();
    SERIAL_DEBUG_PRINTLN("");
}

void ESPWebServerConfiguaration::handlClient()
{
    webServer->handleClient();
}

void ESPWebServerConfiguaration::printConfigInfoFromEEPROM()
{
    APNetworkConfigInfo::printAPNetworkConfigInfoFromEEPROM();
    STANetworkConfigInfo::printSTANetworkConfigInfoFromEEPROM();
    MRBSConfigInfo::printMRBSConfigInfoFromEEPROM();
}
