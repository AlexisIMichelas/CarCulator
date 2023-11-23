<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FranchiseKMController extends AbstractController
{
    #[Route('/franchiseKM', name: 'app_franchiseKM')]
    public function index(Request $request): Response
    {
        $kmSouscription = intval($request->query->get('km_souscription'));
        $kmAutoriseParAn = intval($request->query->get('km_autorise_par_an'));
        $kmReleveSinistre = intval($request->query->get('km_releve_sinistre'));
    
        $anneeSouscription = intval($request->query->get('annee_souscription'));
        $anneeSinistre = intval($request->query->get('annee_sinistre'));
    
        // Calcul de l'écart d'années
        $ecartAnnees = $anneeSinistre - $anneeSouscription;
    
        // Calcul de la franchise kilométrique
        $franchiseKm = $kmReleveSinistre - ($kmSouscription + $kmAutoriseParAn);
    
        // Vérification si la franchise doit être payée
        $franchiseAPayer = $ecartAnnees > 0 && $franchiseKm > 0;
    
        return $this->render('franchise_km/index.html.twig', [
            'franchiseKm' => $franchiseKm,
            'franchiseAPayer' => $franchiseAPayer,
        ]);
    }    
}

