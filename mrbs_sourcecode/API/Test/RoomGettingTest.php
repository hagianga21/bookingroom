<?php

/**
 * Created by PhpStorm.
 * User: lethuong
 * Date: 01/07/2017
 * Time: 09:23
 */
class RoomGettingTest extends PHPUnit_Framework_TestCase
{
    function testget_data_field_by_condition_should_match_room_name()
    {
        $gettingdatafrommrbsroom = new RoomGetting();
        $result = $gettingdatafrommrbsroom->get_data_field_by_condition("id = 2", "room_name");
        $result_expected = array("room_name" => "1L-Earth");
        $this->assertEquals($result, $result_expected);
    }

    function testget_all_data_should_match_DB_Room_id2()
    {
        $gettingdatafrommrbsroom= new RoomGetting();
        $result = $gettingdatafrommrbsroom->get_data_field_by_condition("id = 2");
        $result_expected = array(
            'id' => '2',
            'disabled' => '0',
        'area_id' => '1',
        'room_name' => '1L-Earth',
        'sort_key' => '1L-Earth',
        'description' => 'update by Unit Test',
        'capacity' => '0',
        'room_admin_email' => 'tranxuancuong.a2vd.2015@gmail.com',
        'custom_html' => null,
        );
        $this->assertEquals($result_expected, $result);
    }

    function testget_2_data_fields_should_match_data_in_mrbs_room()
    {
        $gettingdatafrommrbsroom = new RoomGetting();
        $result = $gettingdatafrommrbsroom ->get_data_field_by_condition("id = 2", "room_name, room_admin_email");
        $result_expected = array('room_name' => '1L-Earth', 'room_admin_email' => 'tranxuancuong.a2vd.2015@gmail.com');
        $this->assertEquals($result_expected, $result);
    }
}
