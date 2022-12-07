<?php

namespace Tests;

use Bluestone\Collection\Collection;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    /**
     * @test
     * @dataProvider setOfArrays
     */
    public function can_get_value($items, $expected, $key, $default = null)
    {
        $collection = new Collection($items);

        $this->assertEquals($expected, $collection->get($key, $default));
    }

    protected function setOfArrays(): array
    {
        return [
            'Named key' => [
                ['name' => 'John'],
                'John',
                'name',
            ],
            'Default value' => [
                [],
                'Undefined',
                'name',
                'Undefined',
            ],
            'Number key' => [
                ['Hello'],
                'Hello',
                0,
            ],
            'Dot notation' => [
                ['user' => ['name' => 'Jane']],
                'Jane',
                'user.name',
            ]
        ];
    }
}
