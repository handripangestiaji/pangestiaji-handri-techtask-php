<?php

namespace App\Tests\Controller;

use PHPUnit\Framework\TestCase;
use App\Service\IngredientService;
use App\Service\RecipeService;
use App\Controller\LunchController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class LunchControllerTest extends TestCase
{
    public function testGetLunchWillReturnJsonResponse()
    {
        $body = ['id' => 1, 'title' => 'Mock test'];

        $response = [
            'success' => true,
            'message' => 'Data has been retrieved successfully',
            'data' => $body
        ];

        $response = new JsonResponse($response, 200);
        
        $ingService = $this->getMockBuilder(IngredientService::class)
            ->disableOriginalConstructor()
            ->getMock();
        
        $recipeService = $this->getMockBuilder(RecipeService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $request = new Request();
            
        $recipeService->method('getAll')->willReturn($body);

        $lunch = new LunchController($ingService, $recipeService);

        $result = $lunch->index($request);

        $this->assertEquals($response, $result);
    }
}
