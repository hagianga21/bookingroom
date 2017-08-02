<?php

class EntryGettingTest extends PHPUnit_Framework_TestCase
{
    function testget_a_data_field_by_condition_should_match_roomid_in_DB()
    {
        $gettingfrommrbsentry = new EntryGetting();
        $result = $gettingfrommrbsentry->get_data_field_by_condition("room_id = 4", "room_id");
        $result_expected = array('room_id' => '4');
        $this->assertEquals($result_expected, $result);
    }

    function testget_all_data_field_by_condition_should_match_entryid7_from_DB()
    {
        $gettingfrommrbsentry = new EntryGetting();
        $result = $gettingfrommrbsentry->get_data_field_by_condition("id = 730");
        $result_expected = array(
          'id' => '730',
        'start_time' => '1500336900',
        'end_time' => '1500373800',
        'entry_type' => '0',
        'repeat_id' => null,
       'room_id' => '5',
       'timestamp' => '2017-07-18 14:19:00',
       'create_by' => 'nhan',
       'modified_by' => 'nhan',
       'name' => 'hhhh',
       'type' => 'I',
       'description' => '',
       'status' => '0',
       'reminded' => null,
       'info_time' => null,
        'info_user' => null,
        'info_text' => null,
       'ical_uid' => 'MRBS-596db658f2451-98bbf196@192.168.122.26',
       'ical_sequence' => '1',
        'ical_recur_id' => null,

        );

        $this->assertEquals( $result_expected, $result);
    }

    function testget_2_data_field_by_condition_should_match_data_from_DB_entry()
    {
        $gettingdatafromentry = new EntryGetting();
        $result = $gettingdatafromentry->get_data_field_by_condition("id = 730", "room_id, start_time");
        $result_expected = array('room_id' => '5', 'start_time' => '1500336900');
        $this->assertEquals($result_expected, $result);
    }

}
