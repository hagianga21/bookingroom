<?php

include_once "IDeleting.php";
include_once "SingletonConnection.php";
include_once "Configuration.php";
class StatusDeleting implements IDeleting
{

    function delete($where)
    {
        $tbl_status = Configuration::getConfiguration()->getTblStatus();
        $sql = "DELETE FROM $tbl_status WHERE $where";
        if($result = mysqli_query(SingletonConnection::get_instance()->get_connection(), $sql))
            return true;
        else
            return false;
    }
}