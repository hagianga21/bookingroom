#include "APNetworkConfigInfo.h"

APNetworkConfigInfo::APNetworkConfigInfo(String _ssid, String _password) : NetworkConfigInfo(_ssid, _password)
{
}

void APNetworkConfigInfo::setSSIDFromEEPROMIfExist()
{
    if (EEPROM.read(FLAG_AP_SSID_CONFIGURED_ADDR) == HAVE_CONFIGURED_CHAR)
    {
        SERIAL_DEBUG_PRINTLN("- Set AP SSID config info from EEPROM");
        this->ssid = EHelper.readDataFromEEPROM(AP_SSID_ADDR, EMPTY_CHAR);
    }
}

void APNetworkConfigInfo::setPasswordFromEEPROMIfExist()
{
    if (EEPROM.read(FLAG_AP_PASSWORD_CONFIGURED_ADDR) == HAVE_CONFIGURED_CHAR)
    {
        SERIAL_DEBUG_PRINTLN("- Set AP Password config info from EEPROM");
        this->password = EHelper.readDataFromEEPROM(AP_PASSWORD_ADDR, EMPTY_CHAR);
    }
}

void APNetworkConfigInfo::saveSSIDToEEPROM()
{
    APNetworkConfigInfo::staticSaveSSIDToEEPROM(this->ssid);
}

void APNetworkConfigInfo::savePasswordToEEPROM()
{
    APNetworkConfigInfo::staticSavePasswordToEEPROM(this->password);
}

void APNetworkConfigInfo::staticSaveSSIDToEEPROM(String _ssid)
{
    if (_ssid.length() > 0)
    {
        SERIAL_DEBUG_PRINTLN("- Set FLAG_AP_SSID_CONFIGURED and write AP SSID config info to EEPROM");
        EHelper.writeDataToEEPROM(FLAG_AP_SSID_CONFIGURED_ADDR, HAVE_CONFIGURED_STRING);
        EHelper.writeDataToEEPROM(AP_SSID_ADDR, _ssid, AP_SSID_LENGTH);
    }
}

void APNetworkConfigInfo::staticSavePasswordToEEPROM(String _password)
{
    // Password can null, so no need to check length
    SERIAL_DEBUG_PRINTLN("- Set FLAG_AP_PASSWORD_CONFIGURED and write AP Password config info to EEPROM");
    EHelper.writeDataToEEPROM(FLAG_AP_PASSWORD_CONFIGURED_ADDR, HAVE_CONFIGURED_STRING);
    EHelper.writeDataToEEPROM(AP_PASSWORD_ADDR, _password, AP_PASSWORD_LENGTH);
}

void APNetworkConfigInfo::printAPNetworkConfigInfoFromEEPROM()
{
    SERIAL_DEBUG_PRINT("- AP SSID: -> ");
    EHelper.printIsValidConfigInfoInEEPROM(FLAG_AP_SSID_CONFIGURED_ADDR);
    EHelper.readDataFromEEPROM(AP_SSID_ADDR, AP_SSID_LENGTH);

    SERIAL_DEBUG_PRINT("- AP Password: -> ");
    EHelper.printIsValidConfigInfoInEEPROM(FLAG_AP_PASSWORD_CONFIGURED_ADDR);
    EHelper.readDataFromEEPROM(AP_PASSWORD_ADDR, AP_PASSWORD_LENGTH);
}
