<?php
include_once "IUpdating.php";
include_once "SingletonConnection.php";
include_once "Configuration.php";
class RoomUpdating implements IUpdating
{
	public function update($data,$where)
    {
        $tbl_room = Configuration::getConfiguration()->getTblRoom();
        $query = "";
        foreach ($data as $key => $value) {
            if (is_null($value))
                $query .= "$key = null,";
            else
                $query .= "$key = '$value',";
        }
        $query = "UPDATE " . $tbl_room . " SET " . trim($query, ',') . " WHERE " . $where;
        if (mysqli_query(SingletonConnection::get_instance()->get_connection(), $query))
            return true;
        else
            throw new \Exception(mysqli_error(SingletonConnection::get_instance()->get_connection()));
    }
}
