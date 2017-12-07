<?php

namespace WEB\LoveLetterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Tests\Constraints\CardSchemeValidatorTest;

/**
 * main
 *
 * @ORM\Table(name="main")
 * @ORM\Entity(repositoryClass="WEB\LoveLetterBundle\Repository\mainRepository")
 */
class main
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="string", length=200)
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="WEB\LoveLetterBundle\Entity\carte", cascade={"persist"})
     */
    private $cartes;

    /**
     * @ORM\Column(name="visible", type="integer", nullable=true)
     */
    private $visible;

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

    public function getNbCartes(){
        return $this->cartes->count();
    }

    public function removeCarte(Carte $carte)
    {
        // Ici on utilise une méthode de l'ArrayCollection, pour supprimer la catégorie en argument
        $this->cartes->removeElement($carte);
    }

    public function removeAll(){
        foreach ($this->cartes as $carte){
            $this->cartes->removeElement($carte);
        }
    }

    // Notez le pluriel, on récupère une liste de catégories ici !
    public function getCarte($i){
        return $this->cartes->get($i);
    }

    public function getIdCarte($i){
        foreach ($this->cartes as $carte) {
            if ($carte->getId() == $i){
                return $carte;
            }
        }
        return null;
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
     * @param integer $id
     *
     * @return main
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setVisible($var){
        $this->visible = $var;
    }

    public function getVisible(){
        return $this->visible;
    }
}

