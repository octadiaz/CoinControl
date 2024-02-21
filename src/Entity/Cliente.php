<?php

namespace App\Entity;

use App\Repository\ClienteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClienteRepository::class)]


class Cliente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $apellido = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $mail = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $telefono = null;

    #[ORM\Column(nullable: false)]
    private ?int $dni = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $direccion = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $localidad = null;

    #[ORM\Column(type: Types::BIGINT, nullable: false)]
    private ?string $saldo = null;

    #[ORM\OneToMany(targetEntity: Transaccion::class, mappedBy: 'cliente')]
    private Collection $cliente_transaccion;

    #[ORM\Column(length: 255)]
    private ?string $contraseña = null;

    public function __construct()
    {
        $this->cliente_transaccion = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(?string $apellido): static
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): static
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getDni(): ?int
    {
        return $this->dni;
    }

    public function setDni(?int $dni): static
    {
        $this->dni = $dni;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(?string $direccion): static
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getLocalidad(): ?string
    {
        return $this->localidad;
    }

    public function setLocalidad(?string $localidad): static
    {
        $this->localidad = $localidad;

        return $this;
    }

    public function getSaldo(): ?string
    {
        return $this->saldo;
    }

    public function setSaldo(?string $saldo): static
    {
        $this->saldo = $saldo;

        return $this;
    }

    /**
     * @return Collection<int, Transaccion>
     */
    public function getClienteTransaccion(): Collection
    {
        return $this->cliente_transaccion;
    }

    public function addClienteTransaccion(Transaccion $clienteTransaccion): static
    {
        if (!$this->cliente_transaccion->contains($clienteTransaccion)) {
            $this->cliente_transaccion->add($clienteTransaccion);
            $clienteTransaccion->setCliente($this);
        }

        return $this;
    }

    public function removeClienteTransaccion(Transaccion $clienteTransaccion): static
    {
        if ($this->cliente_transaccion->removeElement($clienteTransaccion)) {
            // set the owning side to null (unless already changed)
            if ($clienteTransaccion->getCliente() === $this) {
                $clienteTransaccion->setCliente(null);
            }
        }

        return $this;
    }

    public function getContraseña(): ?string
    {
        return $this->contraseña;
    }

    public function setContraseña(string $contraseña): static
    {
        $this->contraseña = $contraseña;

        return $this;
    }
}
