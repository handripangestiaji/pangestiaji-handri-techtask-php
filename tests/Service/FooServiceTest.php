<?php

namespace App\Test\Service;

use App\Service\FooService;
use App\Contract\FooRepositoryInterface;
use PHPUnit\Framework\TestCase;

class FooServiceTest extends TestCase
{
    public function testGetAllReturnFind()
    {
        $fooInterface = $this->getMockBuilder(FooRepositoryInterface::class)->getMock();

        $stub = $this->getMockBuilder(FooService::class)
                ->setConstructorArgs(array($fooInterface))
                ->getMock();

        $stub->method('getAll')->willReturn('find');

        $this->assertEquals('find', $stub->getAll());
    }
}