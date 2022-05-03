<?php

namespace App\Controller;

use App\Entity\Vangst;
use App\Form\VangstenToevoegenType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VangstenController extends AbstractController
{
    #[Route('/vangsten', name: 'app_vangsten')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $vangsten = $em->getRepository(Vangst::class)->findAll();

        return $this->render('vangsten/index.html.twig', [
            'vangsten' => $vangsten,
        ]);
    }

    #[Route('/vangst-toevoegen', name: 'app_vangst_toevoegen')]
    public function makeVangst(ManagerRegistry $doctrine, Request $request): Response
    {
        $vangst = new Vangst();
        $vangstForm = $this->createForm(VangstenToevoegenType::class, $vangst);
        $vangstForm->handleRequest($request);

        if ($vangstForm->isSubmitted() && $vangstForm->isValid()) {
            $em = $doctrine->getManager();

            $image = $request->files->get('vangsten_toevoegen')['foto'];

            if ($image) {
               $imageName = md5(uniqid()). '.' . $image->guessClientExtension();
            }

            $image->move(
                $this->getParameter('fotos_folder'),
                $imageName
            );

            $vangst->setImage($imageName);
            $em->persist($vangst);
            $em->flush();

            $this->addFlash('vangst_message', "Vangst is toegevoegd!");
            return $this->redirect($this->generateUrl('app_vangsten'));
        }

        return $this->renderForm('vangsten/voeg_vangst_toe.html.twig', [
            'vangsten_form' => $vangstForm
        ]);
    }
}
