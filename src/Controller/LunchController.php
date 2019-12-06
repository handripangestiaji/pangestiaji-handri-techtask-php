<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\IngredientService;
use App\Service\RecipeService;
use App\Traits\ApiResponse;
use Symfony\Component\HttpFoundation\Request;

class LunchController extends AbstractController
{
    use ApiResponse;

    private $ingService;
    private $recipeService;

    public function __construct(IngredientService $ingService, RecipeService $recipeService)
    {
        $this->ingService = $ingService;
        $this->recipeService = $recipeService;
    }
    /**
     * @Route("/lunch", name="lunch")
     */
    public function index(Request $request)
    {
        $useBy = $request->query->get('use-by');

        $data = $this->recipeService->getAll();

        if($useBy) {
            $data = $this->recipeService->getAllGreaterThanUseBy($useBy);
        }
        
        return $this->sendSuccessResponse($data, 'Data has been retrieved successfully');
    }
}
