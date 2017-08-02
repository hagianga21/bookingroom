#ifndef __NETWORK_CONFIG_INFO_H__
#define __NETWORK_CONFIG_INFO_H__

#include <ESP8266WiFi.h>
#include "Arduino.h"
#include "DebugDefine.h"
#include "Define.h"
#include "EEPROMHelper.h"

class NetworkConfigInfo
{
  protected:
    String ssid;
    String password;

  public:
    NetworkConfigInfo(String _ssid = STA_SSID_DEFAULT, String _password = STA_PASSWORD_DEFAULT);
    void setSSID(String _ssid);
    void setPassword(String _password);
    String getSSID();
    String getPassword();

    void setNetworkConfigInfoFromEEPROMIfExist();
    virtual void setSSIDFromEEPROMIfExist() = 0;
    virtual void setPasswordFromEEPROMIfExist() = 0;

    void saveNetworkConfigInfoToEEPROM();
    virtual void saveSSIDToEEPROM() = 0;
    virtual void savePasswordToEEPROM() = 0;
    
    //virtual void saveSSIDToEEPROM(String _ssid) = 0;
    //virtual void savePasswordToEEPROM(String _password) = 0;
};

#endif
