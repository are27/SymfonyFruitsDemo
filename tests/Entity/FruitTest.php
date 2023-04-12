<?php
namespace App\Tests\Entity;

use App\Entity\Fruit;
use PHPUnit\Framework\TestCase;

class FruitTest extends TestCase
{
    public function testSettingFruitName()
    {
        $fruit = new Fruit();
        $fruitName = "Purpletron";

        $fruit->setFruitName($fruitName);

        $this->assertEquals($fruitName, $fruit->getFruitName());
    }

    public function testSettingFruitGenus()
    {
        $fruit = new Fruit();
        $fruitGenus = "Oddus";

        $fruit->setFruitGenus($fruitGenus);

        $this->assertEquals($fruitGenus, $fruit->getFruitGenus());
    }

    public function testSettingFruitFamily()
    {
        $fruit = new Fruit();
        $family = "Odd";

        $fruit->setFruitFamily($family);

        $this->assertEquals($family, $fruit->getFruitFamily());
    }

    public function testSettingFruitOrder()
    {
        $fruit = new Fruit();
        $order = "Oddling";

        $fruit->setFruitOrder($order);

        $this->assertEquals($order, $fruit->getFruitOrder());
    }
}
