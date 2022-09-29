<?php

namespace App\Controller;

use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/create', name: 'createUser', methods: ['GET'])]
    public function create(DocumentManager $documentManager): Response
    {
        return $this->json("Hola");
    }
}