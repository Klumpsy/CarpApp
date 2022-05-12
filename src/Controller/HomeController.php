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
        $totaalVansten = array_reverse($vangstRepository->findAll());
        $totaalWateren = $waterRepository->findAll();
        $recordFish = $vangstRepository->findRecordFish();
        $smallestFish = $vangstRepository->findSmallestFish();
//        $recordWater = $waterRepository->findRecordWater();

        return $this->render('home/index.html.twig', [
            'vangstFotos' => $totaalVansten,
            'totaalWateren' => $totaalWateren,
            'recordFish' => $recordFish,
            'smallestFish' => $smallestFish
//            'recordWater' => $recordWater
        ]);
    }
}
