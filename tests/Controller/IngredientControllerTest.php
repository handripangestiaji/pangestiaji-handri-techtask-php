<?php

namespace App\Tests\Controller;

use PHPUnit\Framework\TestCase;
use App\Controller\IngredientController;
use App\Service\IngredientService;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class IngredientControllerTest extends TestCase
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

        $ingService = $this->getMockBuilder(IngredientService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $ingService->method('getAll')->willReturn($body);

        $appKernel = $this->getMockBuilder(KernelInterface::class)->getMock();

        $ingredient = new IngredientController($appKernel, $ingService);

        $result = $ingredient->getAll();

        $this->assertEquals($response, $result);
        
    }
}
