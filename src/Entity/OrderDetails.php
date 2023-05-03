<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\OrderDetailsRepository;
use App\Entity\Product;
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
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="orderDetails")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"get_cart_item"})
     */
    private $product;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"get_cart_item"})
     */
    private $quantity;

    /**
     * @ORM\Column(type="string", length=4, nullable=true)
     * @Groups({"get_cart_item"})
     */
    private $size;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="orderDetails", cascade={"persist"})
     */
    private $myOrder;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(?string $size): self
    {
        $this->size = $size;

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
}
