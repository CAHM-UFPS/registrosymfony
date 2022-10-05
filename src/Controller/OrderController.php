<?php

namespace App\Controller;

use App\Document\Order;
use App\Document\User;
use App\Form\OrderType;
use App\Message\OrderMessage;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/order')]
class OrderController extends AbstractController
{
    #[Route('/', name: 'createOrder', methods: ['POST'])]
    public function create(DocumentManager $documentManager, Request $request, MessageBusInterface $bus): Response
    {
        $token = $request->headers->get('Token');
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
            $bus->dispatch(new OrderMessage($user->getEmail(), "Has buy your first product"));

            return $this->json(["order" => $order->getId()], Response::HTTP_OK);
        }

        return $this->json($form->getErrors(true), Response::HTTP_BAD_REQUEST);
    }
}
