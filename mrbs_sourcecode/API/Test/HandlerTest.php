<?php

/**
 * Created by PhpStorm.
 * User: thuong.t.le
 * Date: 7/25/2017
 * Time: 2:30 PM
 */
class HandlerTest extends PHPUnit_Framework_TestCase
{
    function create_handle_to_test_sensor_inform_having_somebody()
    {
        $handle = new Handler(2, 255);
        return $handle;
    }

    function create_handle_to_test_sensor_inform_nobody()
    {
        $handle = new Handler(3, 0);
        return $handle;
    }

    function testIs_some_one_in_room_should_return_true_if_having_body()
    {
        $handleTest = $this->create_handle_to_test_sensor_inform_having_somebody();
        $result = $handleTest->is_someone_in_room();

        $this->assertTrue($result);
    }

    function testIs_some_one_in_room_should_return_false_if_nobody_in_room()
    {
        $handleTest = $this->create_handle_to_test_sensor_inform_nobody();
        $result = $handleTest->is_someone_in_room();
        $this->assertFalse($result);
    }

    function testIs_room_in_the_breaktime_should_return_false_if_Room_is_not_in_break_time()
    {
        $handleTest = $this->create_handle_to_test_sensor_inform_nobody();
        $result = $handleTest->is_in_break_time();
        $this->assertFalse($result);
    }

   //Missing function test Is_room_in_break_time false

    function testGet_room_id_should_return_valid_email()
    {
        $hanleTest = $this->create_handle_to_test_sensor_inform_having_somebody();
        $result = $hanleTest->get_room_id();
        $result_expected = 2;
        $this->assertEquals($result_expected, $result);
    }

    /**
     * @expectedException        \Exception
     * @expectedExceptionMessage Room_id is empty
     */
    function testGet_room_id_shoud_throw_exception_in_case_Donot_have_room_id()
    {
        $handleTest = new Handler(null, 255);
        $handleTest->get_room_id();
    }

    /**
     * @expectedException        \Exception
     * @expectedExceptionMessage Set room_id fail
     */
    function testSet_room_id_should_throw_exception()
    {
        $handleTest = $this->create_handle_to_test_sensor_inform_nobody();
        $handleTest->set_room_id(-3);
    }

    function testGet_staus_from_sensor_of_room_should_return_valid_status()
    {
        $handleTest = $this->create_handle_to_test_sensor_inform_having_somebody();
        $result = $handleTest->get_staus_from_sensor_of_room();
        $result_expected = 255;
        $this->assertEquals($result_expected, $result);
    }

    /**
     * @expectedException        \Exception
     * @expectedExceptionMessage status is null
     */
    function testGet_staus_from_sensor_of_room_should_throw_exception_in_case_status_is_null()
    {
        $handleTest = new Handler(2, null);
        $handleTest->get_staus_from_sensor_of_room();
    }

    /**
     * @expectedException        \Exception
     * @expectedExceptionMessage status should more than 0
     */
    function testSet_staus_from_sensor_of_room_shoud_throw_exception_in_case_invalid_status()
    {
        $handleTest = $this->create_handle_to_test_sensor_inform_having_somebody();
        $handleTest->set_staus_from_sensor_of_room(-3);
    }


    /*function testIs_this_room_booking_at_this_time_should_return_false_in_case_room_isnot_booked()
    {
        $handleTest = $this->create_handle_to_test_sensor_inform_having_somebody();
        $result = $handleTest->is_this_room_booking_at_this_time(3);
        $this->assertFalse($result);

    }

    function testIs_this_room_booking_at_this_time_should_return_true_in_case_this_room_is_booking()
    {
        $hanleTest = $this->create_handle_to_test_sensor_inform_having_somebody();
        $result = $hanleTest->is_this_room_booking_at_this_time(2);
        $this->assertTrue($result);
    }*/

    /*function testGet_start_time_and_end_time_by_current_time_should_return_right_value()
    {
        $handleTest = $this->create_handle_to_test_sensor_inform_having_somebody();
        $result = $handleTest->get_start_time_and_end_time_by_current_time();
        $result_expected = array( 'start_time' => 1501064100,'end_time' => 1501065000);
        $this->assertEquals($result_expected, $result);
    }*/

    /*function testIs_not_meeting_time_nearly_finished_should_be_return_false_in_case_endtime_more_than_current_time_a_part_of_resolutions()
    {
        $handleTest = $this->create_handle_to_test_sensor_inform_having_somebody();
        $handleTest->is_this_room_booking_at_this_time($handleTest->get_room_id());
        $result = $handleTest->is_not_meeting_time_nearly_finished();
        $this->assertTrue($result);
    }*/

    /*function testIs_not_meeting_time_nearly_finished_should_be_return_true_in_case_endtime_less__than_current_time_a_part_of_resolutions()
    {
        $handleTest = $this->create_handle_to_test_sensor_inform_having_somebody();
        $handleTest->is_this_room_booking_at_this_time($handleTest->get_room_id());
        $result = $handleTest->is_not_meeting_time_nearly_finished();
        $this->assertFalse($result);
    }*/

