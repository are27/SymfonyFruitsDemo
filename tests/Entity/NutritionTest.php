<?php
namespace App\Tests\Entity;

use App\Entity\Nutrition;
use PHPUnit\Framework\TestCase;

class NutritionTest extends TestCase
{
    public function testSettingNutritionCarbohydrates()
    {
        $nutrition = new Nutrition();
        $carbs = 1.2;

        $nutrition->setNutritionCarbohydrates($carbs);

        $this->assertEquals($carbs, $nutrition->getNutritionCarbohydrates());
    }

    public function testSettingNutritionProtein()
    {
        $nutrition = new Nutrition();
        $protein = 0.8;

        $nutrition->setNutritionProtein($protein);

        $this->assertEquals($protein, $nutrition->getNutritionProtein());
    }

    public function testSettingNutritionFat()
    {
        $nutrition = new Nutrition();
        $fat = 0.4;

        $nutrition->setNutritionFat($fat);

        $this->assertEquals($fat, $nutrition->getNutritionFat());
    }

    public function testSettingNutritionCalories()
    {
        $nutrition = new Nutrition();
        $calories = 8;

        $nutrition->setNutritionCalories($calories);

        $this->assertEquals($calories, $nutrition->getNutritionCalories());
    }

    public function testSettingNutritionSugar()
    {
        $nutrition = new Nutrition();
        $sugar = 1.3;

        $nutrition->setNutritionSugar($sugar);

        $this->assertEquals($sugar, $nutrition->getNutritionSugar());
    }
}
