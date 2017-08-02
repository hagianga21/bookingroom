#ifndef __PIR_H__
#define __PIR_H__

#include "Arduino.h"
#include "DebugDefine.h"
#include "Define.h"

class PIR
{
    byte sensorStatus;
    byte numOfSensor;
    byte* pinNum;

  public:
    PIR();
    PIR(byte _numOfSensor, byte* _pinNum);
    byte get_numOfSensor();
    byte* get_pinNum();
    void configPinMode();
    byte readAllSensorStatus();
    bool getGeneralStatus();
};

#endif
