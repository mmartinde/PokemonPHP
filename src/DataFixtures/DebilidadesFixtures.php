<?php

namespace App\DataFixtures;

use App\Entity\Debilidad;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DebilidadesFixtures extends Fixture
{
    public function __construct(protected HttpClientInterface $client)
    {
    }

    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=10; $i++) {
            $response = $this->client->request("GET", "https://pokeapi.co/api/v2/type/$i");
            $typeData = $response->toArray();

            $debilidad = new Debilidad();
            $debilidad->setName(ucfirst($typeData["name"]));
            $manager->persist($debilidad);
        }

        $manager->flush();
    }
}
