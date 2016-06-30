<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Package
 *
 * @ORM\Table(name="package")
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
     * @ORM\Column(name="speed_dady", type="integer", nullable=true)
     */
    private $speedDady;

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
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=255)
     */
    private $statut;


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
     * Set speedDady
     *
     * @param integer $speedDady
     *
     * @return Package
     */
    public function setSpeedDady($speedDady)
    {
        $this->speedDady = $speedDady;

        return $this;
    }

    /**
     * Get speedDady
     *
     * @return int
     */
    public function getSpeedDady()
    {
        return $this->speedDady;
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
}

