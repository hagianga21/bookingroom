<?php

/**
 * Created by PhpStorm.
 * User: lethuong
 * Date: 01/07/2017
 * Time: 04:11
 */
class UsersGettingTest extends PHPUnit_Framework_TestCase
{
    function testget_data_field_by_condition_should_match_email_from_users()
    {
        $gettingdatafromuser = new UsersGetting();
        $result = $gettingdatafromuser->get_data_field_by_condition( "name = 'admin'", "email");
        $result_expected = array("email"=>"cuong.test@gmail.com");
        $this-> assertEquals($result, $result_expected);
    }

    function testget_all_data_field_by_condition_should_match_data_from_DB()
    {
        $gettingdatafromuser = new UsersGetting();
        $result = $gettingdatafromuser->get_data_field_by_condition("name = 'admin'");
        $result_expected = array('id' => '1',
                    'level' => '2',
                    'name' => 'admin',
                    'password_hash' => '$2y$10$TrmLz5bbGPJ.qxgokVkANOHRRL7KGtVkWwPOzRq/w8scw4tDpZTkC',
                    'email' => 'cuong.test@gmail.com');
        $this->assertEquals($result_expected, $result);
    }

    function testget_2_data_field_by_condition_should_match_data_from_DB()
    {
        $gettingdatafromusers = new UsersGetting();
        $result = $gettingdatafromusers->get_data_field_by_condition("name = 'admin'", "id, email");
        $result_expected = array('id' => '1', 'email' => 'cuong.test@gmail.com');
        $this->assertEquals($result_expected, $result);
    }


}
