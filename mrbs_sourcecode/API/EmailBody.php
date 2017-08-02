<?php

include_once "Query.php";
include_once "RoomGetting.php";

abstract Class EmailBody
{
    abstract function create_body();

    function get_room_name($room_id)
    {
        $query = new Query();
        $query->setGetting(new RoomGetting());
        $result = $query->select("id = $room_id", "room_name");
        return $result['room_name'];
    }

}