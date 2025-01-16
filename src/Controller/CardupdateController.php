<?php

namespace App\Controller;

use App\Entity\Objet;
use App\Form\ObjetType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CardupdateController extends AbstractController{

    #[Route('/cardupdate/{id}', name: 'app_cardupdate')]
    public function modify(Objet $objet, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ObjetType::class, $objet);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($objet);
            $entityManager->flush();

            $this->addFlash('success', 'Axolotl corectement modifié !!');

            $this->redirectToRoute('app_card');
        }
        return $this->render('card/index.html.twig', [
            'objetform' => $form->createView(),
        ]);
    }
}
