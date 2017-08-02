<?php

/**
 * Created by PhpStorm.
 * User: lethuong
 * Date: 01/07/2017
 * Time: 09:38
 */
class StatusGettingTest extends PHPUnit_Framework_TestCase
{
    function testget_data_by_condition_should_match_roomid_DB_status()
    {
        $gettingdatafrommrbsstatus = new StatusGetting();
        $result = $gettingdatafrommrbsstatus->get_data_field_by_condition("room_id = 2", "room_id");
        $result_expected = array("room_id" => "2");
        $this->assertEquals($result_expected, $result);
    }

}
