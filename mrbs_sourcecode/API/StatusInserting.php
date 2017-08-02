<?php

include_once "IInserting.php";
include_once "SingletonConnection.php";
include_once "Configuration.php";
class StatusInserting implements IInserting
{

    function insert($data)
    {
        $tbl_status = Configuration::getConfiguration()->getTblStatus();
        $field_list = '';
        $value_list = '';
        foreach ($data as $key => $value)
        {
            $field_list .= ",$key";
            if(is_null($value))
                $value_list .= ",null";
            else
                $value_list .= ",'$value'";
        }
        $sql = 'INSERT INTO '.$tbl_status. '('.trim($field_list, ',').') VALUES ('.trim($value_list, ',').')';
        if(mysqli_query(SingletonConnection::get_instance()->get_connection(), $sql))
            return true;
        else
            return false;
    }
}

