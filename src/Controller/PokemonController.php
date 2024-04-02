<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PokemonController  extends AbstractController{

    #[Route("/pokemon")]
    public function showPokemon (){
        $pokemon = [
            "name"=>"Bulbasaur",
            "description"=>"Tras nacer, crece alimentándose durante un tiempo de los nutrientes que contiene el bulbo de su lomo. ",
            "img"=>"https://assets.pokemon.com/assets/cms2/img/pokedex/full/001.png",
            "code"=>"0001"
        ];
        return $this->render("pokemon/showPokemon.html.twig",["pokemon"=>$pokemon]);
    }

    #[Route("/pokemons")]
    public function showListPokemons (){
        $pokemons = [
            [
                "name"=>"Bulbasaur",
                "description"=>"Tras nacer, crece alimentándose durante un tiempo de los nutrientes que contiene el bulbo de su lomo. ",
                "img"=>"https://assets.pokemon.com/assets/cms2/img/pokedex/full/001.png",
                "code"=>"0001"
            ],
            [
                "name"=>"Pikachu",
                "description"=>"Tras nacer, crece alimentándose durante un tiempo de los nutrientes que contiene el bulbo de su lomo. ",
                "img"=>"https://assets.pokemon.com/assets/cms2/img/pokedex/full/025.png",
                "code"=>"0001"
            ],
            [
                "name"=>"Charmander",
                "description"=>"Tras nacer, crece alimentándose durante un tiempo de los nutrientes que contiene el bulbo de su lomo. ",
                "img"=>"https://assets.pokemon.com/assets/cms2/img/pokedex/full/004.png",
                "code"=>"0001"
            ]
        ];
        return $this->render("pokemon/listPokemons.html.twig",["pokemons"=>$pokemons]);
    }



}