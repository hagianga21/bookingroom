<?php
class RoomDeletingTest extends \PHPUnit_Framework_TestCase
{
    function test_delete_room_through_room_name_assertTrue()
    {
        $where = "room_name =  'VC5'";
        $room_deleting = new RoomDeleting();
        $this->assertTrue($room_deleting->delete($where));
    }
}