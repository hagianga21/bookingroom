#ifndef __ESP_WEB_SERVER_CONFIGUARATION_H__
#define __ESP_WEB_SERVER_CONFIGUARATION_H__

#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>
#include "APNetworkConfigInfo.h"
#include "STANetworkConfigInfo.h"
#include "HTMLCode.h"
#include "PIRWiFiClient.h"
#include "Define.h"

class ESPWebServerConfiguaration
{
  private:
    NetworkConfigInfo* apConfigInfo;
    ESP8266WebServer* webServer;
      
  public:
    ESPWebServerConfiguaration(String _apSSID = AP_SSID_DEFAULT, String _apPassword = AP_PASSWORD_DEFAULT,
                               int _espServerPort = ESP_SERVER_PORT_DEFAULT);
    void setAPConfigInfo(NetworkConfigInfo* _apConfigInfo);
    void setAPConfigInfoFromEEPROM();
    NetworkConfigInfo* getAPConfigInfo();
    void webServerBegin(bool passwordNull = false);
    bool enterAPMode(bool passwordNull);
    void printEnteredAPModeAndIP();
    void printFailAPMode();
    void webServerRegisterHandler();
    void webServerStop();
    void handlClient();
    void rootAccessHandler();
    void submitHandler();
    void saveButtonHandler();
    void resetButtonHandler();
    void printConfigInfoFromEEPROM();
    void inline printIsValidConfigInfoInEEPROM(int pos);
};

extern ESPWebServerConfiguaration* espServer;

#endif
