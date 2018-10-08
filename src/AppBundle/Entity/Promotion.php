<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Promotion
 *
 * @ORM\Table(name="gdt_promotion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PromotionRepository")
 */
class Promotion extends AbstractEntity
{
    const TYPE_PROMOTION = array(
        'Code' => 'Code promo',
        'Promotions' => 'Bon plan'
    );


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expirationDate", type="datetime", nullable=false)
     */
    private $expirationDate;

    /**
     * @var string
     *
     * @ORM\Column(name="promotion", type="string", length=255, nullable=false)
     */
    private $promotion;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="redirect_url", type="string", length=255, nullable=false)
     */
    private $redirectUrl;

    /**
     * @var
     *
     * @ORM\ManyToOne(
     *     targetEntity="AppBundle\Entity\Shop",
     *     inversedBy="promotions"
     * )
     * @ORM\JoinColumn(nullable=false)
     */
    private $shop;


    /**
     * @var
     *
     * @ORM\ManyToOne(
     *     targetEntity="AppBundle\Entity\Sponsor",
     *     inversedBy="promotions",
     *     cascade={"persist", "merge"}
     * )
     * @ORM\JoinColumn(nullable=false)
     */
    private $sponsor;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\Administrator")
     * @ORM\JoinColumn(nullable=true)
     *
     */
    private $publisher;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return Promotion
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set expirationDate
     *
     * @param \DateTime $expirationDate
     *
     * @return Promotion
     */
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    /**
     * Get expirationDate
     *
     * @return \DateTime
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * Set promotion
     *
     * @param string $promotion
     *
     * @return Promotion
     */
    public function setPromotion($promotion)
    {
        $this->promotion = $promotion;

        return $this;
    }

    /**
     * Get promotion
     *
     * @return string
     */
    public function getPromotion()
    {
        return $this->promotion;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Promotion
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set redirectUrl
     *
     * @param string $redirectUrl
     *
     * @return Promotion
     */
    public function setRedirectUrl($redirectUrl)
    {
        $this->redirectUrl = $redirectUrl;

        return $this;
    }

    /**
     * Get redirectUrl
     *
     * @return string
     */
    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }

    /**
     * Set shop
     *
     * @param \AppBundle\Entity\Shop $shop
     *
     * @return Promotion
     */
    public function setShop(\AppBundle\Entity\Shop $shop)
    {
        $this->shop = $shop;

        return $this;
    }

    /**
     * Get shop
     *
     * @return \AppBundle\Entity\Shop
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * Set sponsor
     *
     * @param \AppBundle\Entity\Sponsor $sponsor
     *
     * @return Promotion
     */
    public function setSponsor(\AppBundle\Entity\Sponsor $sponsor)
    {
        $this->sponsor = $sponsor;

        return $this;
    }

    /**
     * Get sponsor
     *
     * @return \AppBundle\Entity\Sponsor
     */
    public function getSponsor()
    {
        return $this->sponsor;
    }

    /**
     * Set publisher
     *
     * @param \AdminBundle\Entity\Administrator $publisher
     *
     * @return Promotion
     */
    public function setPublisher(\AdminBundle\Entity\Administrator $publisher = null)
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * Get publisher
     *
     * @return \AdminBundle\Entity\Administrator
     */
    public function getPublisher()
    {
        return $this->publisher;
    }


    public function getDisplayName()
    {
        return $this->getPromotion();
    }
}
