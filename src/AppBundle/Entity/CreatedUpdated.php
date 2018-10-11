<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;


abstract class CreatedUpdated
{


    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
      protected $createdAt;

    /**
     * @ORM\Column(type="datetime", name="updated_at", nullable=true)
     */
      protected $updatedAt;


    public function getCreatedAt(){
      return $this->createdAt;
    }

    public function setCreatedAt($createdAt){
      $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(){
      return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt){
      $this->updatedAt = $updatedAt;
    }


        /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->updatedAt = new \DateTime();
    }

}
