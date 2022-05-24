<?php

namespace App\Controller;

use App\Entity\Visser;
use App\Form\VisserType;
use App\Repository\VisserRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VisserController extends AbstractController
{
    #[Route('/vissers', name: 'app_visser')]
    public function index(VisserRepository $vissers): Response
    {
        $vissers = $vissers->findAll();

        return $this->render('visser/index.html.twig', [
            'vissers' => $vissers,
        ]);
    }

    #[Route('/visser/single/{id}', name: 'app_visser_single')]
    public function single($id, ManagerRegistry $doctrine, Request $request): Response
    {
        $singleVisser = $doctrine->getRepository(Visser::class)->findWithVangstenJoin($id);

        return $this->render('visser/single_visser.html.twig', [
            'visser' => $singleVisser,
        ]);
    }

    #[Route('/vissers-toevoegen', name: 'app_visser_toevoegen')]
    public function visser(Request $request, ManagerRegistry $doctrine): Response
    {
        $visser = new Visser();
        $visserForm = $this->createForm(VisserType::class, $visser);
        $visserForm->handleRequest($request);

        if ($visserForm->isSubmitted() && $visserForm->isValid()) {

            $em = $doctrine->getManager();

            $image = $request->files->get('visser')['foto'];

            if ($image) {
                $imageName = md5(uniqid()). '.' . $image->guessClientExtension();
                $image->move(
                    $this->getParameter('fotos_folder'),
                    $imageName
                );
                $visser->setImage($imageName);
            }

            $em->persist($visser);
            $em->flush();

            $this->addFlash('visser_message', "Visser is toegevoegd!");
            return $this->redirect($this->generateUrl('app_visser'));
        }

        return $this->renderForm('visser/voeg_visser_toe.html.twig', [
            'visser_form' => $visserForm
        ]);
    }
}
