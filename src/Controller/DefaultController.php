<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController{
    #[Route("/article/{id}",
    name:"detail_article",
    methods:["GET"],
     requirements:["id"=>"\d+"])]
    public function hello($id){
            return $this->render("example.html.twig",[
            "articles" => [
        "titre1" => "Titre1",
        "titre2" => "Titre2",
        "titre3" => "Titre3",
        ]
    ]);
}
    }


// class DefaultController extends AbstractController{
//     #[Route("/home",name:"home")]
//         public function home() {
//             return $this->render("home.html.twig", ["message" => "Hello World!"]);
//         }
    
//     #[Route("/register",name:"register",methods:["POST","GET"])]
//         public function register(){
//             return $this->render("register.html.twig", ["message" => "Hello World!"]);
//     }

//     #[Route("/login",name:"login")]
//     public function login(){
//     }

//     #[Route("/profile/new",name:"login_new")]
//     public function profileNew(){
//     }

//     #[Route("/password/{id}/reset",name:"password_reset", requirements:["id"=>"\d+"])]
//     public function passwordReset(){
//     }

//     #[Route("/profile/{id}/delete",name:"profile_delete", requirements:["id"=>"\d+"])]
//     public function profileIdDelete(){
//     }
// }

