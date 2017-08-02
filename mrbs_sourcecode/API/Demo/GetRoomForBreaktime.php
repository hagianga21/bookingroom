<?php
include "HandlerForApp.php";

$handleForApp = new HandlerForApp();

$booked_room_list = $handleForApp->get_booked_room();

if(count($booked_room_list) == 0)
{
    echo "
       <select id='room_select' disabled>
            <option value='null'>No room is booked this time!</option>
        </select>	 
    ";
}
else
{
    $room_list = $handleForApp->getAllRooms();
    
    $select_room_html = "<select id='room_select' required>";
    $select_room_html .= "<option value='null'>Your room!</option>";
    foreach ($room_list as $i => $room_entry)
    {
        foreach ($booked_room_list as $j => $booked_room)
        {
            if($room_entry["id"] == $booked_room["room_id"])
            {
                $select_room_html .= "<option value='" . $room_entry["id"] . "'>"
                                  . $room_entry["room_name"] . "</option>";
            }
        }
    }
    $select_room_html .= "</select>";

    echo $select_room_html;
}
?>