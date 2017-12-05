<?php

namespace WEB\LoveLetterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="WEB\LoveLetterBundle\Repository\utilisateurRepository")
 */
class utilisateur implements UserInterface
{

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;

    /**
     * @ORM\Column(name="username", type="string", length=200, unique=true)
     */
    protected $username;

    /**
     * @var string
     *
     * @ORM\Column(name="mod_de_passe", type="string", length=200)
     */
    private $mot_de_passe;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_win", type="integer")
     */
    private $nbWin;

    /**
     * @ORM\OneToOne(targetEntity="WEB\LoveLetterBundle\Entity\pioche")
     */
    private $pioche;

    /**
     * @ORM\OneToOne(targetEntity="WEB\LoveLetterBundle\Entity\main")
     */
    private $main;

    /**
     * @ORM\OneToOne(targetEntity="WEB\LoveLetterBundle\Entity\defausse")
     */
    private $defausse;

    /**
     * Get pseudo
     *
     * @return int
     */
    public function getPseudo()
    {
        return $this->id;
    }

    /**
     * Get nbWin
     *
     * @return int
     */
    public function getNbWin()
    {
        return $this->nbWin;
    }

    public function setNbWin($nbWin)
    {
        $this->nbWin = $nbWin;
        return $this;
    }

    public function setMain($main){
        $this->main = $main;
    }

    public function getPioche()
    {
        return $this->pioche;
    }

    public function getMain()
    {
        return $this->main;
    }

    public function getDefausse()
    {
        return $this->defausse;
    }

    public function __toString(){
        return $this->username;
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
       return array('ROLE_USER');
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->mot_de_passe;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}