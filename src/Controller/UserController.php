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
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/create', name: 'createUser', methods: ['POST'])]
    public function create(DocumentManager $documentManager, Request $request, MessageBusInterface $bus): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($user->isAuthorization()) {
                $documentManager->persist($user);
                $documentManager->flush();
                $bus->dispatch(new WelcomeMessage("Welcome, do you have registered successfully"), []);

                return $this->json([], Response::HTTP_NO_CONTENT);
            } else {
                return $this->json(['message' => "You must accept the authorization of data processing to register."], Response::HTTP_BAD_REQUEST);
            }
        }

        return $this->json($form->getErrors(true), Response::HTTP_BAD_REQUEST);
    }

    #[Route('/list', name: 'listUsers', methods: ['GET'])]
    public function read(DocumentManager $documentManager): Response
    {
        return $this->json($documentManager->getRepository(User::class)->findAll(), Response::HTTP_OK);
    }

    #[Route('/login', name: 'login', methods: ['POST'])]
    public function login(DocumentManager $documentManager, Request $request): Response
    {
        $form = $this->createForm(LoginType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userData = $form->getData();
            $user = $documentManager->getRepository(User::class)->findOneBy(['user' => $userData['user']]);

            if (strcmp($userData['password'], $user->getPassword()) === 0) {
                return $this->json(['message' => "Login"], Response::HTTP_OK);
            }
        }

        return $this->json(["message" => 'User or Password incorrect'], Response::HTTP_BAD_REQUEST);
    }
}