<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use MongoDB\Collection;
use Symfony\Component\Validator\Constraints as Assert;

#[MongoDB\Document]
class Order
{
    #[MongoDB\Id]
    private $id;

    //#[MongoDB\Field]
    //#[MongoDB\ReferenceMany(targetDocument: Products::class)]
    //private Collection $products;

    #[MongoDB\Field(type: 'int')]
    #[Assert\PositiveOrZero]
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
     * @return Collection
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    /**
     * @param Collection $products
     * @return Order
     */
    public function setProducts(Collection $products): Order
    {
        $this->products = $products;
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