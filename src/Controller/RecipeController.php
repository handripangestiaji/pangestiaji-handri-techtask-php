<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\KernelInterface;
use App\Service\RecipeService;
use App\Traits\ApiResponse;

/**
 * @Route("/recipe", name="recipe")
 */
class RecipeController extends AbstractController
{
    use ApiResponse;

    private $recipeService;
    private $appKernel;

    public function __construct(
        RecipeService $recipeService,
        KernelInterface $appKernel
    ) {
        $this->recipeService = $recipeService;
        $this->appKernel = $appKernel;
    }

    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/RecipeController.php',
        ]);
    }

    /**
     * @Route("/insert-data")
     */
    public function insertData()
    {
        $file = $this->appKernel->getProjectDir() . '/data/' . 'recipe.json';
        $content = file_get_contents($file);
        $obj = json_decode($content, 1);

        if (!empty($obj)) {
            foreach ($obj['recipes'] as $val) {
                $this->recipeService->create($val);
            }
        }

        return $this->sendSuccessResponse([], 'Data has been insert successfully');
    }
}
