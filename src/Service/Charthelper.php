<?php

namespace App\Service;

use App\Entity\Visser;
use App\Repository\VangstRepository;
use App\Repository\VisserRepository;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class Charthelper
{

    private $chartBuilder;
    private $vangstRepository;

    public function __construct(ChartBuilderInterface $chartBuilder, VangstRepository $vangstRepository)
    {
        $this->vangstRepository = $vangstRepository;
        $this->chartBuilder = $chartBuilder;
    }
    public function getMontlyCatchrateChart()
    {
        $vangstenChart = $this->chartBuilder->createChart(Chart::TYPE_BAR);
        $vangstenChart->setData([
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'],
            'datasets' => [
                [
                    'label' => 'Vangsten',
                    'backgroundColor' => 'rgb(209, 190, 79',
                    'borderColor' => 'rgb(209, 190, 79',
                    'data' => [
                        count($this->vangstRepository->orderByCaughtMonth('01')),
                        count($this->vangstRepository->orderByCaughtMonth('02')),
                        count($this->vangstRepository->orderByCaughtMonth('03')),
                        count($this->vangstRepository->orderByCaughtMonth('04')),
                        count($this->vangstRepository->orderByCaughtMonth('05')),
                        count($this->vangstRepository->orderByCaughtMonth('06')),
                        count($this->vangstRepository->orderByCaughtMonth('07')),
                        count($this->vangstRepository->orderByCaughtMonth('08')),
                        count($this->vangstRepository->orderByCaughtMonth('09')),
                        count($this->vangstRepository->orderByCaughtMonth('10')),
                        count($this->vangstRepository->orderByCaughtMonth('11')),
                        count($this->vangstRepository->orderByCaughtMonth('12')),
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
        return $vangstenChart;
    }

    public function getCarpSpeciesChart()
    {
        $soortenChart = $this->chartBuilder->createChart(Chart::TYPE_DOUGHNUT);
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
                        count($this->vangstRepository->orderByKind('spiegelkarper')),
                        count($this->vangstRepository->orderByKind('SchubKarper')),
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
        return $soortenChart;
    }

    public function getCarpSpeciesSingleFishermanChart($singleVisser)
    {

        $soortenChartSingleFisherman = $this->chartBuilder->createChart(Chart::TYPE_DOUGHNUT);
        $soortenChartSingleFisherman->setData([
            'labels' => ['Spiegel', 'Schub'],
            'datasets' => [
                [
                    'backgroundColor' => [
                        '#756e43',
                        '#4a4529'
                    ],
                    'borderColor' => 'white',
                    'data' => [
                        count($this->vangstRepository->orderByKindFisher('schubkarper', $singleVisser->getName())),
                        count($this->vangstRepository->orderByKindFisher('spiegelkarper', $singleVisser->getName())),
                    ],
                ],
            ],
        ]);
        $soortenChartSingleFisherman->setOptions([
            'plugins' => [
                'legend' => [
                    'labels' => [
                        'color' => 'white'
                    ]
                ]
            ],
        ]);
        return $soortenChartSingleFisherman;
    }

    public function getFishWeightChart() {

           $arrayData = [
               count($this->vangstRepository->orderByGivenWeight(0, 19.9)),
               count($this->vangstRepository->orderByGivenWeight(20, 24.9)),
               count($this->vangstRepository->orderByGivenWeight(25, 29.9)),
               count($this->vangstRepository->orderByGivenWeight(30, 34.9)),
               count($this->vangstRepository->orderByGivenWeight(35, 40)),
           ];

        $fishWeightChart = $this->chartBuilder->createChart(Chart::TYPE_POLAR_AREA);
        $fishWeightChart->setData([
            'labels' => [
                '0-20',
                '20-25',
                '25-30',
                '30-35',
                '35-40'
        ],
            'datasets' => [
                [
                    'label' => 'Gewichten',
                    'borderColor' => 'rgb(255, 255, 255)',
                    'data' => $arrayData,
                    'backgroundColor' => [
                        '#94d186',
                        '#70a364',
                        '#4d7544',
                        '#4d7544',
                        '#264021'
                    ],
                ]
        ]]);
        $fishWeightChart->setOptions([
            'plugins' => [
                'legend' => [
                    'labels' => [
                        'color' => 'white'
                    ]
                ]
            ],
        ]);
        return $fishWeightChart;
    }

    public function getCarpWeightSingleFishermanChart($name) {

        $arrayData = [
            count($this->vangstRepository->orderByGivenWeightFisher($name->getname(),0, 19.9)),
            count($this->vangstRepository->orderByGivenWeightFisher($name->getname(),20, 24.9)),
            count($this->vangstRepository->orderByGivenWeightFisher($name->getname(),25, 29.9)),
            count($this->vangstRepository->orderByGivenWeightFisher($name->getname(),30, 34.9)),
            count($this->vangstRepository->orderByGivenWeightFisher($name->getname(),35, 40)),
         ];

        $fishWeightChart = $this->chartBuilder->createChart(Chart::TYPE_POLAR_AREA);
        $fishWeightChart->setData([
            'labels' => [
                '0-20',
                '20-25',
                '25-30',
                '30-35',
                '35-40'
            ],
            'datasets' => [
                [
                    'label' => 'Gewichten',
                    'borderColor' => 'rgb(255, 255, 255)',
                    'data' => $arrayData,
                    'backgroundColor' => [
                        '#94d186',
                        '#70a364',
                        '#4d7544',
                        '#4d7544',
                        '#264021'
                    ],
                ]
            ]]);
        $fishWeightChart->setOptions([
            'plugins' => [
                'legend' => [
                    'labels' => [
                        'color' => 'white'
                    ]
                ]
            ],
        ]);
        return $fishWeightChart;
    }
}