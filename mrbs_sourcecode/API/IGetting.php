<?php

/**
 * Created by PhpStorm.
 * User: lethuong
 * Date: 01/07/2017
 * Time: 00:54
 */
interface IGetting
{
    function get_data_field_by_condition( $string_condition, $string_value_expected);
    function get_list_field_by_condition($string_condition, $string_value_expected);
    function get_all_data($string_value_expected);
}