<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Form\ModifyTheWordPassType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ModifyTheWordPassController extends AbstractController{
    #[Route('/modify/the/word/pass/{token}', name: 'app_modify_the_word_pass')]
    public function reset(string $token, Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $user = $userRepository->findOneBy(['resetToken' => $token]);
        if(!$user || !$user->isRestTokenValid()) {
            $this->addFlash('danger', 'Ce lien de réinitialisation est invalide ou expiré.');
            return $this->redirectToRoute('app_send_new_word_pass');
        }

        $form = $this->createForm(ModifyTheWordPassType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $form->get('plainPassword')->getData();
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $user->setPassword($hashedPassword);
            $user->setResetToken(null);
            $user->setResetTokenExpiresAt(null);

            $entityManager->flush();

            $this->addFlash('success', 'Votre mot de passe a été mis à jour avec succès.');
            return $this->redirectToRoute('app_login');
        }
        return $this->render('modify_the_word_pass/index.html.twig', [
            'resetForm' => $form->createView(),
        ]);
    }
}
