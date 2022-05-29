<?php

namespace App\Controller;

use App\Repository\VangstRepository;
use App\Repository\WaterRepository;
use App\Service\Charthelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(VangstRepository $vangstRepository, WaterRepository $waterRepository, Charthelper $charthelper): Response
    {

        $totaalVangsten = array_reverse($vangstRepository->findAllFish());
        $totaalWateren = $waterRepository->findAllWater();
        $recordFish = $vangstRepository->findRecordFish();
        $smallestFish = $vangstRepository->findSmallestFish();

        $vangstenChart = $charthelper->getMontlyCatchrateChart();
        $soortenChart = $charthelper->getCarpSpeciesChart();

        return $this->render('home/index.html.twig', [
            'vangstFotos' => $totaalVangsten,
            'totaalWateren' => $totaalWateren,
            'recordFish' => $recordFish,
            'smallestFish' => $smallestFish,

            'vangstenChart' => $vangstenChart,
            'soortenChart' => $soortenChart
        ]);
    }
}
