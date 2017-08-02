<?php

include_once "IDeleting.php";
include_once "SingletonConnection.php";
include_once "Configuration.php";

class EntryDeleting implements IDeleting
{
    function delete($where)
    {
        //global $tbl_entry;
        $connection = SingletonConnection::get_instance()->get_connection();
        $tbl_entry = Configuration::getConfiguration()->getTblEntry();

        $query = "DELETE FROM $tbl_entry WHERE $where";
        if(mysqli_query($connection, $query))
        {
            if(mysqli_affected_rows($connection) > 0){
                return true;
            }else{
                return false;
            }
        }

    }
}