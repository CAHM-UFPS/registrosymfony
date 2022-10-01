<?php

namespace App\Controller;

use App\Document\User;
use App\Form\UserType;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/create', name: 'createUser', methods: ['POST'])]
    public function create(DocumentManager $documentManager, Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        //$form->submit($request->toArray());
        //dd($form->isValid());
        if ($form->isSubmitted() && $form->isValid()) {
            if ($user->isAuthorization()) {
                $documentManager->persist($user);
                $documentManager->flush();

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
        return $this->json($documentManager->getRepository(User::class)->findAll());
    }
}