<?php

namespace App\Entity;

use App\Repository\TelefonosRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TelefonosRepository::class)]
class Telefonos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Marca = null;

    #[ORM\Column(length: 255)]
    private ?string $Modelo = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $Precio = null;

    #[ORM\Column(length: 255)]
    private ?string $Procesador = null;

    #[ORM\Column(length: 255)]
    private ?string $Ram = null;

    #[ORM\Column(length: 255)]
    private ?string $Almacenamiento = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarca(): ?string
    {
        return $this->Marca;
    }

    public function setMarca(string $Marca): self
    {
        $this->Marca = $Marca;

        return $this;
    }

    public function getModelo(): ?string
    {
        return $this->Modelo;
    }

    public function setModelo(string $Modelo): self
    {
        $this->Modelo = $Modelo;

        return $this;
    }

    public function getPrecio(): ?string
    {
        return $this->Precio;
    }

    public function setPrecio(string $Precio): self
    {
        $this->Precio = $Precio;

        return $this;
    }

    public function getProcesador(): ?string
    {
        return $this->Procesador;
    }

    public function setProcesador(string $Procesador): self
    {
        $this->Procesador = $Procesador;

        return $this;
    }

    public function getRam(): ?string
    {
        return $this->Ram;
    }

    public function setRam(string $Ram): self
    {
        $this->Ram = $Ram;

        return $this;
    }

    public function getAlmacenamiento(): ?string
    {
        return $this->Almacenamiento;
    }

    public function setAlmacenamiento(string $Almacenamiento): self
    {
        $this->Almacenamiento = $Almacenamiento;

        return $this;
    }
}
