<?php

namespace App\Controller;


use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController  extends AbstractController{

    #[Route("/new/user", name:"newUser")]
    public function newUser (EntityManagerInterface $doctrine, Request $request, UserPasswordHasherInterface $hasher){
        $form = $this-> createForm(UserType::class);
        $form -> handleRequest($request);
        if($form-> isSubmitted() && $form-> isValid()){
            $user = $form-> getData();
            $oldPassword = $user -> getPassword();
            $hasherPassword = $hasher -> hashPassword($user, $oldPassword);
            $user -> setPassword($hasherPassword);
            $doctrine-> persist($user);
            $doctrine-> flush();
            $this-> addFlash('success', 'Usuario creado correctamente');
            return $this-> redirectToRoute("list-pokemons");
        }

        return $this->render("pokemon/newPokemon.html.twig",["newPokemon"=>$form]);
    }

    #[Route("/new/admin", name:"newAdmin")]
    public function newAdmin (EntityManagerInterface $doctrine, Request $request, UserPasswordHasherInterface $hasher){
        $form = $this-> createForm(UserType::class);
        $form -> handleRequest($request);
        if($form-> isSubmitted() && $form-> isValid()){
            $user = $form-> getData();
            $oldPassword = $user -> getPassword();
            $hasherPassword = $hasher -> hashPassword($user, $oldPassword);
            $user -> setPassword($hasherPassword);
            $user -> setRoles(["ROLE_USER", "ROLE_ADMIN"]);
            $doctrine-> persist($user);
            $doctrine-> flush();
            $this-> addFlash('success', 'Usuario creado correctamente');
            return $this-> redirectToRoute("list-pokemons");
        }

        return $this->render("pokemon/newPokemon.html.twig",["newPokemon"=>$form]);
    }

}