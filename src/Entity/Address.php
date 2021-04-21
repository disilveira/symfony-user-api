<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;


/**
 * @ORM\Entity()
 * @ORM\Table(name="user_address")
 */
class Address
{   

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private int $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="endereco")
     * @ORM\JoinColumn(name="user_id", nullable=false, referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private string $estado;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private string $cidade;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private string $bairro;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private string $rua;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private string $numero;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private string $complemento;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTime $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public function getId(): int {
        return $this->id;
    }

    public function getEstado(): string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): void
    {
        $this->estado = $estado;
    }

    public function getCidade(): string
    {
        return $this->cidade;
    }

    public function setCidade(string $cidade): void
    {
        $this->cidade = $cidade;
    }

    public function getBairro(): string
    {
        return $this->bairro;
    }

    public function setBairro(string $bairro): void
    {
        $this->bairro = $bairro;
    }

    public function getRua(): string
    {
        return $this->rua;
    }

    public function setRua(string $rua): void
    {
        $this->rua = $rua;
    }

    public function getNumero(): string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): void
    {
        $this->numero = $numero;
    }

    public function getComplemento(): string
    {
        return $this->complemento;
    }

    public function setComplemento(string $complemento): void
    {
        $this->complemento = $complemento;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user): void
    {
        $this->user = $user;
    }
    
}
