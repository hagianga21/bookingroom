<?php

class EntryInsertingTest extends PHPUnit_Framework_TestCase
{

//    function testInsertShouldReturnTrue(){
//        $entry = new EntryInserting();
//        $start_time = strtotime(date("2017-07-05 10:30"));
//        $end_time = strtotime(date("2017-07-05 11:00"));
//        $time_stamp = date("Y-m-d H:i:s");
//        $data = array("start_time"=>"$start_time", "end_time"=>"$end_time","room_id"=>2,
//            "timestamp"=>$time_stamp, "create_by"=>"UnitTest", "name"=>"unitest", "type"=>"I","description"=>"unitest1" );
//        $result = $entry->insert($data);
//        $this->assertTrue($result);
//    }

    /**
     * @expectedException           \Exception
     * @expectedExceptionMessage    Please check your connection or name fields
     */
    function testInsertShouldThrowExceptionWhenWrongFieldInputFormat(){
        $entry = new RoomInserting();
        $start_time = strtotime(date("2017-07-05 10:30"));
        $end_time = strtotime(date("2017-07-05 11:00"));
        $time_stamp = date("Y-m-d H:i:s");
        $data = array("start_time_wrong_name"=>"$start_time", "end_time"=>"$end_time","room_id"=>2,
            "timestamp"=>$time_stamp, "create_by"=>"UnitTest", "name"=>"unitest", "type"=>"I","description"=>"unitest1" );
        $entry->insert($data);
    }

}
