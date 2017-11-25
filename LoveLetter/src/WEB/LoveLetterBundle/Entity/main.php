<?php

namespace WEB\LoveLetterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * main
 *
 * @ORM\Table(name="main")
 * @ORM\Entity(repositoryClass="WEB\LoveLetterBundle\Repository\mainRepository")
 */
class main
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
     * @ORM\Column(name="id_main", type="integer")
     */
    private $idMain;

    /**
     * @var int
     *
     * @ORM\Column(name="id_carte", type="integer", nullable=true)
     */
    private $idCarte;

    /**
     * @var string
     *
     * @ORM\Column(name="pseudo", type="string", length=20)
     */
    private $pseudo;


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
     * Set idMain
     *
     * @param integer $idMain
     *
     * @return main
     */
    public function setIdMain($idMain)
    {
        $this->idMain = $idMain;

        return $this;
    }

    /**
     * Get idMain
     *
     * @return int
     */
    public function getIdMain()
    {
        return $this->idMain;
    }

    /**
     * Set idCarte
     *
     * @param integer $idCarte
     *
     * @return main
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

    /**
     * Set pseudo
     *
     * @param string $pseudo
     *
     * @return main
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }
}

