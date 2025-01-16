<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LogType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class RegisterController extends AbstractController{
    #[Route(path: '/register', name: 'app_register')]
    public function log(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordEncoder): Response
    {
       $user = new User();
      
       $formr = $this->createForm(LogType::class, $user);
       $formr->handleRequest($request);
       if($entityManager->getRepository(User::class)->findOneBy(['email' => $user->getEmail()])){
        $this->addFlash('error', 'Cet email est déjà utilisé. Veuillez en choisir un autre.');
        return $this->redirectToRoute('app_log');
       }
       if($formr->isSubmitted() && $formr->isValid()){
            $user->setPassword( 
            $passwordEncoder->hashPassword($user,$formr->get('password')->getData())
            );
            $user->setRoles(['ROLE_USER']);
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Vous etes inscrit !');
               
            return $this->redirectToRoute('app_home');
       }
       
       
      

        return $this->render('register/index.html.twig', [
            'inscription' => $formr->createView(),
        ]);
        
    }
}
