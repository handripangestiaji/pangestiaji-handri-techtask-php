<?php

namespace App\Contract;

interface IngredientRepositoryInterface
{
    public function find(int $id, $lockMode = null, $lockVersion = null);
    public function findOneBy(array $criteria, array $orderBy = null);
    public function findAll();
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);
}