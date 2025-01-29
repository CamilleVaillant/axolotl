<?php

namespace App\Controller;

use App\Entity\Objet;
use App\Form\ObjetType;
use App\Repository\ObjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CardController extends AbstractController{
    
    #[Route('/delete/{id}', name: 'app_delete')]
    public function delete(Objet $objet, Request $request, EntityManagerInterface $entityManager): Response
    {
       //On verifie si le token Csrf provient bien du formulaire de suppression correspondant a l'ID
       if($this->isCsrfTokenValid("SUP" . $objet->getId(),$request->get('_token'))){
            $entityManager->remove($objet); //marquage pour la sup
            $entityManager->flush(); //lancement de la requette
            $this->addFlash("success","La suppression a été effectuée");
            return $this->redirectToRoute("app_gallery");
       }
    }

    #[Route('/read', name: 'app_read')]
    public function index(ObjetRepository $repository): Response
    {
        $objet = $repository->findAll();
        
        return $this->render('card/index.html.twig', [
            'objet' => $objet,
        ]);
    }
}
