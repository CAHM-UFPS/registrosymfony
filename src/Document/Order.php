<?php

namespace App\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;

#[MongoDB\Document]
class Order
{
    #[MongoDB\Id]
    private string $id;

    #[MongoDB\ReferenceOne(targetDocument: User::class)]
    private User $user;

    #[MongoDB\EmbedMany(targetDocument: OrderDetail::class)]
    private Collection $orderDetails;

    #[MongoDB\Field(type: 'string')]
    #[Assert\NotBlank]
    private string $sendAddress;

    //#[MongoDB\Field(type: 'float')]
    //#[Assert\PositiveOrZero]
    //private float $totalOrder;

    public function __construct()
    {
        $this->orderDetails = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getOrderDetails(): Collection
    {
        return $this->orderDetails;
    }

    public function addOrderDetail(OrderDetail $orderDetail): static
    {
        if (!$this->orderDetails->contains($orderDetail)) {
            $this->orderDetails->add($orderDetail);
        }

        return $this;
    }

    public function removeOrderDetail(OrderDetail $orderDetail): bool
    {
        return $this->orderDetails->remove($orderDetail);
    }

    public function getSendAddress(): string
    {
        return $this->sendAddress;
    }

    public function setSendAddress(string $sendAddress): static
    {
        $this->sendAddress = $sendAddress;

        return $this;
    }

    public function getTotalPrice(): float
    {
        $orders = $this->getOrderDetails();
        $total = 0;

        foreach ($orders as $order) {
            $total += $order->getProduct()->getPrice() * $order->getQuantity();
        }

        return $total;
    }
}