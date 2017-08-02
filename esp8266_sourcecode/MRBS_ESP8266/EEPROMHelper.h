#ifndef __EEPROM_HELPER_H__
#define __EEPROM_HELPER_H__

#include "Arduino.h"
#include "EEPROM.h"
#include "DebugDefine.h"
#include "Define.h"

class EEPROMHelper
{
  public:
    EEPROMHelper();
    String readDataFromEEPROM(int pos, int num);
    String readDataFromEEPROM(int pos, char stopChar);
    void writeDataToEEPROM(int pos, String data);
    void writeDataToEEPROM(int pos, String data, int length);
    void clearEEPROM();
    void printAllDataInEEPROM();

    static void printIsValidConfigInfoInEEPROM(int pos);
};

extern EEPROMHelper EHelper;

#endif
