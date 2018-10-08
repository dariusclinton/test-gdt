<?php
/**
 * Created by PhpStorm.
 * User: dariuso
 * Date: 08/10/18
 * Time: 13:57
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class AbstractEntity
 * @package AppBundle\Entity
 *
 * @ORM\MappedSuperclass()
 */
abstract class AbstractEntity
{

    /**
     * @var
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=false)
     */
    private $createdDate;


    public function __construct()
    {
        $this->createdDate = new \DateTime();
    }


    public function getCreatedDate() {
        return $this->createdDate;
    }

    public function setCreatedDate($createdDate) {
        $this->createdDate = $createdDate;

        return $this;
    }

    abstract public function getDisplayName();
}