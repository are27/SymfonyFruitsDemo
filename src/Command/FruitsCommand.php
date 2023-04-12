<?php
// src/Command/FruitsCommand.php
namespace App\Command;

use App\Entity\Nutrition;
use App\Entity\Fruit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;


// the name of the command is what users type after "php bin/console"
#[AsCommand(
    name: 'app:fruits',
    description: 'retrieve fruits.',
    hidden: false,
    aliases: ['app:fruits']
)]
class FruitsCommand extends Command
{
    private $entityManager;
    private $mailer;

    private $fromEmail;
    private $toEmail;

    public function __construct(EntityManagerInterface $entityManager, MailerInterface $mailer, $fromEmail, $toEmail)
    {
        $this->entityManager = $entityManager;
        $this->mailer = $mailer;

        $this->fromEmail = $fromEmail;
        $this->toEmail = $toEmail;

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $httpClient = HttpClient::create();
        $response = $httpClient->request('GET', 'https://fruityvice.com/api/fruit/all');

        $statusCode = $response->getStatusCode();
        
        $contentType = $response->getHeaders()['content-type'][0];
                      
        $fruits = $response->toArray();
        $repository = $this->entityManager->getRepository(Fruit::class);
        $products = $repository->findAll();
        $existingFruits = [];
        // Return the array of fruits
        foreach ($products as $product) {
            $existingFruits[] =  $product->getFruitExternalId();
        }
        $count = 0;
        foreach ($fruits as $fruit) {
            if (!in_array($fruit['id'], $existingFruits)) {
                $newFruit = new Fruit();
                $newFruit->setFruitName($fruit['name']);
                $newFruit->setFruitGenus($fruit['genus']);
                $newFruit->setFruitFamily($fruit['family']);
                $newFruit->setFruitOrder($fruit['order']);
                $newFruit->setFruitExternalId($fruit['id']);
                
                $this->entityManager->persist($newFruit);
                $this->entityManager->flush();

                $newNeutrition = new Nutrition();
                $newNeutrition->setNutritionCarbohydrates($fruit['nutritions']['carbohydrates']);
                $newNeutrition->setNutritionProtein($fruit['nutritions']['protein']);
                $newNeutrition->setNutritionFat($fruit['nutritions']['fat']);
                $newNeutrition->setNutritionCalories($fruit['nutritions']['calories']);
                $newNeutrition->setNutritionSugar($fruit['nutritions']['calories']);
                $newNeutrition->setNutritionFruitId($newFruit->getId());
                $this->entityManager->persist($newNeutrition);
                $this->entityManager->flush();
                $count ++;
            }
        }
        echo $count . " new fruits created\n";
        $from = $this->fromEmail;
        $to = $this->toEmail;
        $email = (new Email())
            ->from($from)
            ->to($to)
            ->subject('Fruits List Updated!')
            ->text('For your information, ' . $count . ' new fruits created');

        $this->mailer->send($email);

        return Command::SUCCESS;
    }
}
