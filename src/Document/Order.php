<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;

#[MongoDB\Document]
class Order
{

    #[MongoDB\Id]
    private $id;

    #[MongoDB\Field]
    private string $user;

    #[MongoDB\Field]
    private string $sendAddress;

    #[MongoDB\Field]
    private string $totalOrder;

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
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @param string $user
     * @return Order
     */
    public function setUser(string $user): Order
    {
        $this->user = $user;
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
     * @return string
     */
    public function getTotalOrder(): string
    {
        return $this->totalOrder;
    }

    /**
     * @param string $totalOrder
     * @return Order
     */
    public function setTotalOrder(string $totalOrder): Order
    {
        $this->totalOrder = $totalOrder;
        return $this;
    }
}