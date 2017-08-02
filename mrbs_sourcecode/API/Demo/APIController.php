<?php
include "HandlerForApp.php";

$handleForApp = new HandlerForApp();

$room_list = $handleForApp->getAllRooms();
$status_room = $handleForApp->get_human_status_in_booked_room();
$booked_room_list = $handleForApp->get_booked_room();


if(count($status_room) == 0)
    $status_room[] = array("room_id" => null, "status_history" => null);
if(count($booked_room_list) ==0)
    $booked_room_list = array("room_id" => null);

$new_array = array();
foreach ($room_list as $i => $room_entry)
{

    foreach ($status_room as $j => $status_entry)
    {
        if ($room_entry["id"] == $status_entry["room_id"])
        {
            $room_entry["humanstatus"] = ($status_entry["status_history"] & 0x01) ? "true" : "false" ;
            break;
        }
        else
        {
            $room_entry["humanstatus"] = "false";

        }
    }

    foreach ($booked_room_list as $k => $booked_room)
    {
        if($room_entry["id"] == $booked_room["room_id"])
        {
            $room_entry["bookedstatus"] = "true";
            break;
        }
        else
        {
            $room_entry["bookedstatus"] = "false";
        }
    }

    $new_array[]= $room_entry;
}

$json_array = array(API=>$new_array);

echo json_encode($json_array);






