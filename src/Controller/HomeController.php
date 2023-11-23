<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request): Response
    {
        $calculChoice = $request->get('calcul_choice'); // Récupère le choix du calcul depuis le formulaire

        return $this->render('home/index.html.twig', [
            'calculChoice' => $calculChoice,
        ]);
    }
}

