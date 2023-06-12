<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController {
    
    /**
     * 
     * @Route ("/", name="app_main_home") 
     */
    
    public function home() {

        return $this->render('main/home.html.twig');

    }
}