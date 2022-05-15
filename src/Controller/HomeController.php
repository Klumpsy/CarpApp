<?php

namespace App\Controller;

use App\Repository\VangstRepository;
use App\Repository\WaterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(VangstRepository $vangstRepository, WaterRepository $waterRepository): Response
    {
        $totaalVangsten = array_reverse($vangstRepository->findAll());
        $totaalWateren = $waterRepository->findAll();
        $recordFish = $vangstRepository->findRecordFish();
        $smallestFish = $vangstRepository->findSmallestFish();
        $spiegelKarpers = $vangstRepository->orderByKind('spiegelkarper');
        $schubKarpers = $vangstRepository->orderByKind('schubkarper');

        return $this->render('home/index.html.twig', [
            'vangstFotos' => $totaalVangsten,
            'totaalWateren' => $totaalWateren,
            'recordFish' => $recordFish,
            'smallestFish' => $smallestFish,
            'spiegelKarpers' => $spiegelKarpers,
            'schubKarpers' => $schubKarpers
        ]);
    }
}
