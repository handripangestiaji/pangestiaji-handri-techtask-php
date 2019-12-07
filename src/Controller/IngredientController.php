<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\KernelInterface;
use App\Service\IngredientService;
use App\Traits\ApiResponse;

 /**
 * @Route("/ingredient", name="ingredient")
 */
class IngredientController extends AbstractController
{
    use ApiResponse;

    private $appKernel;
    private $ingService;

    public function __construct(
        KernelInterface $appKernel,
        IngredientService $ingService
    ) {
        $this->appKernel = $appKernel;
        $this->ingService = $ingService;
    }
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/IngredientController.php',
        ]);
    }

    /**
     * @Route("/insert-data")
     */
    public function insertData()
    {
        $file = $this->appKernel->getProjectDir() . '/data/' . 'ingredient.json';
        $content = file_get_contents($file);
        $obj = json_decode($content, 1);

        if (!empty($obj)) {
            foreach ($obj['ingredients'] as $val) {
                $this->ingService->create($val);
            }
        }

        return $this->sendSuccessResponse([], 'Data has been insert successfully');
    }

    public function getAll()
    {
        $result = $this->ingService->getAll();

        return $this->sendSuccessResponse($result, 'Data has been retrieved successfully');
    }
}
