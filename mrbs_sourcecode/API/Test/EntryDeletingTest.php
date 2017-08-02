<?php

class EntryDeletingTest extends \PHPUnit_Framework_TestCase
{
    function test_delete_entry_through_id_entry_assert_false()
    {
        $where = "id = '556'";
        $entry_deleting = new EntryDeleting();
        $this->assertfalse($entry_deleting->delete($where));
    }

}