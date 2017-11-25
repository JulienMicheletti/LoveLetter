<?php

namespace WEB\LoveLetterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * pioche
 *
 * @ORM\Table(name="pioche")
 * @ORM\Entity(repositoryClass="WEB\LoveLetterBundle\Repository\piocheRepository")
 */
class pioche
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
     * @var int
     *
     * @ORM\Column(name="id_pioche", type="integer", unique=true)
     */
    private $idPioche;

    /**
     * @var int
     *
     * @ORM\Column(name="id_carte", type="integer", nullable=true)
     */
    private $idCarte;


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
     * Set idPioche
     *
     * @param integer $idPioche
     *
     * @return pioche
     */
    public function setIdPioche($idPioche)
    {
        $this->idPioche = $idPioche;

        return $this;
    }

    /**
     * Get idPioche
     *
     * @return int
     */
    public function getIdPioche()
    {
        return $this->idPioche;
    }

    /**
     * Set idCarte
     *
     * @param integer $idCarte
     *
     * @return pioche
     */
    public function setIdCarte($idCarte)
    {
        $this->idCarte = $idCarte;

        return $this;
    }

    /**
     * Get idCarte
     *
     * @return int
     */
    public function getIdCarte()
    {
        return $this->idCarte;
    }
}

