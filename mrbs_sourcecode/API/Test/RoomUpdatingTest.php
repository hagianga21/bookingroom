<?php
class RoomUpdatingTest extends \PHPUnit_Framework_TestCase
{
	function test_function_update_in_class_roomupdating_assertTrue()
	{
		$room = array();
		$room["disabled"] = 0;
		$room["area_id"] = 1;
		$room["room_name"] = "1L-Earth";
		$room["sort_key"] = "1L-Earth";
		$room["description"] = "update by Unit Test";
		$room["capacity"] = 0;
		$room["room_admin_email"] = "tranxuancuong.a2vd.2015@gmail.com";
		$room["custom_html"] = null;

		$room_updating = new RoomUpdating();

        $this->assertTrue($room_updating->update($room,"id=2"));
	}	
}
