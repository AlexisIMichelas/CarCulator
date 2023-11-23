<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculatorController extends AbstractController
{
    #[Route('/calculator', name: 'app_calculator')]
    public function index(): Response
    {
        return $this->render('calculator/index.html.twig');
    }

    #[Route('/result', name: 'app_result')]
    public function calculate(Request $request): Response
    {
        $cession = $request->request->get('cession') === 'yes';
        $montantVadeHT = floatval($request->request->get('montant_vade_ht'));
        $valeurResiduelle = floatval($request->request->get('valeur_residuelle'));
        $franchise = floatval($request->request->get('franchise', 0)); // Par défaut 0 si non renseigné
        $opposition = $request->request->get('opposition') === 'yes';
        $montantOpposition = $opposition ? floatval($request->request->get('montant_opposition')) : 0;
        $dateMiseEnCirculation = new \DateTime($request->request->get('date_mise_en_circulation'));
        $packValeurPlus = $request->request->get('pack_valeur_plus') === 'yes';
        $dateSinistre = new \DateTime($request->request->get('date_sinistre'));
        $tvaRegler = $request->request->get('tva_regler') === 'yes';

        return $this->render('calculator/result.html.twig', [
            'montantVadeHT' => $montantVadeHT,
            'valeurResiduelle' => $valeurResiduelle,
        ]);
    }
}