    /*function testIs_the_room_start_up_to_eight_minutes_should_return_true_in_case_start_time_more_than_8_minutes()
    {
        $handleTest = $this->create_handle_to_test_sensor_inform_nobody();
        $handleTest->is_this_room_booking_at_this_time($handleTest->get_room_id());
        $result = $handleTest->is_the_room_start_up_to_eight_minutes();
        $this->assertTrue($result);

    }

    function testIs_the_room_start_up_to_eight_minutes_should_return_false_in_case_start_time_less_than_8_minutes()
    {
        $handleTest = $this->create_handle_to_test_sensor_inform_having_somebody();
        $handleTest->is_this_room_booking_at_this_time($handleTest->get_room_id());
        $result = $handleTest->is_the_room_start_up_to_eight_minutes();
        $this->assertFalse($result);
    }*/

    function testGet_email_booker_should_return_value_email_in_case_enter_valid_username()
    {
        $handleTest = $this->create_handle_to_test_sensor_inform_having_somebody();
        $result = $handleTest->get_email_booker("admin");
        $result_expected = "cuong.test@gmail.com";
        $this->assertEquals($result_expected, $result);
    }

    /**
     * @expectedException        \Exception
     * @expectedExceptionMessage Undefined index: email
     */
    function testGet_email_booker_should_throw_exception_in_case_invalid_name_booker()
    {
        $handleTest = $this->create_handle_to_test_sensor_inform_having_somebody();
        $handleTest->get_email_booker("abc");

    }

    function testHandle_status_should_return_somebody_when_status_255()
    {
        $handleTest = $this->create_handle_to_test_sensor_inform_having_somebody();
        $result = $handleTest->handle_status();
        $result_expected = 1;
        $this->assertEquals($result_expected, $result);
    }

    function testHandle_status_should_return_nobody_in_case_status_0()
    {
        $handleTest = $this->create_handle_to_test_sensor_inform_nobody();
        $result = $handleTest->handle_status();
        $result_expected = 0;
        $this->assertEquals($result_expected, $result);
    }

    function testHeuricstic_should_return_valid_score_in_case_nobody()
    {
        $handleTest = $this->create_handle_to_test_sensor_inform_nobody();
        $result = $handleTest->Heuricstic();
        $result_expected = 280;
        $this->assertEquals($result_expected, $result);
    }

    function testHeuricstic_should_return_valid_score_in_case_having_somebody()
    {
        $handleTest = $this->create_handle_to_test_sensor_inform_having_somebody();
        $result = $handleTest->Heuricstic();
        $result_expected = 700;
        $this->assertEquals($result_expected, $result);
    }

    function testMaybe_some_one_in_room_should_return_0_in_case_nobody_in_room()
    {
        $handleTest = $this->create_handle_to_test_sensor_inform_nobody();
        $result= $handleTest->maybe_some_one_in_room();
        $result_expected = 0;
        $this->assertEquals($result_expected, $result);
    }

    function testMaybe_some_one_in_room_should_return_1_in_case_having_somebody_in_room()
    {
        $handleTest = $this->create_handle_to_test_sensor_inform_having_somebody();
        $result= $handleTest->maybe_some_one_in_room();
        $result_expected = 1;
        $this->assertEquals($result_expected, $result);
    }

    function testNobody_in_room_should_return_0_in_case_nobody_in_room()
    {
        $handleTest = $this->create_handle_to_test_sensor_inform_nobody();
        $result= $handleTest->maybe_some_one_in_room();
        $result_expected = 0;
        $this->assertEquals($result_expected, $result);
    }

    function testNobody_in_room_should_return_1_in_case_sơmebody_in_room()
    {
        $handleTest = $this->create_handle_to_test_sensor_inform_having_somebody();
        $result= $handleTest->maybe_some_one_in_room();
        $result_expected = 1;
        $this->assertEquals( $result_expected, $result);
    }

    /*function testGet_new_enttry_should_return_right_value()
    {
        $handleTest = $this->create_handle_to_test_sensor_inform_nobody();
        $handleTest->is_this_room_booking_at_this_time($handleTest->get_room_id());
        $result = $handleTest -> get_new_entry(1501138800);
        $result_expected =  array(
              'id' => '897',
                    'start_time' => '1501114500',
      'end_time' => 1501138800,
        'entry_type' => '0',
        'repeat_id' => null,
        'room_id' => '3',
        'timestamp' => '2017-07-27 13:37:16',
        'create_by' => 'TitanAdmin' ,
        'modified_by' => 'ESP8266',
        'name' => 'nem test get new entry',
        'type' => 'I',
       'description' => '',
        'status' => '0',
        'reminded' => null,
        'info_time' => null,
        'info_user' => null,
        'info_text' => null,
        'ical_uid' => 'MRBS-59798925bf6ca-7fcb7e76@192.168.122.26',
        'ical_sequence' => 2,
        'ical_recur_id' => null
         );
        $this->assertEquals($result_expected, $result);
    }*/


    function testGet_information_by_room_in_mrbs_status_should_return_data_about_room_id_3()
    {
        $handleTest = $this->create_handle_to_test_sensor_inform_nobody();
        $result = $handleTest->get_information_by_room_in_mrbs_status();
        $result_expected = array('id' => '195',
              'status_history' => '0',
        'count_status_history' => '0',
        'room_id' => '3',
        'is_waiting' => '0',
        'is_break_time' => '0',
        'end_break_time' => null );
        $this->assertEquals($result_expected, $result);
    }

    function testConvert_status_should_return_valid_status()
    {
        $hanleTest = $this->create_handle_to_test_sensor_inform_nobody();
        $result = $hanleTest->convert_status($hanleTest->get_information_by_room_in_mrbs_status()["status_history"]);
        $result_expected = 0;
        $this->assertEquals($result_expected, $result);
    }

}
