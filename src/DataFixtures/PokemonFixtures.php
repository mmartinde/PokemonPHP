<?php

namespace App\DataFixtures;

use App\Entity\Pokemon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Faker\Factory;

class PokemonFixtures extends Fixture
{
    protected $httpClient;

    public function __construct(HttpClientInterface $client)
    {
        $this->httpClient = $client;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i=1; $i<=100; $i++)
        {
            $idPokemon = $faker->numberBetween(100, 999);

            $response = $this->httpClient->request('GET', 'https://pokeapi.co/api/v2/pokemon/'.$idPokemon);
            $dataPokemon = $response->toArray();

            $pokemon = new Pokemon();
            $pokemon->setName(ucfirst($dataPokemon['name']));
            $pokemon->setDescription($faker->text(100));
            $pokemon->setImage("https://assets.pokemon.com/assets/cms2/img/pokedex/full/$idPokemon.png");
            $pokemon->setCode($idPokemon);
            $manager->persist($pokemon);
        }

        $manager->flush();

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
