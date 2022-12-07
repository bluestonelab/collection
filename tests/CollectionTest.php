<?php

namespace Tests;

use Bluestone\Collection\Collection;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    /** @test */
    public function can_say_hello()
    {
        $collection = new Collection();

        $this->assertEquals('Hello !', $collection->sayHello());
    }
}
