<?php

namespace App\Controller;

use App\Repository\VangstRepository;
use App\Repository\WaterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(VangstRepository $vangstRepository, WaterRepository $waterRepository, ChartBuilderInterface $chartBuilder): Response
    {

        $totaalVangsten = array_reverse($vangstRepository->findAllFish());
        $totaalWateren = $waterRepository->findAllWater();
        $recordFish = $vangstRepository->findRecordFish();
        $smallestFish = $vangstRepository->findSmallestFish();

        $vangstenChart = $chartBuilder->createChart(Chart::TYPE_BAR);
        $vangstenChart->setData([
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'],
            'datasets' => [
                [
                    'label' => 'Vangsten',
                    'backgroundColor' => 'rgb(209, 190, 79',
                    'borderColor' => 'rgb(209, 190, 79',
                    'data' => [
                        count($vangstRepository->orderByCaughtMonth('01')),
                        count($vangstRepository->orderByCaughtMonth('02')),
                        count($vangstRepository->orderByCaughtMonth('03')),
                        count($vangstRepository->orderByCaughtMonth('04')),
                        count($vangstRepository->orderByCaughtMonth('05')),
                        count($vangstRepository->orderByCaughtMonth('06')),
                        count($vangstRepository->orderByCaughtMonth('07')),
                        count($vangstRepository->orderByCaughtMonth('08')),
                        count($vangstRepository->orderByCaughtMonth('09')),
                        count($vangstRepository->orderByCaughtMonth('10')),
                        count($vangstRepository->orderByCaughtMonth('11')),
                        count($vangstRepository->orderByCaughtMonth('12')),
                    ],
                ],
            ],
        ]);
        $vangstenChart->setOptions([
            'plugins' => [
                'legend' => [
                    'labels' => [
                        'color' => 'white'
                    ]
                ]
            ],
            'scales' => [
                'x' => [
                    'ticks' => [
                        'color' => '#f2f1e9'
                    ]
                ],
                'y' => [
                    'ticks' => [
                        'color' => '#f2f1e9',
                        'min' => 0,
                        'stepSize' => 1
                    ]
                ]
            ]
        ]);

        $soortenChart = $chartBuilder->createChart(Chart::TYPE_DOUGHNUT);
        $soortenChart->setData([
            'labels' => ['Spiegel', 'Schub'],
            'datasets' => [
                [
                    'backgroundColor' => [
                        '#756e43',
                        '#4a4529'
                    ],
                    'borderColor' => 'white',
                    'data' => [
                        count($vangstRepository->orderByKind('spiegelkarper')),
                        count($vangstRepository->orderByKind('SchubKarper')),
                    ],
                ],
            ],
        ]);
        $soortenChart->setOptions([
            'plugins' => [
                'legend' => [
                    'labels' => [
                        'color' => 'white'
                    ]
                ]
            ],
        ]);

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
