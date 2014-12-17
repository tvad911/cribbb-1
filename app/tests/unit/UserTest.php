<?php
/**
 * Short description for the file.
 *
 * @author      Jaap Faes <jaap@komma.pro>
 * @copyright   (c) 2012-2014, Komma Mediadesign
 */

use League\FactoryMuffin\Facade as FactoryMuffin;

class UserTest extends TestCase {

    public function testUserCanFollowUsers()
    {
        $philip = FactoryMuffin::create('User');
        $jack = FactoryMuffin::create('User');
        $ev = FactoryMuffin::create('User');
        $biz = FactoryMuffin::create('User');

        // First set
        $philip->follow()->save($jack);
        // First tests
        $this->assertCount(1, $philip->follow);
        $this->assertCount(0, $philip->followers);

        // Second set
        $jack->follow()->save($ev);
        $jack->follow()->save($biz);
        // Second tests
        $this->assertCount(2, $jack->follow);
        $this->assertCount(1, $jack->followers);

        // Third set
        $ev->follow()->save($jack);
        $ev->follow()->save($philip);
        $ev->follow()->save($biz);
        // Third tests
        $this->assertCount(3, $ev->follow);
        $this->assertCount(1, $ev->followers);

        // Fourth set
        $biz->follow()->save($jack);
        $biz->follow()->save($ev);
        // Fourth tests
        $this->assertCount(2, $biz->follow);
        $this->assertCount(2, $biz->followers);
    }

}