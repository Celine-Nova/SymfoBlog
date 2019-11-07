<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
    public function getSalt()
    {
        
    }

    public function eraseCredentials()
    {

    }
    /*
     Attention : cette fonction est dediée au module de securité de chez symfo
     Ce module prevoit de base que l'on puisse retourner plusieurs roles si souhaité.
     Cette fonction est obligatoire meme si mon utilisateur n'a qu'un et un seul role.

     Cette fonction n'est pas dediée à l'interface entre doctrine / mysql directement mais bien la debugtoolbar par exemple
     */
    public function getRoles() //attention cela est appelé aussi une seule fois a la creation de la session. Si je veux changer la valeur je dois d'abord me deconnecter
    {
        return ['ROLE_USER'];
    }

}
