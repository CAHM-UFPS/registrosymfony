<?php

namespace App\Controller;

use App\Document\Order;
use App\Document\User;
use App\Form\OrderType;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/order')]
class OrderController extends AbstractController
{
    #[Route('/{token}', name: 'createOrder', methods: ['POST'])]
    public function create(string $token, DocumentManager $documentManager, Request $request): Response
    {
        $user = $documentManager->getRepository(User::class)->findOneBy(['token' => $token]);

        if (!$user) {
            return $this->json([], Response::HTTP_UNAUTHORIZED);
        }

        $order = new Order();
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $order->setUser($user);
            $documentManager->persist($order);
            $documentManager->flush();

            return $this->json($order);
        }

        return $this->json($form->getErrors(true), Response::HTTP_BAD_REQUEST);
    }

    #[Route('/list', name: 'listOrders', methods: ['GET'])]
    public function list(DocumentManager $documentManager): Response
    {
        return $this->json($documentManager->getRepository(Order::class)->findAll(), Response::HTTP_OK);
    }
}
