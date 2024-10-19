<?php


namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: 'orders')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    /**
     * Лучше конечно в данном случае использовать отношение ManyToMany,
     * В качестве тестового примера можно и ManyToOne
     */
    #[ORM\ManyToOne(targetEntity: Product::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Product $product;

    #[ORM\ManyToOne(targetEntity: Coupon::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Coupon $coupon = null;

    #[ORM\Column(type: 'string', length: 20)]
    private string $taxNumber;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $totalPrice;

    #[ORM\Column(type: 'string', length: 50)]
    private string $paymentProcessor;

    #[ORM\Column(type: 'boolean')]
    private bool $paymentSuccessful;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product product
     *
     * @return self
     */
    public function setProduct(Product $product): self
    {

        $this->product = $product;

        return $this;
    }

    /**
     * @return Coupon|null
     */
    public function getCoupon(): ?Coupon
    {
        return $this->coupon;
    }

    /**
     * @param Coupon|null $coupon coupon
     *
     * @return self
     */
    public function setCoupon(?Coupon $coupon): self
    {
        $this->coupon = $coupon;

        return $this;
    }

    /**
     * @return string
     */
    public function getTaxNumber(): string
    {
        return $this->taxNumber;
    }

    /**
     * @param string $taxNumber tax number
     *
     * @return self
     */
    public function setTaxNumber(string $taxNumber): self
    {
        $this->taxNumber = $taxNumber;

        return $this;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    /**
     * @param float $totalPrice total price
     *
     * @return self
     */
    public function setTotalPrice(float $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentProcessor(): string
    {
        return $this->paymentProcessor;
    }

    /**
     * @param string $paymentProcessor payment processor
     *
     * @return self
     */
    public function setPaymentProcessor(string $paymentProcessor): self
    {
        $this->paymentProcessor = $paymentProcessor;

        return $this;
    }

    /**
     * @return bool
     */
    public function isPaymentSuccessful(): bool
    {
        return $this->paymentSuccessful;
    }

    /**
     * @param bool $paymentSuccessful payment successful
     *
     * @return self
     */
    public function setPaymentSuccessful(bool $paymentSuccessful): self
    {
        $this->paymentSuccessful = $paymentSuccessful;

        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt created at
     *
     * @return self
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
