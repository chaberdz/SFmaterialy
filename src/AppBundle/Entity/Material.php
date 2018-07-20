<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="material")
 */
class Material
{
  /**
  * @ORM\Id
  * @ORM\GeneratedValue
  * @ORM\Column(type="integer")
  */
    private $id;

    /**
     * @ORM\Column(type="string", length=5)
     * @Assert\Length(
     *    max = 5
     * )
     */
    private $kod;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 3,
     *      max = 30,
     * )
     */
    private $nazwa;

    /**
     * @ORM\ManyToOne(targetEntity="Jednostka")
     * @ORM\JoinColumn(name="jednostka_id", referencedColumnName="id")
     */
    private $jednostka;

    /**
     * @ORM\ManyToOne(targetEntity="Grupa")
     * @ORM\JoinColumn(name="grupa_id", referencedColumnName="id")
     */
    private $grupa;


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
     * Set kod
     *
     * @param string $kod
     * @return Material
     */
    public function setKod($kod)
    {
        $this->kod = $kod;

        return $this;
    }

    /**
     * Get kod
     *
     * @return string
     */
    public function getKod()
    {
        return $this->kod;
    }

    /**
     * Set nazwa
     *
     * @param string $nazwa
     * @return Material
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
     * Set jednostkaId
     *
     * @param integer $jednostkaId
     * @return Material
     */
    public function setJednostka($jednostka)
    {
        $this->jednostka = $jednostka;

        return $this;
    }

    /**
     * Get jednostkaId
     *
     * @return integer
     */
    public function getJednostka()
    {
        return $this->jednostka;
    }

    /**
     * Set grupaId
     *
     * @param integer $grupaId
     * @return Material
     */
    public function setGrupa($grupa)
    {
        $this->grupa = $grupa;

        return $this;
    }

    /**
     * Get grupaId
     *
     * @return integer
     */
    public function getGrupa()
    {
        return $this->grupa;
    }
}
