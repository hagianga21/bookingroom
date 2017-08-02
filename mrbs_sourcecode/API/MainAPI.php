<?php

include "Handler.php";
include "ConfirmEmailBody.php";
include "EditEmailBody.php";
include "WriteLogIntoFile.php";

define("STATUS_PARAM", "status");
define("ID_ROOM_PARAM", "room_id");
define("BREAKTIME_PARAM", "breaktime");
define("KEY_PARAM", "key");
define("PASSWORD_API", "T7ya9Ud09zLuC3ieFp5GD");


define("IS_NOT_IN_BREAK_TIME", 0);
define("IS_IN_BREAK_TIME", 1);

define("RESPONSE_INFO_OF_UPDATE_TO_DEVICE", ", update status history");
define("RESPONSE_INFO_OF_INSERT_TO_DEVICE", ", insert status history");
define("RESPONSE_END_BREAK_TIME_TO_DEVICE", ", STOP BREAKTIME");
define("RESPONSE_ROOM_WAS_BOOKED_TO_DEVICE", ", room was booked");
define("RESPONSE_INFO_OF_BREAK_TIME_ON_TO_DEVICE", ", breaktime on ");
define("RESPONSE_ROOM_IS_IN_BREAK_TIME_TO_DEVICE", ", room is breaktime");
define("RESPONSE_SUCCESS_TO_DEVICE", "SUCCESS!");

define("FORMAT_OF_DATE", "Y-m-d H:i");

define("NAME_OF_STATUS_HISTORY_COLUMN_IN_STATUS_TABLE", "status_history");
define("NAME_OF_COLUMN_ROOM_ID_IN_STATUS_TABLE", "room_id");
define("NAME_OF_COLUMN_END_BREAK_TIME_IN_STATUS_TABLE", "end_break_time");
define("NAME_OF_COLUMN_BREAK_TIME_IN_STATUS_TABLE", "is_break_time");

define("END_TIME", "end_time");
define("NAME_OF_COLUMN_IS_WAITING_IN_STATUS_TABLE", "is_waiting");





