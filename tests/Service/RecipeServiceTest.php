<?php

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\RecipeService;
use App\Contract\RecipeRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Contract\IngredientRepositoryInterface;

class RecipeServiceTest extends TestCase
{
    public function testHandlingReturnRecipeService()
    {
        $recipeRepo = $this->getMockBuilder(RecipeRepositoryInterface::class)->getMock();
        $em = $this->getMockBuilder(EntityManagerInterface::class)->getMock();
        $ingRepo = $this->getMockBuilder(IngredientRepositoryInterface::class)->getMock();

        $recipeService = $this->getMockBuilder(RecipeService::class)
            ->setConstructorArgs(array($recipeRepo, $em, $ingRepo))
            ->getMock();

        $arr = array();
        $recipeService->method('getAll')->willReturn($arr);

        $this->assertEquals(array(), $recipeService->getAll());
    }
}
