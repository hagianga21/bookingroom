#include "NetworkConfigInfo.h"

NetworkConfigInfo::NetworkConfigInfo(String _ssid, String _password)
{
    this->ssid = _ssid;
    this->password = _password;
}

void NetworkConfigInfo::setSSID(String _ssid)
{
    this->ssid = _ssid;
}

void NetworkConfigInfo::setPassword(String _password)
{
    this->password = _password;
}

String NetworkConfigInfo::getSSID()
{
    return this->ssid;
}

String NetworkConfigInfo::getPassword()
{
    return this->password;
}

void NetworkConfigInfo::setNetworkConfigInfoFromEEPROMIfExist()
{
    setSSIDFromEEPROMIfExist();
    setPasswordFromEEPROMIfExist();
}

void NetworkConfigInfo::saveNetworkConfigInfoToEEPROM()
{
    saveSSIDToEEPROM();
    savePasswordToEEPROM();
}