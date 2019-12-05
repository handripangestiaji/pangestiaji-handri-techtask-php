<?php

namespace App\Test\Repository;

use App\Repository\FooRepository;
use App\Contract\FooRepositoryInterface;
use PHPUnit\Framework\TestCase;

class FooRepositoryTest extends TestCase
{
    public function testFooHasInstance()
    {
        $fooRepo = new FooRepository();

        $this->assertInstanceOf(FooRepositoryInterface::class, $fooRepo);
    }
}