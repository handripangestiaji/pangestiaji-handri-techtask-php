<?php

namespace App\Service;

use App\Entity\Ingredient;
use App\Contract\IngredientRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class IngredientService
{
    private $ingRepo;
    private $entityManager;

    public function __construct(
        IngredientRepositoryInterface $ingRepo,
        EntityManagerInterface $entityManager
    ) {
        $this->ingRepo = $ingRepo;
        $this->entityManager = $entityManager;
    }

    public function getAll()
    {
        return $this->ingRepo->findAll();
    }

    public function create(array $data)
    {
        $find = $this->ingRepo->findOneBy(array('title' => $data['title']));
        
        if (!$find)
        {
            $ingredient = $this->ingRepo->add($data);

            $this->entityManager->persist($ingredient);
            $this->entityManager->flush();
        }
    }
}