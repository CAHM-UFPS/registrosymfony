<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;

#[MongoDB\EmbeddedDocument]
class OrderDetail
{
    #[MongoDB\Id]
    private string $id;

    #[MongoDB\ReferenceOne(targetDocument: Products::class)]
    private Products $product;

    #[MongoDB\Field(type: 'int')]
    #[Assert\Positive]
    private int $quantity;

    public function getId(): string
    {
        return $this->id;
    }

    public function getProduct(): Products
    {
        return $this->product;
    }

    public function setProduct(Products $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }
}