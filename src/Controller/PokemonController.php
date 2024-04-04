<?php

namespace App\Controller;

use App\Entity\Pokemon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PokemonController  extends AbstractController{

    #[Route("/pokemon/{id}")]
    public function showPokemon (EntityManagerInterface $doctrine, $id){
        $repository = $doctrine->getRepository(Pokemon::class);
        $pokemon = $repository->find($id);
        return $this->render("pokemon/showPokemon.html.twig",["pokemon"=>$pokemon]);
    }

    #[Route("/pokemons")]
    public function showListPokemons (EntityManagerInterface $doctrine){
        $repository = $doctrine->getRepository(Pokemon::class);
        $pokemons = $repository->findAll();
        return $this->render("pokemon/listPokemons.html.twig",["pokemons"=>$pokemons]);
    }

    #[Route("/insert/pokemon")]
    public function insertPokemons (EntityManagerInterface $doctrine)
    {
        $pokemon = new Pokemon();
        $pokemon->setName("Charmander");
        $pokemon->setDescription("Tras nacer, crece alimentándose durante un tiempo de los nutrientes que contiene el bulbo de su lomo. ");
        $pokemon->setImage("https://assets.pokemon.com/assets/cms2/img/pokedex/full/004.png");
        $pokemon->setCode(0001);

        $pokemon2 = new Pokemon();
        $pokemon2->setName("Pikachu");
        $pokemon2->setDescription("Tras nacer, crece alimentándose durante un tiempo de los nutrientes que contiene el bulbo de su lomo. ");
        $pokemon2->setImage("https://assets.pokemon.com/assets/cms2/img/pokedex/full/004.png");
        $pokemon2->setCode(0001);

        $pokemon3 = new Pokemon();
        $pokemon3->setName("Bulbasur");
        $pokemon3->setDescription("Tras nacer, crece alimentándose durante un tiempo de los nutrientes que contiene el bulbo de su lomo. ");
        $pokemon3->setImage("https://assets.pokemon.com/assets/cms2/img/pokedex/full/004.png");
        $pokemon3->setCode(0001);

        $pokemon4 = new Pokemon();
        $pokemon4->setName("Squirtel");
        $pokemon4->setDescription("Tras nacer, crece alimentándose durante un tiempo de los nutrientes que contiene el bulbo de su lomo. ");
        $pokemon4->setImage("https://assets.pokemon.com/assets/cms2/img/pokedex/full/004.png");
        $pokemon4->setCode(0001);

        $doctrine->persist($pokemon);
        $doctrine->persist($pokemon2);
        $doctrine->persist($pokemon3);
        $doctrine->persist($pokemon4);

        $doctrine->flush();

        return new Response("Pokemons insertados correctamente!");
    }

}