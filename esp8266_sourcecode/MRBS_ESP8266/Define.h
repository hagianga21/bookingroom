#ifndef __DEFINE_H__
#define __DEFINE_H__

#define MAX_OF_SENSOR                       8
#define PIR1_PIN                            4
#define PIR2_PIN                            5
#define PIR3_PIN                            14
#define TURN_AP_MODE_BUTTON_PIN             12
#define TURN_BREAKTIME_BUTTON_PIN           13
#define BREAKTIME_LED_PIN                   15
#define ALERT_LED_PIN                       2
#define LED_ON                              LOW
#define LED_OFF                             HIGH
#define LED_BREAKTIME_ON                    HIGH
#define LED_BREAKTIME_OFF                   LOW

#define SEQ_TIME_READ_SEC                   7
#define SEQ_TIME_SEND_SEC                   60
#define DEBOUNCE_DELAY_IN_MS                1500

#define SERIAL_BAURATE                      115200
#define EEPROM_SIZE                         512
#define EEPROM_PRINT_SIZE_ONE_LINE          50
#define EMPTY_CHAR                          '*'
#define EMPTY_STRING                        "*"
#define HAVE_CONFIGURED_CHAR                '1'
#define HAVE_CONFIGURED_STRING              "1"
#define FLAG_AP_SSID_CONFIGURED_ADDR        0
#define AP_SSID_ADDR                        1
#define AP_SSID_LENGTH                      32
#define FLAG_AP_PASSWORD_CONFIGURED_ADDR    34
#define AP_PASSWORD_ADDR                    35
#define AP_PASSWORD_LENGTH                  64
#define FLAG_STA_SSID_CONFIGURED_ADDR       100
#define STA_SSID_ADDR                       101
#define STA_SSID_LENGTH                     32
#define FLAG_STA_PASSWORD_CONFIGURED_ADDR   134
#define STA_PASSWORD_ADDR                   135
#define STA_PASSWORD_LENGTH                 64
#define FLAG_SERVER_HOST_CONFIGURED_ADDR    200
#define SERVER_HOST_ADDR                    201
#define SERVER_HOST_LENGTH                  15
#define FLAG_SERVER_PORT_CONFIGURED_ADDR    217
#define SERVER_PORT_ADDR                    218
#define SERVER_PORT_LENGTH                  5
#define FLAG_PATH_NAME_CONFIGURED_ADDR      224
#define PATH_NAME_ADDR                      225
#define PATH_NAME_LENGTH                    60
#define FLAG_ID_ROOM_CONFIGURED_ADDR        286
#define ID_ROOM_ADDR                        287
#define ID_ROOM_LENGTH                      2
#define FLAG_API_KEY_CONFIGURED_ADDR        290
#define API_KEY_ADDR                        291
#define API_KEY_LENGTH                      25

#define ESP_SERVER_PORT_DEFAULT             80
#define SERVER_HOST_DEFAULT                 "192.168.122.26"
#define SERVER_PORT_DEFAULT                 80
#define PATH_NAME_DEFAULT                   "/mrbs_sourcecode/API/MainAPI.php"
#define ID_ROOM_DEFAULT                     2
#define API_KEY_DEFAULT                     "T7ya9Ud09zLuC3ieFp5GD"
#define AP_SSID_DEFAULT                     "ESP8266"
#define AP_PASSWORD_DEFAULT                 ""
#define STA_SSID_DEFAULT                    "dekvnintern"
#define STA_PASSWORD_DEFAULT                "iaC3oocaeNasien3j"

#define COMPLETE_EXIST_HUMAN                255
#define COMPLETE_NOT_EXIST_HUMAN            0
#define EXIST_HUMAN                         1
#define NOT_EXIST_HUMAN                     0
#define BIT1                                0x1
#define BIT0                                0x0
#define SUCCESS                             true
#define FAIL                                false
#define FIND_NOT_FOUND                      -1
#define RECEIVE_SUCCESS_STRING              "SUCCESS!"
#define STOP_BREAKTIME_COMMAND_STRING       "STOP BREAKTIME"

#define TIME_100MS                          100
#define TIME_200MS                          200
#define TIME_200MS_PER_5SEC                 25
#define TIME_200MS_PER_15SEC                75
#define TIME_200MS_PER_1MIN                 300
#define TIME_500MS                          500
#define TIME_500MS_PER_20SEC                40
#define TIME_500MS_PER_1MIN                 120
#define TIME_1SEC                           1000
#define TIME_5SEC                           5000
#define TIMEOUT_SEND_MS                     8000

#endif
