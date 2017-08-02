#include "STANetworkConfigInfo.h"

STANetworkConfigInfo::STANetworkConfigInfo(String _ssid, String _password) : NetworkConfigInfo(_ssid, _password)
{
}

void STANetworkConfigInfo::setSSIDFromEEPROMIfExist()
{
    if (EEPROM.read(FLAG_STA_SSID_CONFIGURED_ADDR) == HAVE_CONFIGURED_CHAR)
    {
        SERIAL_DEBUG_PRINTLN("- Set STA SSID config info from EEPROM");
        this->ssid = EHelper.readDataFromEEPROM(STA_SSID_ADDR, EMPTY_CHAR);
    }
}

void STANetworkConfigInfo::setPasswordFromEEPROMIfExist()
{
    if (EEPROM.read(FLAG_STA_PASSWORD_CONFIGURED_ADDR) == HAVE_CONFIGURED_CHAR)
    {
        SERIAL_DEBUG_PRINTLN("- Set STA Password config info from EEPROM");
        this->password = EHelper.readDataFromEEPROM(STA_PASSWORD_ADDR, EMPTY_CHAR);
    }
}

void STANetworkConfigInfo::saveSSIDToEEPROM()
{
    STANetworkConfigInfo::staticSaveSSIDToEEPROM(this->ssid);
}

void STANetworkConfigInfo::savePasswordToEEPROM()
{
    STANetworkConfigInfo::staticSavePasswordToEEPROM(this->password);
}

void STANetworkConfigInfo::staticSaveSSIDToEEPROM(String _ssid)
{
    if (_ssid.length() > 0)
    {
        SERIAL_DEBUG_PRINTLN("- Set FLAG_STA_SSID_CONFIGURED and write STA SSID config info to EEPROM");
        EHelper.writeDataToEEPROM(FLAG_STA_SSID_CONFIGURED_ADDR, HAVE_CONFIGURED_STRING);
        EHelper.writeDataToEEPROM(STA_SSID_ADDR, _ssid, STA_SSID_LENGTH);
    }
}

void STANetworkConfigInfo::staticSavePasswordToEEPROM(String _password)
{
    // Password can null, so no need to check length
    SERIAL_DEBUG_PRINTLN("- Set FLAG_STA_PASSWORD_CONFIGURED and write STA Password config info to EEPROM");
    EHelper.writeDataToEEPROM(FLAG_STA_PASSWORD_CONFIGURED_ADDR, HAVE_CONFIGURED_STRING);
    EHelper.writeDataToEEPROM(STA_PASSWORD_ADDR, _password, STA_PASSWORD_LENGTH);
}

void STANetworkConfigInfo::printSTANetworkConfigInfoFromEEPROM()
{
    SERIAL_DEBUG_PRINT("- STA SSID: -> ");
    EHelper.printIsValidConfigInfoInEEPROM(FLAG_STA_SSID_CONFIGURED_ADDR);
    EHelper.readDataFromEEPROM(STA_SSID_ADDR, STA_SSID_LENGTH);

    SERIAL_DEBUG_PRINT("- STA Password: -> ");
    EHelper.printIsValidConfigInfoInEEPROM(FLAG_STA_PASSWORD_CONFIGURED_ADDR);
    EHelper.readDataFromEEPROM(STA_PASSWORD_ADDR, STA_PASSWORD_LENGTH);
}
