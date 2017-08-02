<?php


class SingletonConnectionTest extends PHPUnit_Framework_TestCase
{

    function testGetInstanceShoudNotNull(){
        $this->assertInstanceOf(SingletonConnection::class, SingletonConnection::get_instance());
    }

    function testGetConnectionShouldReturnAConnection(){
        $connection = SingletonConnection::get_instance()->get_connection();
        $this->assertInstanceOf(mysqli::class, $connection);
    }
}
