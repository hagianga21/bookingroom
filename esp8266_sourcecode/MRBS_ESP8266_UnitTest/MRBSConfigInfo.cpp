#include "MRBSConfigInfo.h"

MRBSConfigInfo::MRBSConfigInfo(String _serverHost, int _serverPort,
                               String _pathName, byte _idRoom, String _apiKey)
{
    this->serverHost = _serverHost;
    this->serverPort = _serverPort;
    this->pathName = _pathName;
    this->idRoom = _idRoom;
    this->apiKey = _apiKey;
}

void MRBSConfigInfo::setMRBSConfigInfoFromEEPROMIfExist()
{
    setServerHostFromEEPROMIfExist();
    setServerPortFromEEPROMIfExist();
    setPathNameFromEEPROMIfExist();
    setIDRoomFromEEPROMIfExist();
    setAPIKeyFromEEPROMIfExist();
}

void MRBSConfigInfo::setServerHost(String _serverHost)
{
    this->serverHost = _serverHost;
}

void MRBSConfigInfo::setServerHostFromEEPROMIfExist()
{
    if (EEPROM.read(FLAG_SERVER_HOST_CONFIGURED_ADDR) == HAVE_CONFIGURED_CHAR)
    {
        SERIAL_DEBUG_PRINTLN("- Set Server Host config info from EEPROM");
        this->serverHost = EHelper.readDataFromEEPROM(SERVER_HOST_ADDR, EMPTY_CHAR);
    }
}

void MRBSConfigInfo::setServerPort(int _serverPort)
{
    this->serverPort = _serverPort;
}

void MRBSConfigInfo::setServerPortFromEEPROMIfExist()
{
    if (EEPROM.read(FLAG_SERVER_PORT_CONFIGURED_ADDR) == HAVE_CONFIGURED_CHAR)
    {
        SERIAL_DEBUG_PRINTLN("- Set Server Port config info from EEPROM");
        this->serverPort = EHelper.readDataFromEEPROM(SERVER_PORT_ADDR, EMPTY_CHAR).toInt();
    }
}

void MRBSConfigInfo::setPathName(String _pathName)
{
    this->pathName = _pathName;
}

void MRBSConfigInfo::setPathNameFromEEPROMIfExist()
{
    if (EEPROM.read(FLAG_PATH_NAME_CONFIGURED_ADDR) == HAVE_CONFIGURED_CHAR)
    {
        SERIAL_DEBUG_PRINTLN("- Set Path Name config info from EEPROM");
        this->pathName = EHelper.readDataFromEEPROM(PATH_NAME_ADDR, EMPTY_CHAR);
    }
}

void MRBSConfigInfo::setIDRoom(byte _idRoom)
{
    this->idRoom = _idRoom;
}

void MRBSConfigInfo::setIDRoomFromEEPROMIfExist()
{
    if (EEPROM.read(FLAG_ID_ROOM_CONFIGURED_ADDR) == HAVE_CONFIGURED_CHAR)
    {
        SERIAL_DEBUG_PRINTLN("- Set ID Room config info from EEPROM");
        this->idRoom = EHelper.readDataFromEEPROM(ID_ROOM_ADDR, EMPTY_CHAR).toInt();
    }
}

void MRBSConfigInfo::setAPIKey(String _apiKey)
{
    this->apiKey = _apiKey;
}

void MRBSConfigInfo::setAPIKeyFromEEPROMIfExist()
{
    if (EEPROM.read(FLAG_API_KEY_CONFIGURED_ADDR) == HAVE_CONFIGURED_CHAR)
    {
        SERIAL_DEBUG_PRINTLN("- Set API Key config info from EEPROM");
        this->apiKey = EHelper.readDataFromEEPROM(API_KEY_ADDR, EMPTY_CHAR);
    }
}

String MRBSConfigInfo::getServerHost()
{
    return this->serverHost;
}

int MRBSConfigInfo::getServerPort()
{
    return this->serverPort;
}

String MRBSConfigInfo::getPathName()
{
    return this->pathName;
}

byte MRBSConfigInfo::getIDRoom()
{
    return this->idRoom;
}

String MRBSConfigInfo::getAPIKey()
{
    return this->apiKey;
}

void MRBSConfigInfo::saveMRBSConfigInfoToEEPROM()
{
    saveServerHostToEEPROM();
    saveServerPortToEEPROM();
    savePathNameToEEPROM();
    saveIDRoomToEEPROM();
    saveAPIKeyToEEPROM();
}

void MRBSConfigInfo::saveServerHostToEEPROM()
{
    MRBSConfigInfo::staticSaveServerHostToEEPROM(this->serverHost);
}

void MRBSConfigInfo::saveServerPortToEEPROM()
{
    MRBSConfigInfo::staticSaveServerPortToEEPROM(String(this->serverPort));
}

void MRBSConfigInfo::savePathNameToEEPROM()
{
    MRBSConfigInfo::staticSavePathNameToEEPROM(this->pathName);
}

