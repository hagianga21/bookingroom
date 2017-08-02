<?php

include_once "IGetting.php";
include_once "SingletonConnection.php";
include_once "Configuration.php";
class UsersGetting implements IGetting
{

    function get_data_field_by_condition($string_condition,$string_value_expected="*")
    {
        $tbl_users = Configuration::getConfiguration()->getTblUsers();
        $sql = "SELECT $string_value_expected FROM $tbl_users WHERE ". $string_condition;
        $result = mysqli_query(SingletonConnection::get_instance()->get_connection(), $sql);
        $result_value = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        if($result_value)
            return $result_value;
        else
            return array();

    }


    function get_list_field_by_condition($string_condition, $string_value_expected)
    {
        $tbl_users = Configuration::getConfiguration()->getTblUsers();
        $sql = "SELECT $string_value_expected FROM $tbl_users WHERE ". $string_condition;

        $result = mysqli_query(SingletonConnection::get_instance()->get_connection(), $sql);

        $result_value = array();
        while($row = mysqli_fetch_assoc($result))
        {
            $result_value[] = $row;
        };
        mysqli_free_result($result);
        if($result_value)
            return $result_value;
        else
            return array();
    }

    function get_all_data($string_value_expected)
    {
        $tbl_users = Configuration::getConfiguration()->getTblUsers();
        $sql = "SELECT $string_value_expected FROM $tbl_users ";

        $result = mysqli_query(SingletonConnection::get_instance()->get_connection(), $sql);

        $result_value = array();
        while($row = mysqli_fetch_assoc($result))
        {
            $result_value[] = $row;
        };
        mysqli_free_result($result);
        if($result_value)
            return $result_value;
        else
            return array();
    }
}

