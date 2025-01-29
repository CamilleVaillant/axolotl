<?php

namespace App\Controller;

use App\Repository\ObjetRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class FiltreObjetController extends AbstractController{
    #[Route('/filtre/objet', name: 'app_filtre_objet')]
    public function index(ObjetRepository $repository, Request $request): Response
    {
       $filter = $request->get('filter','all');

       $objet = $repository->findAll();
       return $this->render('home/index.html.twig', [
            'objet' => $objet,
       ]);
    }
}
