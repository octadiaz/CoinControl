<?php

namespace App\Entity;

use App\Repository\CategoriaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriaRepository::class)]
class Categoria
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tipo = null;

    #[ORM\OneToMany(targetEntity: Transaccion::class, mappedBy: 'cate')]
    private Collection $cat_transaccion;

    public function __construct()
    {
        $this->cat_transaccion = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(?string $tipo): static
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * @return Collection<int, Transaccion>
     */
    public function getCatTransaccion(): Collection
    {
        return $this->cat_transaccion;
    }

    public function addCatTransaccion(Transaccion $catTransaccion): static
    {
        if (!$this->cat_transaccion->contains($catTransaccion)) {
            $this->cat_transaccion->add($catTransaccion);
            $catTransaccion->setCate($this);
        }

        return $this;
    }

    public function removeCatTransaccion(Transaccion $catTransaccion): static
    {
        if ($this->cat_transaccion->removeElement($catTransaccion)) {
            // set the owning side to null (unless already changed)
            if ($catTransaccion->getCate() === $this) {
                $catTransaccion->setCate(null);
            }
        }

        return $this;
    }
}
