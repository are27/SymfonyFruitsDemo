<?php

namespace App\Entity;

use App\Repository\NutritionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NutritionRepository::class)]
class Nutrition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nutrition_fruit_id = null;

    #[ORM\Column]
    private ?float $nutrition_carbohydrates = null;

    #[ORM\Column]
    private ?float $nutrition_protein = null;

    #[ORM\Column]
    private ?float $nutrition_fat = null;

    #[ORM\Column]
    private ?int $nutrition_calories = null;

    #[ORM\Column]
    private ?float $nutrition_sugar = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNutritionFruitId(): ?int
    {
        return $this->nutrition_fruit_id;
    }

    public function setNutritionFruitId(int $nutrition_fruit_id): self
    {
        $this->nutrition_fruit_id = $nutrition_fruit_id;

        return $this;
    }

    public function getNutritionCarbohydrates(): ?float
    {
        return $this->nutrition_carbohydrates;
    }

    public function setNutritionCarbohydrates(float $nutrition_carbohydrates): self
    {
        $this->nutrition_carbohydrates = $nutrition_carbohydrates;

        return $this;
    }

    public function getNutritionProtein(): ?float
    {
        return $this->nutrition_protein;
    }

    public function setNutritionProtein(float $nutrition_protein): self
    {
        $this->nutrition_protein = $nutrition_protein;

        return $this;
    }

    public function getNutritionFat(): ?float
    {
        return $this->nutrition_fat;
    }

    public function setNutritionFat(float $nutrition_fat): self
    {
        $this->nutrition_fat = $nutrition_fat;

        return $this;
    }

    public function getNutritionCalories(): ?int
    {
        return $this->nutrition_calories;
    }

    public function setNutritionCalories(int $nutrition_calories): self
    {
        $this->nutrition_calories = $nutrition_calories;

        return $this;
    }

    public function getNutritionSugar(): ?float
    {
        return $this->nutrition_sugar;
    }

    public function setNutritionSugar(float $nutrition_sugar): self
    {
        $this->nutrition_sugar = $nutrition_sugar;

        return $this;
    }
}
