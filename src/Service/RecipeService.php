<?php

namespace App\Service;

use App\Contract\RecipeRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class RecipeService
{
    private $recipeRepo;
    private $entityManager;

    public function __construct(
        RecipeRepositoryInterface $recipeRepo,
        EntityManagerInterface $entityManager
    ) {
        $this->recipeRepo = $recipeRepo;
        $this->entityManager = $entityManager;
    }

    public function getAll() 
    {
        return $this->recipeRepo->findAll();
    }

    public function create(array $data) 
    {
        $find = $this->recipeRepo->findOneBy(array('title' => $data['title']));

        if (!$find) 
        {
            $recipe = $this->recipeRepo->add($data);

            $this->entityManager->persist($recipe);
            $this->entityManager->flush();
        }
    }
}