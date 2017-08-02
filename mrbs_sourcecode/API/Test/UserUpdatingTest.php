<?php

class UserUpdatingTest extends \PHPUnit_Framework_TestCase
{
    public function test_function_update_in_class_userupdating_assertTrue()
    {
        $user = array();
        $user["id"]="1";
        $user["level"]="2";
        $user["email"]="cuong.test@gmail.com";

        $userupdating = new UserUpdating();
        $this->assertTrue($userupdating->update($user,"name='admin'"));
    }
}