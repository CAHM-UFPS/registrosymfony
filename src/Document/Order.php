<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;

#[MongoDB\Document]
class Order
{
    #[MongoDB\Id]
    private $id;

    #[MongoDB\Field(type: User::class)]
    private User $user;

    #[MongoDB\Field(type: Products::class)]
    private Products $products;

    #[MongoDB\Field(type: 'string')]
    private string $sendAddress;

    #[MongoDB\Field(type: 'int')]
    private int $totalOrder = 0;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Order
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return ?User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return ?Order
     */
    public function setUser(User $user): ?Order
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return ?Products
     */
    public function getProducts(): ?Products
    {
        return $this->products;
    }

    /**
     * @param Products $products
     * @return ?Order
     */
    public function setProducts(Products $products): ?Order
    {
        $this->products = $products;
        return $this;
    }

    /**
     * @return string
     */
    public function getSendAddress(): string
    {
        return $this->sendAddress;
    }

    /**
     * @param string $sendAddress
     * @return Order
     */
    public function setSendAddress(string $sendAddress): Order
    {
        $this->sendAddress = $sendAddress;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalOrder(Products $products): int
    {
        $this->totalOrder += $products->getPrice() * $products->getQuantityProduct();
        return $this->totalOrder;
    }

    /**
     * @param int $totalOrder
     * @return Order
     */
    public function setTotalOrder(int $totalOrder): Order
    {
        $this->totalOrder = $totalOrder;
        return $this;
    }
}