<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Fruit;
use App\Entity\Nutrition;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(EntityManagerInterface $em): Response
    {
        $repository = $em->getRepository(Fruit::class);
        $products = $repository->findAll();
        $fruits = [];
        // Return the array of fruits
        foreach ($products as $product) {
            $fruits[] =  json_encode([  'id' => $product->getId(),
                                        'name' => $product->getFruitName(),
                                        'family' => $product->getFruitFamily(),
                                        'genus' => $product->getFruitGenus()]);
        }


        return $this->render('home/index.html.twig', [
            'fruits' => $fruits
        ]);
    }

    #[Route('/favourites', name: 'app_home')]

    public function favourites(EntityManagerInterface $em): Response
    {
        if (!empty($_POST['faveList'])) {
            $repository = $em->getRepository(Fruit::class);
            $products = $repository->findBy(array('id' => json_decode($_POST['faveList'], true)));

            $neutritions = $em->getRepository(Nutrition::class);
            $neutritionInfo = $neutritions->findBy(array('nutrition_fruit_id' =>
                                                        json_decode($_POST['faveList'], true)));

            $fruits = [];
            // Return the array of fruits
            foreach ($products as $product) {
                $fruits[$product->getId()] = [ 'name' => $product->getFruitName()];
            }

            foreach ($neutritionInfo as $ni) {
                $fruit_id = $ni->getNutritionFruitId();
                $fruits[$fruit_id]['carbohydrates'] = $ni->getNutritionCarbohydrates();
                $fruits[$fruit_id]['protein'] = $ni->getNutritionProtein();
                $fruits[$fruit_id]['fat'] = $ni->getNutritionFat();
                $fruits[$fruit_id]['calories'] = $ni->getNutritionCalories();
                $fruits[$fruit_id]['sugar'] = $ni->getNutritionSugar();
            }

            $finalFruits = [];

            foreach ($fruits as $fruit) {
                $finalFruits[] = json_encode($fruit);
            }

            return $this->render('home/fav.html.twig', [
                'fruits' => $finalFruits
            ]);
        } else {
            return $this->redirect('../');
        }
    }
}
