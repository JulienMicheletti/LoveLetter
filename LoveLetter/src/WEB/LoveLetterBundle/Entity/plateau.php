<?php

namespace WEB\LoveLetterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Tests\Constraints\CardSchemeValidatorTest;

/**
 * pioche
 *
 * @ORM\Table(name="plateau")
 * @ORM\Entity(repositoryClass="WEB\LoveLetterBundle\Repository\plateauRepository")
 */
class plateau
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", unique=true)
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="WEB\LoveLetterBundle\Entity\carte", cascade={"persist"})
     */
    private $cartes;

    public function __construct()
    {
        $this->cartes = new ArrayCollection();
    }

    // Notez le singulier, on ajoute une seule catégorie à la fois
    public function addCarte(Carte $carte)
    {
        // Ici, on utilise l'ArrayCollection vraiment comme un tableau
        $this->cartes[] = $carte;

        return $this;
    }

    public function getNbElements(){
        $i = 0;
        foreach ($this->cartes as $carte) {
            $i++;
        }
        return $i;
    }

    public function removeCarte(Carte $carte)
    {
        // Ici on utilise une méthode de l'ArrayCollection, pour supprimer la catégorie en argument
        $this->cartes->removeElement($carte);
    }

    // Notez le pluriel, on récupère une liste de catégories ici !
    public function getCarte($i){
        return $this->cartes[$i];
    }
    public function getCartes()
    {
        return $this->cartes;
    }
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
     * Set idCarte
     *
     * @param integer $idCarte
     *
     * @return carte
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}

