<?php

include_once "IUpdating.php";
include_once "SingletonConnection.php";
include_once "Configuration.php";
class StatusUpdating implements IUpdating
{
    function update($data, $where)
    {
        $connection = SingletonConnection::get_instance()->get_connection();

        $tbl_status = Configuration::getConfiguration()->getTblStatus();
        $query = "";
        foreach($data as $key => $value)
        {
            if(is_null($value))
                $query .= "$key = null,";
            else
                $query .= "$key = '$value',";
        }
        $query = "UPDATE ".$tbl_status." SET ".trim($query,',')." WHERE ".$where;
        if(mysqli_query($connection,$query))
        {
            if(mysqli_affected_rows($connection) > 0)
                return true;
            else
                return false;
        }

    }
}