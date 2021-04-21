<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use DateTime;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user_contact_phone")
 */
class Phone
{

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="telefones")
     * @ORM\JoinColumn(name="user_id", nullable=false, referencedColumnName="id")
     **/
    private $user;

    /**
     * @ORM\Column(type="integer")
     */
    private int $codigo_area;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private string $numero;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTime $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCodigoArea(): int
    {
        return $this->codigo_area;
    }

    public function setCodigoArea(string $codigo_area): void
    {
        $this->codigo_area = $codigo_area;
    }

    public function getNumero(): string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): void
    {
        $this->numero = $numero;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $user->addTelefone($this);
        $this->user = $user;
    }

}
