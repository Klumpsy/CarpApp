<?php

namespace App\Controller;

use App\Entity\Vangst;
use App\Entity\Water;
use App\Form\WaterType;
use App\Repository\WaterRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WaterenController extends AbstractController
{
    #[Route('/wateren', name: 'app_wateren')]
    public function index(Request $request, WaterRepository $waterRepository): Response
    {


        $search = $request->query->get('q');
        if($search) {
            $wateren = $waterRepository->search($search);
        } else {
            $wateren = $waterRepository->findAllWater();
        }

        return $this->render('wateren/index.html.twig', [
            'wateren' => $wateren,
        ]);
    }

    #[Route('/wateren/toevoegen', name: 'app_wateren_toevoegen')]
    public function add(Request $request, ManagerRegistry $doctrine): Response
    {
        $water = new Water();
        $waterForm = $this->createForm(WaterType::class, $water);
        $waterForm->handleRequest($request);

        if ($waterForm->isSubmitted() && $waterForm->isValid()) {
            $em = $doctrine->getManager();

            $image = $request->files->get('water')['foto'];

            if ($image) {
                $imageName = md5(uniqid()). '.' . $image->guessClientExtension();
                $image->move(
                    $this->getParameter('fotos_folder'),
                    $imageName
                );

                $water->setImage($imageName);
            }

            $em->persist($water);
            $em->flush();

            $this->addFlash('water_message', "Water is toegevoegd!");
            return $this->redirect($this->generateUrl('app_wateren'));
        }

        return $this->renderForm('wateren/water_toevoegen.html.twig', [
            'water_form' => $waterForm,
        ]);
    }

    #[Route('/water/single/{id}', name: 'app_water_single')]
    public function single($id, ManagerRegistry $doctrine, Request $request): Response
    {
        $singleWater = $doctrine->getRepository(Water::class)->find($id);

        return $this->render('wateren/single_water.html.twig', [
            'water' => $singleWater,
        ]);
    }

    #[Route('/water/aanpassen/{id}', name: 'app_water_aanpassen')]
    public function edit($id, ManagerRegistry $doctrine, Request $request): Response
    {
        $water = $doctrine->getRepository(Water::class)->find($id);
        $waterForm = $this->createForm(WaterType::class, $water);
        $waterForm->handleRequest($request);

        if ($waterForm->isSubmitted() && $waterForm->isValid()) {
            $em = $doctrine->getManager();

            $image = $request->files->get('water')['foto'];

            if ($image) {
                $imageName = md5(uniqid()). '.' . $image->guessClientExtension();
                $image->move(
                    $this->getParameter('fotos_folder'),
                    $imageName
                );

                $water->setImage($imageName);
            }

            $em->persist($water);
            $em->flush();

            $this->addFlash('water_message', "Water is aangepast!");
            return $this->redirect($this->generateUrl('app_wateren'));
        }

        return $this->renderForm('wateren/pas_water_aan.html.twig', [
            'water_aanpas_form' => $waterForm,
            'water' => $water
        ]);
    }
}
