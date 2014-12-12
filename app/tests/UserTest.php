<?php

use \League\FactoryMuffin\Facade as FactoryMuffin;

class UserTest extends PHPUnit_Framework_TestCase {

    public static function setupBeforeClass()
    {
        FactoryMuffin::loadFactories(__DIR__ . '/factories');
    }

    public static function tearDownAfterClass()
    {
        FactoryMuffin::deleteSaved();
    }

}