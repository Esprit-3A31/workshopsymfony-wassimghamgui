<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $cin = null;

    #[ORM\Column(length: 100)]
    private ?string $username = null;
    public function getcin(): ?string
    {
        return $this->cin;
    }
    public function setcin(string $cin): self
    {
        $this->cin = $cin;

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
}
