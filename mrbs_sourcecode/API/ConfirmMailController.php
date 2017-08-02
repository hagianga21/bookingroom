<?php

include_once "Query.php";
include_once "StatusUpdating.php";
include_once "EntryDeleting.php";
include_once "StatusDeleting.php";
include_once "EntryGetting.php";
include_once "Handler.php";

include_once "Configuration.php";

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $room_id = $_POST['room_id'];
    $entry_id = $_POST['id_entry'];
    $query = new Query();
    $handler = new Handler();
    if(isset($_POST['btnKeep']))
    {

        $query->setUpdating(new StatusUpdating());
        $is_updated =$query->update(array("count_status_history"=>0), "room_id = $room_id AND is_waiting = 0");
        if($is_updated && $handler->is_this_room_booking_at_this_time($room_id))
        {
            $query->setUpdating(new StatusUpdating());
            $query->update(array("is_waiting"=>1), "room_id = $room_id");
            echo "If you still not be there in ".Configuration::getConfiguration()->getLimteTimeLate()." more minutes we will delete the meeting";
        }else
        {
            echo "Already Confirm";
        }


    }
    else if (isset($_POST['btnDelete']))
    {
        $resolution = Configuration::getConfiguration()->getResolution();
        $query->setGetting(new EntryGetting());
        $result = $query->select("id = $entry_id", "end_time");
        $current_time = strtotime(date("Y-m-d H:i:s")) + $resolution;
        if($current_time > $result['end_time'])
        {
            echo "Your meeting was end";
        }
        else
        {
            $query->setDeleting(new EntryDeleting());
            if($query->delete("id = $entry_id"))
            {
                $query->setUpdating(new StatusUpdating());
                $query->update(array("count_status_history"=>0,"is_waiting"=>0), "room_id = $room_id");
                echo "Delete succesfully";
            }else
            {
                echo "Your meeting isn't exist at this time";
            }
        }


    }
    else
    {
        echo "We got some error here";
    }
}
