#ifndef __DEBUG_DEFINE_H__
#define __DEBUG_DEFINE_H__

#define SERIAL_DEBUG

#ifdef SERIAL_DEBUG
  #define SERIAL_DEBUG_PRINT(...)   Serial.print(__VA_ARGS__)
  #define SERIAL_DEBUG_PRINTF(...)  Serial.printf(__VA_ARGS__)
  #define SERIAL_DEBUG_PRINTLN(...) Serial.println(__VA_ARGS__)
#else
  #define SERIAL_DEBUG_PRINT(...)
  #define SERIAL_DEBUG_PRINTF(...)
  #define SERIAL_DEBUG_PRINTLN(...)
#endif

#endif
