#ifndef __PIR_WIFI_H__
#define __PIR_WIFI_H__

#include <ESP8266WiFi.h>
#include "PIR.h"
#include "MRBSConfigInfo.h"
#include "STANetworkConfigInfo.h"
#include "EEPROMHelper.h"
#include "FlagType.h"


class PIRWiFiClient : public PIR
{
    static constexpr char* roomFeild = "?room_id=";
    static constexpr char* statusFeild = "&status=";
    static constexpr char* apiFeild = "&key=";
    static constexpr char* breaktimeFeild = "&breaktime=";

  private:
    MRBSConfigInfo mrbsConfigInfo;
    NetworkConfigInfo* staConfigInfo;
    WiFiClient espClient;

    void blinkLED();
    void alertError(int timeout);
    void printConnectedAndIP();
    void printNotConnected();

  public:
    PIRWiFiClient();
    PIRWiFiClient(byte _numOfSensor, byte* _pinNum);
    void setMRBSConfigInfo(MRBSConfigInfo _mrbsConfigInfo);
    void setMRBSConfigInfoFromEEPROM();
    void setSTAConfigInfo(NetworkConfigInfo* _staConfigInfo);
    void setSTAConfigInfoFromEEPROM();
    MRBSConfigInfo getMRBSConfigInfo();
    NetworkConfigInfo* getSTAConfigInfo();  

    void doConnectWiFi();
    void printConnectSSID();
    bool connectWiFi();
    bool connectAndSendDataToServer(byte sensorStatus, String breaktimeValue);
    bool connectTCPToHost();
    void sendStatusToServerWithGET(byte sensorStatus, String breaktimeValue);
    bool checkNoTimeOut();
    String readResponeData();
    void checkStopBreaktimeCommandFromServer(String responseResult);
};

extern PIRWiFiClient* pirWifiClient;

#endif
