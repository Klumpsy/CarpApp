<?php

namespace App\Controller;

use App\Repository\VangstRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(VangstRepository $vangstRepository): Response
    {
        $vangstFotos = $vangstRepository->findAll();
        $record = $vangstRepository->findRecordFish();

        return $this->render('home/index.html.twig', [
            'vangstFotos' => $vangstFotos,
            'recordFish' => $record
        ]);
    }
}
