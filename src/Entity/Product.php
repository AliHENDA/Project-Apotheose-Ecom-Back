<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"get_products_collection", "get_products_item", "get_cart_item"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups({"get_products_collection", "get_products_item", "get_cart_item"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"get_products_collection", "get_products_item", "get_cart_item"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"get_products_collection", "get_products_item", "get_cart_item"})
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=5)
     * @Groups({"get_products_collection", "get_products_item", "get_cart_item"})
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     * @Groups({"get_products_collection", "get_products_item", "get_cart_item"})
     */
    private $color;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"get_products_collection", "get_products_item", "get_cart_item"})
     */
    private $rate;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"get_products_collection", "get_products_item", "get_cart_item"})
     */
    private $price;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $best_sellers_order;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="products")
     * @Groups({"get_products_collection", "get_products_item", "get_cart_item"})
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     * @Groups({"get_products_collection", "get_products_item", "get_cart_item"})
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity=OrderDetails::class, mappedBy="product")
     */
    private $orderDetails;

    /**
     * @ORM\OneToMany(targetEntity=TemporaryCart::class, mappedBy="product")
     */
    private $temporaryCarts;

    /**
     * @ORM\OneToMany(targetEntity=Inventory::class, mappedBy="product")
     * @Groups({"get_products_collection", "get_products_item"})
     */
    private $inventories;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->orderDetails = new ArrayCollection();
        $this->temporaryCarts = new ArrayCollection();
        $this->inventories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getRate(): ?float
    {
        return $this->rate;
    }

    public function setRate(?float $rate): self
    {
        $this->rate = $rate;

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

    public function getBestSellersOrder(): ?int
    {
        return $this->best_sellers_order;
    }

    public function setBestSellersOrder(?int $best_sellers_order): self
    {
        $this->best_sellers_order = $best_sellers_order;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection<int, OrderDetails>
     */
    public function getOrderDetails(): Collection
    {
        return $this->orderDetails;
    }

    public function addOrderDetail(OrderDetails $orderDetail): self
    {
        if (!$this->orderDetails->contains($orderDetail)) {
            $this->orderDetails[] = $orderDetail;
            $orderDetail->setProduct($this);
        }

        return $this;
    }

    public function removeOrderDetail(OrderDetails $orderDetail): self
    {
        if ($this->orderDetails->removeElement($orderDetail)) {
            // set the owning side to null (unless already changed)
            if ($orderDetail->getProduct() === $this) {
                $orderDetail->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TemporaryCart>
     */
    public function getTemporaryCarts(): Collection
    {
        return $this->temporaryCarts;
    }

    public function addTemporaryCart(TemporaryCart $temporaryCart): self
    {
        if (!$this->temporaryCarts->contains($temporaryCart)) {
            $this->temporaryCarts[] = $temporaryCart;
            $temporaryCart->setProduct($this);
        }

        return $this;
    }

    public function removeTemporaryCart(TemporaryCart $temporaryCart): self
    {
        if ($this->temporaryCarts->removeElement($temporaryCart)) {
            // set the owning side to null (unless already changed)
            if ($temporaryCart->getProduct() === $this) {
                $temporaryCart->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Inventory>
     */
    public function getInventories(): Collection
    {
        return $this->inventories;
    }

    public function addInventory(Inventory $inventory): self
    {
        if (!$this->inventories->contains($inventory)) {
            $this->inventories[] = $inventory;
            $inventory->setProduct($this);
        }

        return $this;
    }

    public function removeInventory(Inventory $inventory): self
    {
        if ($this->inventories->removeElement($inventory)) {
            // set the owning side to null (unless already changed)
            if ($inventory->getProduct() === $this) {
                $inventory->setProduct(null);
            }
        }

        return $this;
    }
}
