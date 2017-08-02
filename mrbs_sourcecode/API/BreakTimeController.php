<?php
include "Query.php";
include "StatusUpdating.php";

if(isset($_POST['break_time']) && isset($_POST['roomd_id']))
{
    $time = $_POST['break_time'];
    $room_id = $_POST['roomd_id'];

    $current_time = strtotime(date("Y-m-d H:i:s"));
    $query = new Query();
    $query->setUpdating(new StatusUpdating());
    $query->update(array("is_break_time"=>1, "end_break_time"=>$time), "room_id = ".$current_time + $time."");
}