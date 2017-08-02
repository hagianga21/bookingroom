#ifndef __MRBS_CONFIG_INFO_H__
#define __MRBS_CONFIG_INFO_H__

#include <ESP8266WiFi.h>
#include "Arduino.h"
#include "DebugDefine.h"
#include "Define.h"
#include "EEPROMHelper.h"

class MRBSConfigInfo
{
  private:
    String serverHost;
    int serverPort;
    String pathName;
    byte idRoom;
    String apiKey;

  public:
    MRBSConfigInfo(String _serverHost = SERVER_HOST_DEFAULT, int _serverPort = SERVER_PORT_DEFAULT,
                   String _pathName = PATH_NAME_DEFAULT, byte _idRoom = ID_ROOM_DEFAULT,
                   String _apiKey = API_KEY_DEFAULT);
    void setMRBSConfigInfoFromEEPROMIfExist();
    void setServerHost(String _serverHost);
    void setServerHostFromEEPROMIfExist();
    void setServerPort(int _serverPort);
    void setServerPortFromEEPROMIfExist();
    void setPathName(String _pathName);
    void setPathNameFromEEPROMIfExist();
    void setIDRoom(byte _idRoom);
    void setIDRoomFromEEPROMIfExist();
    void setAPIKey(String _apiKey);
    void setAPIKeyFromEEPROMIfExist();
    String getServerHost();
    int getServerPort();
    String getPathName();
    byte getIDRoom();
    String getAPIKey();

    void saveMRBSConfigInfoToEEPROM();
    void saveServerHostToEEPROM();
    void saveServerPortToEEPROM();
    void savePathNameToEEPROM();
    void saveIDRoomToEEPROM();
    void saveAPIKeyToEEPROM();

    static void staticSaveServerHostToEEPROM(String _serverHost);
    static void staticSaveServerPortToEEPROM(String _serverPort);
    static void staticSavePathNameToEEPROM(String _pathName);
    static void staticSaveIDRoomToEEPROM(String _idRoom);
    static void staticSaveAPIKeyToEEPROM(String _apiKey);
    static void printMRBSConfigInfoFromEEPROM();
};

#endif
