#include "PIR.h"

PIR::PIR()
{
}

PIR::PIR(byte _numOfSensor, byte *_pinNum)
{
    this->numOfSensor = _numOfSensor;

    this->pinNum = new byte[_numOfSensor];
    for (byte i = 0; i < _numOfSensor; i++)
        this->pinNum[i] = _pinNum[i];

    configPinMode();
}

void PIR::configPinMode()
{
    SERIAL_DEBUG_PRINTLN("\nConfig input pin for sensor");
    for (byte i = 0; i < numOfSensor; i++)
    {
        pinMode(pinNum[i], INPUT);
        SERIAL_DEBUG_PRINTF("PIR[%d] -> GPIO%d input mode\n", i, pinNum[i]);
    }
}

byte PIR::get_numOfSensor()
{
    return numOfSensor;
}
byte *PIR::get_pinNum()
{
    return pinNum;
}

byte PIR::readAllSensorStatus()
{
    sensorStatus = COMPLETE_NOT_EXIST_HUMAN;

    if (!numOfSensor)
        return COMPLETE_EXIST_HUMAN;
    else
    {
        SERIAL_DEBUG_PRINTLN("\nRead all sensor status -> ");
        for (byte i = 0; i < numOfSensor; i++)
        {
            sensorStatus = (byte)((sensorStatus << 1) | digitalRead(pinNum[i]));
            SERIAL_DEBUG_PRINTF("PIR[%d] = %d\n", i, digitalRead(pinNum[i]));
        }
    }
    return sensorStatus;
}

bool PIR::getGeneralStatus()
{
    byte result = 0;

    for (byte i = 0; i < numOfSensor; i++)
        result += ((sensorStatus >> i) & BIT1);
    SERIAL_DEBUG_PRINT("General status: status in binary ");
    SERIAL_DEBUG_PRINT(sensorStatus, BIN);
    SERIAL_DEBUG_PRINTF(" -> num of sensor status determine exist human = %d\n", result);
    return (result > 0) ? EXIST_HUMAN : NOT_EXIST_HUMAN;
}