void MRBSConfigInfo::saveIDRoomToEEPROM()
{
    MRBSConfigInfo::staticSaveIDRoomToEEPROM(String(this->idRoom));
}

void MRBSConfigInfo::saveAPIKeyToEEPROM()
{
    MRBSConfigInfo::staticSaveAPIKeyToEEPROM(this->apiKey);
}

void MRBSConfigInfo::staticSaveServerHostToEEPROM(String _serverHost)
{
    if (_serverHost.length() > 0)
    {
        SERIAL_DEBUG_PRINTLN("- Set FLAG_SERVER_HOST_CONFIGURED and write Server Host config info to EEPROM:");
        EHelper.writeDataToEEPROM(FLAG_SERVER_HOST_CONFIGURED_ADDR, HAVE_CONFIGURED_STRING);
        EHelper.writeDataToEEPROM(SERVER_HOST_ADDR, _serverHost, SERVER_HOST_LENGTH);
    }
}

void MRBSConfigInfo::staticSaveServerPortToEEPROM(String _serverPort)
{
    if (_serverPort.length() > 0)
    {
        SERIAL_DEBUG_PRINTLN("- Set FLAG_SERVER_PORT_CONFIGURED and write Server Port config info to EEPROM:");
        EHelper.writeDataToEEPROM(FLAG_SERVER_PORT_CONFIGURED_ADDR, HAVE_CONFIGURED_STRING);
        EHelper.writeDataToEEPROM(SERVER_PORT_ADDR, _serverPort, SERVER_PORT_LENGTH);
    }
}

void MRBSConfigInfo::staticSavePathNameToEEPROM(String _pathName)
{
    if (_pathName.length() > 0)
    {
        SERIAL_DEBUG_PRINTLN("- Set FLAG_PATH_NAME_CONFIGURED and write Path Name config info to EEPROM");
        EHelper.writeDataToEEPROM(FLAG_PATH_NAME_CONFIGURED_ADDR, HAVE_CONFIGURED_STRING);
        EHelper.writeDataToEEPROM(PATH_NAME_ADDR, _pathName, PATH_NAME_LENGTH);
    }
}

void MRBSConfigInfo::staticSaveIDRoomToEEPROM(String _idRoom)
{
    if (_idRoom.length() > 0)
    {
        SERIAL_DEBUG_PRINTLN("- Set FLAG_ID_ROOM_CONFIGURED and write ID Room config info to EEPROM:");
        EHelper.writeDataToEEPROM(FLAG_ID_ROOM_CONFIGURED_ADDR, HAVE_CONFIGURED_STRING);
        EHelper.writeDataToEEPROM(ID_ROOM_ADDR, _idRoom, ID_ROOM_LENGTH);
    }
}

void MRBSConfigInfo::staticSaveAPIKeyToEEPROM(String _apiKey)
{
    if (_apiKey.length() > 0)
    {
        SERIAL_DEBUG_PRINTLN("- Set FLAG_API_KEY_CONFIGURED and write API Key config info to EEPROM:");
        EHelper.writeDataToEEPROM(FLAG_API_KEY_CONFIGURED_ADDR, HAVE_CONFIGURED_STRING);
        EHelper.writeDataToEEPROM(API_KEY_ADDR, _apiKey, API_KEY_LENGTH);
    }
}

void MRBSConfigInfo::printMRBSConfigInfoFromEEPROM()
{
    SERIAL_DEBUG_PRINT("- Server Host: -> ");
    EHelper.printIsValidConfigInfoInEEPROM(FLAG_SERVER_HOST_CONFIGURED_ADDR);
    EHelper.readDataFromEEPROM(SERVER_HOST_ADDR, SERVER_HOST_LENGTH);

    SERIAL_DEBUG_PRINT("- Server Port: -> ");
    EHelper.printIsValidConfigInfoInEEPROM(FLAG_SERVER_PORT_CONFIGURED_ADDR);
    EHelper.readDataFromEEPROM(SERVER_PORT_ADDR, SERVER_PORT_LENGTH);

    SERIAL_DEBUG_PRINT("- Path Name: -> ");
    EHelper.printIsValidConfigInfoInEEPROM(FLAG_PATH_NAME_CONFIGURED_ADDR);
    EHelper.readDataFromEEPROM(PATH_NAME_ADDR, PATH_NAME_LENGTH);

    SERIAL_DEBUG_PRINT("- ID Room: -> ");
    EHelper.printIsValidConfigInfoInEEPROM(FLAG_ID_ROOM_CONFIGURED_ADDR);
    EHelper.readDataFromEEPROM(ID_ROOM_ADDR, ID_ROOM_LENGTH);

    SERIAL_DEBUG_PRINT("- API Key: -> ");
    EHelper.printIsValidConfigInfoInEEPROM(FLAG_API_KEY_CONFIGURED_ADDR);
    EHelper.readDataFromEEPROM(API_KEY_ADDR, API_KEY_LENGTH);
}
