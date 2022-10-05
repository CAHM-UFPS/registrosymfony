<?php

namespace App\Controller;

use App\Document\Products;
use App\Form\ProductsType;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/products')]
class ProductsController extends AbstractController
{

    #[Route('/', name: 'createProduct', methods: ['POST'])]
    public function create(DocumentManager $documentManager, Request $request): Response
    {
        $product = new Products();
        $form = $this->createForm(ProductsType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $documentManager->persist($product);
            $documentManager->flush();

            return $this->json([], Response::HTTP_NO_CONTENT);
        }

        return $this->json($form->getErrors(true), Response::HTTP_BAD_REQUEST);
    }

    #[Route('/list', name: 'listProducts', methods: ['GET'])]
    public function list(DocumentManager $documentManager, Request $request): Response
    {
        $limit = $request->query->get('limit') ? : 0;
        $name = $request->query->get('name') ? : '';

        if ($limit == 0 && $name == '') {
            return $this->json($documentManager->getRepository(Products::class)->findAll());
        }

        return $this->json($documentManager->createQueryBuilder(Products::class)
            ->field('name')->equals(new \MongoDB\BSON\Regex("$name"))
            ->limit($limit)
            ->getQuery()
            ->execute(),
            Response::HTTP_OK
        );
    }
}