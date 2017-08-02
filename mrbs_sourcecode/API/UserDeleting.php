<?php
include_once "IDeleting.php";
include_once "SingletonConnection.php";
include_once "Configuration.php";
class UserDeleting implements IDeleting
{
    function delete($where)
    {
        //global $tbl_users;
        $tbl_users = Configuration::getConfiguration()->getTblUsers();
        $query = "DELETE FROM $tbl_users WHERE $where";
        if(mysqli_query(SingletonConnection::get_instance()->get_connection(), $query))
            return true;
        else
            throw new Exception(mysqli_error(SingletonConnection::get_instance()->get_connection()));
    }
}