if(isset($_GET[STATUS_PARAM]) && isset($_GET[ID_ROOM_PARAM]) && isset($_GET[BREAKTIME_PARAM]) && $_GET[KEY_PARAM]==PASSWORD_API)
{
    echo RESPONSE_SUCCESS_TO_DEVICE;
    $handler = new Handler();
    $handler->set_room_id($_GET[ID_ROOM_PARAM]);
    $handler->set_staus_from_sensor_of_room($_GET[STATUS_PARAM]);
    $handler->set_is_waiting();
    $is_breack_time_of_sensor = 0;
    switch ($_GET[BREAKTIME_PARAM])
    {
        case "true": $is_breack_time_of_sensor = IS_IN_BREAK_TIME;break;
        case "false": $is_breack_time_of_sensor = IS_NOT_IN_BREAK_TIME;break;
        default: $is_breack_time_of_sensor = IS_NOT_IN_BREAK_TIME;
    }
    if (!empty($handler->get_information_by_room_in_mrbs_status()))
    {
        $handler->update_status();
        echo RESPONSE_INFO_OF_UPDATE_TO_DEVICE;
    }
    else
    {
        $handler->insert_status();
        echo RESPONSE_INFO_OF_INSERT_TO_DEVICE;
    }
    if($handler->is_this_room_booking_at_this_time($handler->get_room_id()))
    {
        echo RESPONSE_ROOM_WAS_BOOKED_TO_DEVICE;
        $handler->update_count_status_history();
        if($handler->is_not_meeting_time_nearly_finished())
        {
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $query_status = new Query();
            $query_status->setUpdating(new StatusUpdating());
            $query_status->setGetting(new StatusGetting());
            $mrbs_api_sensor_status = $query_status->select("".NAME_OF_COLUMN_ROOM_ID_IN_STATUS_TABLE." = ".$handler->get_room_id());
            if($is_breack_time_of_sensor==1)//true
            {

                $is_breack_time_of_db = $mrbs_api_sensor_status[NAME_OF_COLUMN_BREAK_TIME_IN_STATUS_TABLE];
                $current_time = strtotime(date(FORMAT_OF_DATE));
                if($is_breack_time_of_db==0)//false
                {
                    echo RESPONSE_INFO_OF_BREAK_TIME_ON_TO_DEVICE;
                    $end_break_time = $current_time + Configuration::getConfiguration()->getMaxBreakTime();
                    $mrbs_api_sensor_status[NAME_OF_COLUMN_BREAK_TIME_IN_STATUS_TABLE]=1;
                    $mrbs_api_sensor_status[NAME_OF_COLUMN_END_BREAK_TIME_IN_STATUS_TABLE]= $end_break_time;
                    $query_status->update($mrbs_api_sensor_status,"".NAME_OF_COLUMN_ROOM_ID_IN_STATUS_TABLE." = ".$handler->get_room_id());
                }
                else
                {
                    echo RESPONSE_ROOM_IS_IN_BREAK_TIME_TO_DEVICE;
                    if($mrbs_api_sensor_status[NAME_OF_COLUMN_END_BREAK_TIME_IN_STATUS_TABLE]<$current_time)
                    {
                        $mrbs_api_sensor_status[NAME_OF_COLUMN_BREAK_TIME_IN_STATUS_TABLE]=0;
                        $mrbs_api_sensor_status[NAME_OF_STATUS_HISTORY_COLUMN_IN_STATUS_TABLE]=255;
                        echo RESPONSE_END_BREAK_TIME_TO_DEVICE;
                        $query_status->update($mrbs_api_sensor_status,"".NAME_OF_COLUMN_ROOM_ID_IN_STATUS_TABLE." = ".$handler->get_room_id());
                    }
                }
            }
            else
            {
                if($mrbs_api_sensor_status[NAME_OF_COLUMN_BREAK_TIME_IN_STATUS_TABLE]==1)
                {
                    $mrbs_api_sensor_status[NAME_OF_COLUMN_BREAK_TIME_IN_STATUS_TABLE]=0;
                    $mrbs_api_sensor_status[NAME_OF_STATUS_HISTORY_COLUMN_IN_STATUS_TABLE]=255;
                    echo RESPONSE_END_BREAK_TIME_TO_DEVICE;
                    $query_status->update($mrbs_api_sensor_status,"".NAME_OF_COLUMN_ROOM_ID_IN_STATUS_TABLE." = ".$handler->get_room_id());
                }
                ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if(!$handler->is_someone_in_room())
                {
                    if($handler->is_the_room_start_up_to_eight_minutes())
                    {
                        echo ", up to 8 minutes, nobody in room";
                        $interval_time = $handler->get_start_time_and_end_time_by_current_time();
                        if($handler->edit_entry($interval_time[END_TIME]))
                        {
                            echo ", room was edited";
                            $entry = new EditEmailBody($handler->getEntry(), $handler->get_new_entry($interval_time[END_TIME]));
                            $body = $entry->create_body();
                            $handler->set_up_parameter_and_send_mail($body);
                            $handler->update_count_history_status();
                            $handler->update_is_waiting(array(NAME_OF_COLUMN_IS_WAITING_IN_STATUS_TABLE=>0));
                            echo ", check mail for more information";
                        }
                    }
                    else
                    {
                        if(Handler::$count_status_history == Configuration::getConfiguration()->getTimeSendingMail() && !Handler::$is_waiting && !$handler->is_the_room_start_up_8_minutes_from_current_time())
                        {
                            echo ", through ".Configuration::getConfiguration()->getTimeSendingMail()." minutes";
                            if(!$handler->is_someone_in_room_through_two_minutes())
                            {
                                $entry = new ConfirmEmailBody($handler->getEntry());
                                $body = $entry->create_body();
                                $handler->set_up_parameter_and_send_mail($body);
                                //print_r(Handler::$is_waiting);
                                echo ", sent confirm email";
                            }
                        }
                    }
                }
                else
                {
                    echo ", people are in the room";
                    $handler->update_is_waiting(array(NAME_OF_COLUMN_IS_WAITING_IN_STATUS_TABLE=>0));
                }
            }
        }
        else
        {
            echo ", the meeting nearly finsh, STOP BREAKTIME";
            if (!empty($handler->get_information_by_room_in_mrbs_status()))
            {
                $handler->update_count_history_status();
                echo ", update history from sensor to 0";
            }
        }
    }
    else
    {
        $result = $handler->get_information_by_room_in_mrbs_status();
        if (!empty($result)) {
            $handler->update_count_history_status();
        }
        echo ", room isn't booked";

    }
}
else
{
    echo "Fail!, Status, Roomid or Key is uncorrect or unset";
    writeLogInfo("ESP8266", "ERROR: Status, Roomid or Key is uncorrect or unset");
}
?>