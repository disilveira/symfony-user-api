<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
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
     * @ORM\OneToOne(targetEntity="App\Entity\Address", cascade={"all"})
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    private $endereco;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Phone", mappedBy="user", cascade={"all"})
     */
    private $telefones;

    /**
     * @ORM\Column(type="string", length=150)
     * @Assert\NotBlank(message="Este valor é obrigatório")
     */
    private string $nome;

    /**
     * @ORM\Column(type="string", length=150)
     * @Assert\NotBlank(message="Este valor é obrigatório")
     */
    private string $sobrenome;

    /**
     * @ORM\Column(type="string", length=150)
     * @Assert\NotBlank(message="Este valor é obrigatório")
     * @Assert\Email(message="E-mail inválido")
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

    public function setEndereco(Address $endereco)
    {
        $this->endereco = $endereco;
    }

    public function addTelefone(Phone $telefone)
    {
        $this->telefones[] = $telefone;
    }

    public function getTelefones()
    {
        return $this->telefones;
    }

}
