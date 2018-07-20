<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="jednostka")
 */

class Jednostka
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
     * @ORM\Column(type="string", length=100)
     * @Assert\Length (max = 7, maxMessage = "Skrót nie powinien być dłuższy niż 7 znaków")
     */
    private $skrot;


    /**
     * @ORM\OneToMany(targetEntity="Material", mappedBy="jednostka")
     */
    private $materials;

    public function __construct()
    {
        $this->materials = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nazwa
     *
     * @param string $nazwa
     * @return Jednostka
     */
    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    /**
     * Get nazwa
     *
     * @return string
     */
    public function getNazwa()
    {
        return $this->nazwa;
    }

    /**
     * Set skrot
     *
     * @param string $skrot
     * @return Jednostka
     */
    public function setSkrot($skrot)
    {
        $this->skrot = $skrot;

        return $this;
    }

    /**
     * Get skrot
     *
     * @return string
     */
    public function getSkrot()
    {
        return $this->skrot;
    }
}
