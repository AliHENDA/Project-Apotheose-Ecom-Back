<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\Cart2Repository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=Cart2Repository::class)
 */
class Cart2
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"get_cart_item"})
     */
    private $quantity;

    /**
     * @ORM\Column(type="float")
     * @Groups({"get_cart_item"})
     */
    private $total;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"get_cart_item"})
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="cart2s")
     * @Groups({"get_cart_item"})
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, inversedBy="cart2s", cascade={"persist"})
     * @Groups({"get_cart_item"})
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

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

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        $this->products->removeElement($product);

        return $this;
    }
}
