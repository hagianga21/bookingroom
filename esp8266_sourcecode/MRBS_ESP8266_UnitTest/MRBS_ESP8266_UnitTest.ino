#line 2 "MRBS_ESP8266_UnitTest.ino"
#include <ArduinoUnit.h>
#include "PIRWiFiClient.h"

PIRWiFiClient *pirWifiClient;
byte numOfSensor = 3;
byte *pinNum;

void initPIRPin()
{
    pinNum = new byte[numOfSensor];
    pinNum[0] = PIR1_PIN;
    pinNum[1] = PIR2_PIN;
    pinNum[2] = PIR3_PIN;
}

void setup() 
{
  // put your setup code here, to run once:
  Serial.begin(115200);
  delay(TIME_100MS);
  Serial.println("\n\nBegin");
  
  initPIRPin();
  pirWifiClient = new PIRWiFiClient(numOfSensor, pinNum);
  Serial.println("\n\n");
}

test(Sensor_digital_pin_test)
{  
  for (byte i = 0; i < numOfSensor; i++)
  {
    pinMode(pinNum[i], OUTPUT);
    digitalWrite(pinNum[i], HIGH);
    pinMode(pinNum[i], INPUT);
    assertEqual(HIGH, digitalRead(pinNum[i]));
      
    pinMode(pinNum[i], OUTPUT);
    digitalWrite(pinNum[i], LOW);
    pinMode(pinNum[i], INPUT);
    assertEqual(LOW, digitalRead(pinNum[i]));
  }
}

test(PIR_readAllSensorStatus_function_test)
{
  byte data;

  for (byte i = 0; i < 8; i++)
  {
    pinMode(pinNum[0], OUTPUT);
    digitalWrite(pinNum[0], i & 0x01);
    pinMode(pinNum[1], OUTPUT);
    digitalWrite(pinNum[0], ((i & 0x02) != 0) ? HIGH : LOW);
    pinMode(pinNum[2], OUTPUT);
    digitalWrite(pinNum[0], ((i & 0x04) != 0) ? HIGH : LOW);

    data = 0;
    for (byte j = 0; j < 3; j++)
    {
      pinMode(pinNum[i], INPUT);
      data = (byte)((data << 1) | digitalRead(pinNum[i]));
    }
    assertEqual(data, pirWifiClient->readAllSensorStatus());
  }
}

void loop() 
{
  // put your main code here, to run repeatedly:
  Test::run();
}
