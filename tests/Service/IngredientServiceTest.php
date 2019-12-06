<?php

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\IngredientService;
use App\Contract\IngredientRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class IngredientServiceTest extends TestCase
{
    public function testHandlingReturn()
    {
        $ingRepo = $this->getMockBuilder(IngredientRepositoryInterface::class)->getMock();
        $em = $this->getMockBuilder(EntityManagerInterface::class)->getMock();

        $ingService = $this->getMockBuilder(IngredientService::class)
            ->setConstructorArgs(array($ingRepo, $em))
            ->getMock();

        $arr = array();

        $ingService->method('getAll')->willReturn($arr);

        $this->assertEquals(array(), $ingService->getAll());
    }
}
