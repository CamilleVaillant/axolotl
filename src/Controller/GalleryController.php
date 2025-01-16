<?php

namespace App\Controller;

use App\Entity\Objet;
use App\Form\ObjetType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class GalleryController extends AbstractController{
    #[Route('/gallery', name: 'app_gallery')]
    public function addObjet(Request $request, EntityManagerInterface $entityManager): Response
    {
        $objet = new Objet();
        $form = $this->createForm(ObjetType::class);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){

            $entityManager->persist($objet);
            dd($form);
            $entityManager->flush();

            $this->addFlash('success', 'Axolotl ajouté avec sucès !');
            return $this->redirectToRoute('app_gallery');
        }
        return $this->render('gallery/index.html.twig', [
            'objetform'=>$form->createView(),
        ]);
    }
}
