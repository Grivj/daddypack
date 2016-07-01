<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Package
 *
 * @ORM\Table(name="packages")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PackageRepository")
 */
class Package
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
     * @var int
     *
     * @ORM\Column(name="big_daddy", type="integer")
     */
    private $bigDaddy;

    /**
     * @var int
     *
     * @ORM\Column(name="speed_daddy", type="integer", nullable=true)
     */
    private $speedDaddy;

    /**
     * @var int
     *
     * @ORM\Column(name="user", type="integer", nullable=true)
     */
    private $user;

    /**
     * @var int
     *
     * @ORM\Column(name="weight", type="integer")
     */
    private $weight;

    /**
     * @var int
     *
     * @ORM\Column(name="statut", type="integer")
     */
    private $statut;

    /**
     * @var string
     *
     * @ORM\Column(name="address_recep", type="string", length=255, nullable=true)
     */
    private $address_recep;

    /**
     * @var string
     *
     * @ORM\Column(name="time_bdaddy", type="string", length=255, nullable=true)
     */
    private $time_bdaddy;

    /**
     * @var string
     *
     * @ORM\Column(name="time_sdaddy", type="string", length=255, nullable=true)
     */
    private $time_sdaddy;

    /**
     * @var string
     *
     * @ORM\Column(name="time_recep", type="string", length=255, nullable=true)
     */
    private $time_recep;




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
     * @return Package
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
     * Set bigDaddy
     *
     * @param integer $bigDaddy
     *
     * @return Package
     */
    public function setBigDaddy($bigDaddy)
    {
        $this->bigDaddy = $bigDaddy;

        return $this;
    }

    /**
     * Get bigDaddy
     *
     * @return int
     */
    public function getBigDaddy()
    {
        return $this->bigDaddy;
    }

    /**
     * Set speeddaddy
     *
     * @param integer $speeddaddy
     *
     * @return Package
     */
    public function setSpeedDaddy($speeddaddy)
    {
        $this->speedDaddy = $speeddaddy;

        return $this;
    }

    /**
     * Get speeddaddy
     *
     * @return int
     */
    public function getSpeedDaddy()
    {
        return $this->speedDaddy;
    }

    /**
     * Set user
     *
     * @param integer $user
     *
     * @return Package
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return int
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     *
     * @return Package
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set statut
     *
     * @param string $statut
     *
     * @return Package
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @return string
     */
    public function getAddressRecep()
    {
        return $this->address_recep;
    }

    /**
     * @param string $address_recep
     */
    public function setAddressRecep($address_recep)
    {
        $this->address_recep = $address_recep;
    }

    /**
     * @return string
     */
    public function getTimeBdaddy()
    {
        return $this->time_bdaddy;
    }

    /**
     * @param string $time_bdaddy
     */
    public function setTimeBdaddy($time_bdaddy)
    {
        $this->time_bdaddy = $time_bdaddy;
    }

    /**
     * @return string
     */
    public function getTimeSdaddy()
    {
        return $this->time_sdaddy;
    }

    /**
     * @param string $time_sdaddy
     */
    public function setTimeSdaddy($time_sdaddy)
    {
        $this->time_sdaddy = $time_sdaddy;
    }

    /**
     * @return string
     */
    public function getTimeRecep()
    {
        return $this->time_recep;
    }

    /**
     * @param string $time_recep
     */
    public function setTimeRecep($time_recep)
    {
        $this->time_recep = $time_recep;
    }

}

