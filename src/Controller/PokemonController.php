<?php

namespace App\Controller;

use App\Entity\Debilidad;
use App\Entity\Pokemon;
use App\Form\PokemonType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PokemonController  extends AbstractController{

    #[Route("/pokemon/{id}", name:"show-pokemon")]
    public function showPokemon (EntityManagerInterface $doctrine, $id){
        $repository = $doctrine->getRepository(Pokemon::class);
        $pokemon = $repository->find($id);
        return $this->render("pokemon/showPokemon.html.twig",["pokemon"=>$pokemon]);
    }

    #[Route("/pokemons", name:"list-pokemons")]
    public function showListPokemons (EntityManagerInterface $doctrine){
        $repository = $doctrine->getRepository(Pokemon::class);
        $pokemons = $repository->findAll();
        return $this->render("pokemon/listPokemons.html.twig",["pokemons"=>$pokemons]);
    }

    #[Route("/new/pokemon", name:"newPokemon")]
    public function newPokemon (EntityManagerInterface $doctrine, Request $request){
        $form = $this-> createForm(PokemonType::class); 
        $form -> handleRequest($request);
        if($form-> isSubmitted() && $form-> isValid()){
            $pokemon = $form-> getData();
            $doctrine-> persist($pokemon);
            $doctrine-> flush();
            $this-> addFlash('success', 'Pokemon creado correctamente');
            return $this-> redirectToRoute("show-pokemon", ['id'=>$pokemon->getId()]);
        }

        return $this->render("pokemon/newPokemon.html.twig",["newPokemon"=>$form]);
    }

    #[Route("/edit/pokemon/{id}", name:"edit-pokemon")]
    public function editPokemon (EntityManagerInterface $doctrine, Request $request, $id){

        $repository = $doctrine->getRepository(Pokemon::class);
        $pokemon = $repository->find($id);

        $form = $this-> createForm(PokemonType::class, $pokemon); 
        $form -> handleRequest($request);

        if($form-> isSubmitted() && $form-> isValid()){
            $pokemon = $form-> getData();
            $doctrine-> persist($pokemon);
            $doctrine-> flush();
            $this-> addFlash('success', 'Pokemon creado correctamente');
            return $this-> redirectToRoute("show-pokemon", ['id'=>$pokemon->getId()]);
        }

        return $this->render("pokemon/newPokemon.html.twig",["newPokemon"=>$form]);
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

        $debilidad = new Debilidad();
        $debilidad -> setName("Fuego"); 

        $debilidad2 = new Debilidad();
        $debilidad2 -> setName("Agua"); 

        $debilidad3 = new Debilidad();
        $debilidad3 -> setName("Hielo"); 

        $debilidad4 = new Debilidad();
        $debilidad4 -> setName("Metal"); 

        $pokemon-> addDebilidade($debilidad2);
        $pokemon-> addDebilidade($debilidad);

        $pokemon2-> addDebilidade($debilidad3);

        $pokemon3-> addDebilidade($debilidad4);

        $pokemon4-> addDebilidade($debilidad);
        $pokemon4-> addDebilidade($debilidad3);

        $doctrine->persist($pokemon);
        $doctrine->persist($pokemon2);
        $doctrine->persist($pokemon3);
        $doctrine->persist($pokemon4);
        $doctrine->persist($debilidad);
        $doctrine->persist($debilidad2);
        $doctrine->persist($debilidad3);
        $doctrine->persist($debilidad4);
        

        $doctrine->flush();

        return new Response("Pokemons insertados correctamente!");
    }

}