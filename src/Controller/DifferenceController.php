<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DifferenceController extends AbstractController
{
    #[Route('/difference', name: 'app_difference')]
    public function index(): Response
    {
        return $this->render('difference/index.html.twig');
    }

    #[Route('/difference/result', name: 'app_result_difference')]
    public function calculate(Request $request): Response
    {
        $facture = floatval($request->request->get('facture'));
        $rapportExpert = floatval($request->request->get('rapport_expert'));
        $isCapsAuto = $request->request->get('capsauto') === 'yes';
        $valeurVetusteHT = floatval($request->request->get('vetuste_ht'));
        $valeurVetusteBrut = floatval($request->request->get('vetuste_brut'));
        $elementSRGC = $request->request->get('element_srgc') === 'yes';

        // Appliquer la réduction de 5% si le garage est un CapsAuto
        if ($isCapsAuto) {
            $facture -= ($facture * 0.05);
        }

        // Calcul de la vétusté
        $vetuste = $valeurVetusteBrut - $valeurVetusteHT;

        // Vérifier l'élément SRGC et appliquer la différence entre facture et rapport d'expert
        if ($elementSRGC) {
            $difference = $facture - $rapportExpert;
        } else {
            // Si Element SRGC non pris en compte, appliquer la vétusté
            $difference = ($facture - $vetuste) - $rapportExpert;
        }

        return $this->render('difference/index.html.twig', [
            'difference' => $difference,
        ]);
    }
}
