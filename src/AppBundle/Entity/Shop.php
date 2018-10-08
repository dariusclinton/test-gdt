<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shop
 *
 * @ORM\Table(name="gdt_shop")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ShopRepository")
 */
class Shop extends AbstractEntity
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * @var
     *
     * @ORM\OneToOne(
     *     targetEntity="AppBundle\Entity\Image",
     *     cascade={"persist", "merge", "remove"}
     *     )
     */
    private $logo;


    /**
     * @var
     *
     * @ORM\OneToMany(
     *     targetEntity="AppBundle\Entity\Promotion",
     *     mappedBy="shop",
     *     orphanRemoval=true
     * )
     */
    private $promotions;

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
     * Set name
     *
     * @param string $name
     *
     * @return Shop
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->promotions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set logo
     *
     * @param \AppBundle\Entity\Image $logo
     *
     * @return Shop
     */
    public function setLogo(\AppBundle\Entity\Image $logo = null)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return \AppBundle\Entity\Image
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Add promotion
     *
     * @param \AppBundle\Entity\Promotion $promotion
     *
     * @return Shop
     */
    public function addPromotion(\AppBundle\Entity\Promotion $promotion)
    {
        $this->promotions[] = $promotion;
        $promotion->setShop($this);

        return $this;
    }

    /**
     * Remove promotion
     *
     * @param \AppBundle\Entity\Promotion $promotion
     */
    public function removePromotion(\AppBundle\Entity\Promotion $promotion)
    {
        $this->promotions->removeElement($promotion);
        $promotion->setShop(null);
    }

    /**
     * Get promotions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPromotions()
    {
        return $this->promotions;
    }

    public function getDisplayName()
    {
        return $this->getName();
    }
}
