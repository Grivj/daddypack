<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SpeedDaddy
 *
 * @ORM\Table(name="speed_daddy")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SpeedDaddyRepository")
 */
class SpeedDaddy
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
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var int
     *
     * @ORM\Column(name="conveyance", type="integer")
     */
    private $conveyance;

    /**
     * @var int
     *
     * @ORM\Column(name="capacity", type="integer")
     */
    private $capacity;


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
     * Set lastname
     *
     * @param string $lastname
     *
     * @return SpeedDaddy
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return SpeedDaddy
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set conveyance
     *
     * @param integer $conveyance
     *
     * @return SpeedDaddy
     */
    public function setConveyance($conveyance)
    {
        $this->conveyance = $conveyance;

        return $this;
    }

    /**
     * Get conveyance
     *
     * @return int
     */
    public function getConveyance()
    {
        return $this->conveyance;
    }

    /**
     * Set capacity
     *
     * @param integer $capacity
     *
     * @return SpeedDaddy
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity
     *
     * @return int
     */
    public function getCapacity()
    {
        return $this->capacity;
    }
}

