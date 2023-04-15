<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Product;
use App\Entity\Category;
use Faker\Provider\Lorem;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\Provider\SapesProvider;
use Doctrine\DBAL\Connection;

class AppFixtures extends Fixture
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection= $connection;
    }

    public function truncate() {

        $this->connection->executeQuery('SET foreign_key_checks = 0');
        $this->connection->executeQuery('TRUNCATE TABLE category');
        $this->connection->executeQuery('TRUNCATE TABLE product');
        $this->connection->executeQuery('TRUNCATE TABLE user');

    }

    public function load(ObjectManager $manager): void
    {
        $this->truncate();

        $faker = Factory::create('fr_FR');

        // On fournit au faker un Provider

        $faker->addProvider(new SapesProvider());

        // Categories

        // Array for our categories
        $categoriesList = [];

        for ($c = 1 ; $c <= 12; $c++) {
            $category = new Category();
            $category->setName($faker->unique()->productCategory());
            $category->setPicture('https://picsum.photos/id/' . $c . '/150/100');
            $category->setDescription('Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eveniet, quod blanditiis quasi ut officiis ipsa vero.');
        
            $categoriesList[] = $category;
            $manager->persist($category);
        }

        // Products

        // Array for our products
        $productsList = [];

        for($p = 1; $p <= 100; $p++) {

            $product = new Product();
            $product->setName('product'. $p);
            $product->setDescription('Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eveniet, quod blanditiis quasi ut officiis ipsa vero eius nihil repellendus labore aperiam, delectus id, amet iusto.');
            $product->setPictures(['https://picsum.photos/id/' . $p . '/150/100', 'https://picsum.photos/id/' . $p . '/150/100']);
            $product->setGender($faker->randomElement(['Homme', 'Femme']));
            $product->setColor($faker->randomElement(['Noir', 'Blanc', 'Bleu Clair', 'Rouge', 'Jaune', 'Vert', 'Gris', 'Kaki']));
            $product->setPrice($faker->numberBetween(9.99, 299.99));
            $product->setStock($faker->numberBetween(0, 30));
            $product->setSize($faker->randomElement(['36', '38', '40', '42', '44', '46', '48']));
            $product->setRate($faker->randomFloat(1, 1, 5));
            

            $randomCategory = $categoriesList[mt_rand(0, count($categoriesList) - 1)];
            $product->setCategory($randomCategory);

            // On push dans le tableau $productList, l'objet product
            $productsList[] = $product;

            // on persist $product
            $manager->persist($product);
            
        }

        $usersList = [];

        for($u = 1; $u <= 100; $u++) {

            $user = new User();
            $user->setEmail($faker->email());
            $user->setPassword('admin');
            $user->setRoles(['ROLE_USER']);
            $user->setFirstname($faker->firstName());
            $user->setLastname($faker->lastName());
            $user->setAdress($faker->streetAddress());
            $user->setPostalCode($faker->postcode());
            $user->setCity($faker->city());
            $user->setPhoneNumber($faker->e164PhoneNumber());
            $user->setNewsletter($faker->boolean());

            $usersList[] = $user;
            $manager->persist(($user));
        }

        $admin = new User();
        $admin->setEmail('admin@sapes.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setFirstname($faker->firstName());
        $admin->setLastname($faker->lastName());
        $admin->setPassword('$2y$13$.PJiDK3kq2C4owW5RW6Z3ukzRc14TJZRPcMfXcCy9AyhhA9OMK3Li');
        $admin->setNewsletter($faker->boolean());
        $manager->persist($admin);

        $managerUser = new User();
        $managerUser->setEmail('manager@sapes.com');
        $managerUser->setRoles(['ROLE_MANAGER']);
        $managerUser->setFirstname($faker->firstName());
        $managerUser->setLastname($faker->lastName());
        $managerUser->setPassword('$2y$13$/U5OgXbXusW7abJveoqeyeTZZBDrq/Lzh8Gt1RXnEDbT2xJqbv3vi');
        $managerUser->setNewsletter($faker->boolean());

        
        // Attention $manager = le Manager de Doctrine :D
        $manager->persist($managerUser);

        $manager->flush();

    }
}
