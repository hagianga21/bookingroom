<?php
include "Query.php";
include "RoomGetting.php";
$query_room = new Query();
$query_room->setGetting(new RoomGetting());
$list_rooms_in_data_base = $query_room->selectAll("id, room_name");
foreach ($list_rooms_in_data_base as $room)
{
    echo "<tr><td>".$room["id"]."</td><td>".$room["room_name"]."</td></tr>";
}