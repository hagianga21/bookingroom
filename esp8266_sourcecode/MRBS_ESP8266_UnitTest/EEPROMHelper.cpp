#include "EEPROMHelper.h"

EEPROMHelper EHelper;

EEPROMHelper::EEPROMHelper()
{
}

String EEPROMHelper::readDataFromEEPROM(int pos, int num)
{
    String result = "";

    SERIAL_DEBUG_PRINTF("EEPROM reading (num) from position %d -> ", pos);
    if (pos < 0 || pos > EEPROM_SIZE || (pos + num) > EEPROM_SIZE)
    {
        SERIAL_DEBUG_PRINTLN("Oversize");
        return "";
    }
    else
    {
        for (int i = 0; i < num; i++)
            result += char(EEPROM.read(pos + i));
        SERIAL_DEBUG_PRINTLN(result);
    }
    SERIAL_DEBUG_PRINTF("  >>> Done! Have read %d bytes\n", num);
    return result;
}

String EEPROMHelper::readDataFromEEPROM(int pos, char stopChar)
{
    String result;
    char cmp_char;
    int step = pos;

    SERIAL_DEBUG_PRINTF("EEPROM reading (stopChar) from position %d -> ", pos);
    if (pos < 0 || pos > EEPROM_SIZE)
    {
        SERIAL_DEBUG_PRINTLN("Oversize");
        return "";
    }
    else
    {
        while (cmp_char != stopChar)
        {
            cmp_char = char(EEPROM.read(step++));
            result += cmp_char;
        }
        result.remove(result.length() - 1);
        SERIAL_DEBUG_PRINTLN(result);
    }
    SERIAL_DEBUG_PRINTF("  >>> Done! Have read %d bytes until %c character\n", result.length(), stopChar);
    return result;
}

void EEPROMHelper::writeDataToEEPROM(int pos, String data)
{
    int dataLength;

    dataLength = data.length();
    SERIAL_DEBUG_PRINTF("EEPROM writing from position %d -> ", pos);
    if (pos < 0 || pos > EEPROM_SIZE || (pos + dataLength) > EEPROM_SIZE)
    {
        SERIAL_DEBUG_PRINTLN("Oversize");
    }
    else
    {
        for (int i = 0; i < dataLength; i++)
        {
            EEPROM.write(pos + i, data[i]);
            SERIAL_DEBUG_PRINT(data[i]);
        }
        EEPROM.commit();
        SERIAL_DEBUG_PRINTF("  >>> Done! Have writed %d bytes\n", dataLength);
    }
}
void EEPROMHelper::writeDataToEEPROM(int pos, String data, int length)
{
    int dataLength;
    int lengthMin;

    dataLength = data.length();
    lengthMin = (length > dataLength) ? dataLength : length;
    SERIAL_DEBUG_PRINTF("EEPROM writing (length) from position %d -> ", pos);
    if (pos < 0 || pos > EEPROM_SIZE || (pos + length) > EEPROM_SIZE)
    {
        SERIAL_DEBUG_PRINTLN("Oversize");
    }
    else
    {
        for (int i = 0; i < lengthMin; i++)
        {
            EEPROM.write(pos + i, data[i]);
            SERIAL_DEBUG_PRINT(data[i]);
        }
        for (int i = lengthMin; i < length; i++)
        {
            EEPROM.write(pos + i, EMPTY_CHAR);
            SERIAL_DEBUG_PRINTF("%c", EMPTY_CHAR);
        }
        EEPROM.commit();
        SERIAL_DEBUG_PRINTF("  >>> Done! Have writed %d bytes\n", dataLength);
    }
}
void EEPROMHelper::clearEEPROM()
{
    SERIAL_DEBUG_PRINTLN("\nClear EEPROM -> ");
    writeDataToEEPROM(0, "", EEPROM_SIZE);
}

void EEPROMHelper::printAllDataInEEPROM()
{
    for (int i = 0; i < EEPROM_SIZE; i += EEPROM_PRINT_SIZE_ONE_LINE)
    {
        SERIAL_DEBUG_PRINTF("Position %d -> %d: \n", i, i + EEPROM_PRINT_SIZE_ONE_LINE);
        readDataFromEEPROM(i, EEPROM_PRINT_SIZE_ONE_LINE);
        delay(5);
    }
    SERIAL_DEBUG_PRINTLN("");
}

void EEPROMHelper::printIsValidConfigInfoInEEPROM(int pos)
{
    if (EEPROM.read(pos) == HAVE_CONFIGURED_CHAR)
        SERIAL_DEBUG_PRINTLN("VALID");
    else
        SERIAL_DEBUG_PRINTLN("INVALID");
}
