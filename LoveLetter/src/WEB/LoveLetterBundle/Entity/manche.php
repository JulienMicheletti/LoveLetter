<?php

namespace WEB\LoveLetterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;

/**
 * manche
 *
 * @ORM\Table(name="manche")
 * @ORM\Entity(repositoryClass="WEB\LoveLetterBundle\Repository\mancheRepository")
 */
class manche
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="gagnant", type="string", length=200, unique=true)
     */
    private $gagnant;

    /**
     * @ORM\OneToOne(targetEntity="WEB\LoveLetterBundle\Entity\defausse")
     */
    private $defausse;

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return manche
     */
    public function setId($id)
    {
        $this->id = $id;

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
     * @return manche
     */
    public function setGagnant($gagnant)
    {
        $this->gagnant = $gagnant;

        return $this;
    }

    /**
     * Get gagnant
     *
     * @return string
     */
    public function getGagnant()
    {
        return $this->gagnant;
    }
    public function setDefausse(Defaussse $defausse)
    {
        $this->defausse = $defausse;

        return $this;
    }

    public function getDefausse()
    {
        return $this->defausse;
    }

}
