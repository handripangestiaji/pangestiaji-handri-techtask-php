<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Controller\RecipeController;
use App\Service\RecipeService;

class RecipeControllerTest extends TestCase
{
    public function testGetAllWillReturnJsonResponse()
    {
        $body = ['id' => 1, 'title' => 'Mock test'];

        $response = [
            'success' => true,
            'message' => 'Data has been retrieved successfully',
            'data' => $body
        ];

        $response = new JsonResponse($response, 200);

        $recipeService = $this->getMockBuilder(RecipeService::class)
            ->disableOriginalConstructor()
            ->getMock();
        
        $recipeService->method('getAll')->willReturn($body);

        $appKernel = $this->getMockBuilder(KernelInterface::class)->getMock();

        $recipe = new RecipeController($recipeService, $appKernel);

        $result = $recipe->getAll();

        $this->assertEquals($response, $result);
    }
}
