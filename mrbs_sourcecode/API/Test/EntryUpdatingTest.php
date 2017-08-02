<?php
class EntryUpdatingTest extends \PHPUnit_Framework_TestCase
{
    function test_function_update_in_class_entry_updating_assertTrue()
    {
        $entry = array();
        $entry["start_time"]="1499212800";
        $entry["end_time"]="1499229000";
        $entry["modified_by"]="unit test";
        $entry_updating = new EntryUpdating();
        $this->assertTrue($entry_updating->update($entry,"id=554"));
    }
}