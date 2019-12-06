<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IngredientRepository")
 */
class Ingredient
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $use_by;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $best_before;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getUseBy(): ?\DateTimeInterface
    {
        return $this->use_by;
    }

    public function setUseBy(?\DateTimeInterface $use_by): self
    {
        $this->use_by = $use_by;

        return $this;
    }

    public function getBestBefore(): ?\DateTimeInterface
    {
        return $this->best_before;
    }

    public function setBestBefore(?\DateTimeInterface $best_before): self
    {
        $this->best_before = $best_before;

        return $this;
    }
}
