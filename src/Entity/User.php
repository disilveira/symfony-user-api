<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity()
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private int $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Address", mappedBy="user", cascade={"all"})
     */
    private $endereco;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Phone", cascade={"all"})
     * @ORM\JoinTable(name="users_phone_numbers", 
     * joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     * )
     */
    private $telefones;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private string $nome;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private string $sobrenome;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private string $email;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTime $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->telefones = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getSobrenome(): string
    {
        return $this->sobrenome;
    }

    public function setSobrenome(string $sobrenome): void
    {
        $this->sobrenome = $sobrenome;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
    
    public function getEndereco()
    {
        return $this->endereco;
    }

    public function getTelefones()
    {
        return $this->telefones;
    }

    public function setTelefones(Phone $telefone)
    {
        $this->telefones[] = $telefone;
    }

}
