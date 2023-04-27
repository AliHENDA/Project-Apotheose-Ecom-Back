<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\OrderDetailsRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=OrderDetailsRepository::class)
 */
class OrderDetails
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"get_order_details_item"})
     */
    private $quantity;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"get_order_details_item"})
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     * Groups({"get_order_details_item"})
     */
    private $total;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="orderDetails", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     * Groups({"get_order_details_item"})
     */
    private $myOrder;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="orderDetails")
     */
    private $product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getMyOrder(): ?Order
    {
        return $this->myOrder;
    }

    public function setMyOrder(?Order $myOrder): self
    {
        $this->myOrder = $myOrder;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

}
