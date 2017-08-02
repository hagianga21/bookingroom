<?php
include_once "IInserting.php";
include_once "SingletonConnection.php";
include_once "Configuration.php";
class RoomInserting implements IInserting
{
    function insert($data_array)
    {
        $tbl_room = Configuration::getConfiguration()->getTblRoom();
        $field_list = '';
        $value_list = '';
        foreach ($data_array as $key => $value)
        {
            $field_list .= ",$key";
            if(is_null($value))
                $value_list .= ",null";
            else
                $value_list .= ",'$value'";
        }
        $sql = 'INSERT INTO '.$tbl_room. '('.trim($field_list, ',').') VALUES ('.trim($value_list, ',').')';
        if(mysqli_query(SingletonConnection::get_instance()->get_connection(), $sql))
            return true;
        else
            throw new \Exception("Please check your connection or name fields");

    }
}