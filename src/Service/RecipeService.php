<?php

namespace App\Service;

use App\Contract\RecipeRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Contract\IngredientRepositoryInterface;

class RecipeService
{
    private $recipeRepo;
    private $entityManager;
    private $ingRepo;

    public function __construct(
        RecipeRepositoryInterface $recipeRepo,
        EntityManagerInterface $entityManager,
        IngredientRepositoryInterface $ingRepo
    ) {
        $this->recipeRepo = $recipeRepo;
        $this->entityManager = $entityManager;
        $this->ingRepo = $ingRepo;
    }

    public function getAll() 
    {
        return $this->recipeRepo->findAllInArray();
    }

    public function getAllGreaterThanUseBy(string $useBy)
    {
        return $this->recipeRepo->findAllGreaterThanUseBy($useBy);
    }

    public function create(array $data) 
    {
        $find = $this->recipeRepo->findOneBy(array('title' => $data['title']));

        if (!$find) 
        {
            $recipe = $this->recipeRepo->add($data);

            foreach ($data['ingredients'] as $value) {
                $ingredient = $this->ingRepo->findOneBy(array('title' => $value));
                
                if (!empty((array) $ingredient)) {
                    
                    $recipe->addIngredient($ingredient);
                }
            }
            
            $this->entityManager->persist($recipe);
            $this->entityManager->flush();
        }
    }
}