<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WaterenController extends AbstractController
{
    #[Route('/wateren', name: 'app_wateren')]
    public function index(): Response
    {
        return $this->render('wateren/index.html.twig', [
            'controller_name' => 'WaterenController',
        ]);
    }
}
