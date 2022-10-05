<?php

namespace App\Controller;

use App\Document\User;
use App\Form\LoginType;
use App\Form\UserType;
use App\Message\WelcomeMessage;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'createUser', methods: ['POST'])]
    public function create(DocumentManager $documentManager, Request $request, UserPasswordHasherInterface $hasher, MessageBusInterface $bus): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($user->isAuthorization()) {
                $encryptPass = $hasher->hashPassword($user, $user->getPassword()); // Encriptar pass
                $user->setPassword($encryptPass); //Enviamos pass encriptada
                $documentManager->persist($user);
                $documentManager->flush();
                $bus->dispatch(new WelcomeMessage($user->getEmail(), "Welcome, do you have registered successfully"));

                return $this->json([], Response::HTTP_NO_CONTENT);
            } else {
                return $this->json(['message' => "You must accept the authorization of data processing to register."], Response::HTTP_BAD_REQUEST);
            }
        }

        return $this->json($form->getErrors(true), Response::HTTP_BAD_REQUEST);
    }

    #[Route('/login', name: 'login', methods: ['POST'])]
    public function login(DocumentManager $documentManager, Request $request, UserPasswordHasherInterface $hasher): Response
    {
        $form = $this->createForm(LoginType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userData = $form->getData();

            $user = $documentManager->getRepository(User::class)->findOneBy(['user' => $userData['user']]);

            if ($user && $hasher->isPasswordValid($user, $userData['password'])) {
                return $this->json(['token' => $user->getToken()], Response::HTTP_OK);
            }
        }

        return $this->json(["message" => 'User or Password incorrect'], Response::HTTP_BAD_REQUEST);
    }
}