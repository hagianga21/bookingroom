<?php

class RoomInsertingTest extends PHPUnit_Framework_TestCase
{

//    function testInsertShouldReturnTrue(){
//        $entry = new RoomInserting();
//        $data = array("area_id"=>"1", "room_name"=>"test","sort_key"=>"test",
//            "room_admin_email"=>"tranxuancuong.a2vd.2015@gmail.com");
//        $result = $entry->insert($data);
//        $this->assertTrue($result);
//    }

    /**
     * @expectedException           \Exception
     * @expectedExceptionMessage    Please check your connection or name fields
     */
    function testInsertShouldThrowExceptionWhenWrongFieldInputFormat(){
        $entry = new RoomInserting();
        $data = array("area_id_wrong_name"=>"1", "room_name"=>"test","sort_key"=>"test",
            "room_admin_email"=>"tranxuancuong.a2vd.2015@gmail.com");
        $entry->insert($data);
    }

}
