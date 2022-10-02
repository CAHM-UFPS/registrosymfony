<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;

#[MongoDB\Document]
class Products
{

    #[MongoDB\Id]
    private $id;

    #[MongoDB\Field(type: 'string')]
    private string $name;

    #[MongoDB\Field(type: 'int')]
    private int $quantityProduct;

    #[MongoDB\Field(type: 'int')]
    private int $price;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Products
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getQuantityProduct(): int
    {
        return $this->quantityProduct;
    }

    /**
     * @param int $quantityProduct
     * @return Products
     */
    public function setQuantityProduct(int $quantityProduct): Products
    {
        $this->quantityProduct = $quantityProduct;
        return $this;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     * @return Products
     */
    public function setPrice(int $price): Products
    {
        $this->price = $price;
        return $this;
    }
}