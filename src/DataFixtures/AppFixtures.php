<?php
namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\AccountType;

class AppFixtures extends Fixture
{
    /**
     * @var Generator
     */
    private Generator $faker;


    public function __construct(){
        $this->faker = Factory::create('fr_FR');

    }
    
    public function load(ObjectManager $manager): void
    {
        $types = ['spotify', 'deezer', 'youtube','soundcloud', "discoggs", "bandcamp", "applemusic"];
        foreach ($types as $key => $type) {
            $accountType = new AccountType();
            $accountType->setPlatform($type);
            $manager->persist($accountType);

            # code...
        }
        $manager->flush();
    }

}