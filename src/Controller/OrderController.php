<?php

namespace App\Controller;

use App\Document\Order;
use App\Form\OrderType;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/order')]
class OrderController extends AbstractController
{
    #[Route('/create', name: 'createOrder', methods: ['POST'])]
    public function create(DocumentManager $documentManager, Request $request): Response
    {


        return $this->json();
    }
}
