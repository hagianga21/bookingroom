#ifndef __AP_NETWORK_CONFIG_INFO_H__
#define __AP_NETWORK_CONFIG_INFO_H__

#include "NetworkConfigInfo.h"

class APNetworkConfigInfo : public NetworkConfigInfo
{
  public:
    APNetworkConfigInfo(String _ssid = AP_SSID_DEFAULT, String _password = AP_PASSWORD_DEFAULT);

    void setSSIDFromEEPROMIfExist();
    void setPasswordFromEEPROMIfExist();

    void saveSSIDToEEPROM();
    void savePasswordToEEPROM();

    static void staticSaveSSIDToEEPROM(String _ssid);
    static void staticSavePasswordToEEPROM(String _password);
    static void printAPNetworkConfigInfoFromEEPROM();
};

#endif
