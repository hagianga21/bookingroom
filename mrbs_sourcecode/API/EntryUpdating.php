<?php

include_once "IUpdating.php";
include_once "SingletonConnection.php";
include_once "Configuration.php";
class EntryUpdating implements IUpdating
{
	public function update($data,$where)
	{
        $tbl_entry = Configuration::getConfiguration()->getTblEntry();
		$query = "";
		foreach($data as $key => $value)
		{
			if(is_null($value))
				$query .= "$key = null,";
			else
				$query .= "$key = '$value',";
		}
		$query = "UPDATE ".$tbl_entry." SET ".trim($query,',')." WHERE ".$where;
		if(mysqli_query(SingletonConnection::get_instance()->get_connection(),$query))
			return true;
		else
			return false;
	}
}
