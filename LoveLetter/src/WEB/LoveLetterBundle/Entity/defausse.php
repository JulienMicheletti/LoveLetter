<?php

namespace WEB\LoveLetterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * defausse
 *
 * @ORM\Table(name="defausse")
 * @ORM\Entity(repositoryClass="WEB\LoveLetterBundle\Repository\defausseRepository")
 */
class defausse
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id_defausse", type="integer", unique=true)
     */
    private $idDefausse;

    /**
     * @var int
     *
     * @ORM\Column(name="id_carte", type="integer")
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
     * Set idDefausse
     *
     * @param integer $idDefausse
     *
     * @return defausse
     */
    public function setIdDefausse($idDefausse)
    {
        $this->idDefausse = $idDefausse;

        return $this;
    }

    /**
     * Get idDefausse
     *
     * @return int
     */
    public function getIdDefausse()
    {
        return $this->idDefausse;
    }

    /**
     * Set idCarte
     *
     * @param integer $idCarte
     *
     * @return defausse
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

