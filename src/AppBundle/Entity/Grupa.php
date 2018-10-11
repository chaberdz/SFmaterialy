<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

use AppBundle\Entity\CreatedUpdated as Base;

/**
 * @ORM\Entity
 * @ORM\Table(name="grupa")
 * @ORM\HasLifecycleCallbacks()
 */
class Grupa extends Base
{
  /**
  * @ORM\Id
  * @ORM\GeneratedValue
  * @ORM\Column(type="integer")
  */
    private $id;

  /**
   * @ORM\Column(type="string", length=100)
   */
    private $nazwa;

  /**
   * @ORM\ManyToOne(targetEntity="Grupa")
   * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
   */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Material", mappedBy="grupa")
     */
     private $materials;

     public function __construct()
     {
         $this->materials = new ArrayCollection();
     }



    public function getId()
    {
        return $this->id;
    }


    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;

        return $this;
    }


    public function getNazwa()
    {
        return $this->nazwa;
    }


    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    function getParent()
    {
        return $this->parent;
    }
}
