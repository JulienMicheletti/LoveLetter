<?php

namespace WEB\LoveLetterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;

/**
 * carte
 *
 * @ORM\Table(name="carte")
 * @ORM\Entity(repositoryClass="WEB\LoveLetterBundle\Repository\carteRepository")
 */
class carte
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=20, unique=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="effet", type="string", length=200, unique=true)
     */
    private $effet;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=200, unique=true)
     */
    private $image;


    /**
     * Set idCarte
     *
     * @param integer $idCarte
     *
     * @return carte
     */
    public function setId($idCarte)
    {
        $this->id = $idCarte;

        return $this;
    }

    /**
     * Get idCarte
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return carte
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set effet
     *
     * @param string $effet
     *
     * @return carte
     */
    public function setEffet($effet)
    {
        $this->effet = $effet;

        return $this;
    }

    /**
     * Get effet
     *
     * @return string
     */
    public function getEffet()
    {
        return $this->effet;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return carte
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

}