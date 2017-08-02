<?php
class UserDeletingTest extends \PHPUnit_Framework_TestCase
{
    function test_delete_user_through_user_name_assertTrue()
    {
        $where="name = 'abc'";
        $user_deleting = new UserDeleting();
        $this->assertTrue($user_deleting->delete($where));
    }
}