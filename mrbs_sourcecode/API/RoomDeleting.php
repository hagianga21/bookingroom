<?php
include_once "IDeleting.php";
include_once "SingletonConnection.php";
include_once "Configuration.php";
class RoomDeleting implements IDeleting
{
    function delete($where)
    {
        //global $tbl_room;
        $tbl_room = Configuration::getConfiguration()->getTblRoom();
        $query = "DELETE FROM $tbl_room WHERE $where";
        if(mysqli_query(SingletonConnection::get_instance()->get_connection(), $query))
            return true;
        else
            throw new Exception(mysqli_error(SingletonConnection::get_instance()->get_connection()));
    }
}