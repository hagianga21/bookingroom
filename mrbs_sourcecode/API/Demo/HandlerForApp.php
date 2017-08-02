<?php
include "../Handler.php";
include_once "../Query.php";
include_once "../RoomGetting.php";
define("ROOM_ID_LIMIT", 15);

class HandlerForApp
{

    private $query = null;
    private $handle = null;

    function __construct()
    {
        $this->query = new Query();
        $this->handle = new Handler();
    }




    function getAllRooms()
    {
        $this->query->setGetting(new RoomGetting());

        $room_list = $this->query->selectList(" id < ".ROOM_ID_LIMIT, "id, room_name");
        if (!empty($room_list))
        {
            return $room_list;
        }
        else
            return array();

    }

    function get_human_status_in_booked_room()
    {
        $this->query->setGetting(new StatusGetting());
        $status_room = $this->query->selectAll("room_id, status_history");
        if(!empty($status_room))
            return $status_room;
        else
            return array();
    }

    function check_human_in_room_from_sensor($status_history)
    {
        $this->handle->set_staus_from_sensor_of_room($status_history);
        $result = $this->handle->is_someone_in_room();
        if ($result)
            return "true";
        else
            return "false";
    }

    function get_booked_room()
    {
        $this->query->setGetting(new EntryGetting());
        $interval_time = $this->handle->get_start_time_and_end_time_by_current_time();

        $condition = " start_time < '".$interval_time['end_time']. "' AND end_time > '".$interval_time['start_time']."'";
        $entry = $this->query->selectList($condition, "room_id");

        if(!empty($entry))
        {
            return $entry;
        }
        else
            return array();
    }



}
