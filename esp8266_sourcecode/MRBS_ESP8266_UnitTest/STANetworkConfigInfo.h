#ifndef __STA_NETWORK_CONFIG_INFO_H__
#define __STA_NETWORK_CONFIG_INFO_H__

#include "NetworkConfigInfo.h"

class STANetworkConfigInfo : public NetworkConfigInfo
{
  public:
    STANetworkConfigInfo(String _ssid = STA_SSID_DEFAULT, String _password = STA_PASSWORD_DEFAULT);

    void setSSIDFromEEPROMIfExist();
    void setPasswordFromEEPROMIfExist();

    void saveSSIDToEEPROM();
    void savePasswordToEEPROM();

    static void staticSaveSSIDToEEPROM(String _ssid);
    static void staticSavePasswordToEEPROM(String _password);
    static void printSTANetworkConfigInfoFromEEPROM();
};

#endif
