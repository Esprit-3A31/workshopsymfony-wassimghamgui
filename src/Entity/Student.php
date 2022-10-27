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
    
    #[ORM\ManyToOne(inversedBy: 'Student')]
    #[ORM\JoinColumn(onDelete:"CASCADE")]
    private ?Classroom $classroom = null;

    #[ORM\Column(nullable: true)]
    private ?float $moyenne = null;
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

    public function getClassroom(): ?Classroom
    {
        return $this->classroom;
    }

    public function setClassroom(?Classroom $classroom): self
    {
        $this->classroom = $classroom;

        return $this;
    }

    public function getMoyenne(): ?float
    {
        return $this->moyenne;
    }

    public function setMoyenne(?float $moyenne): self
    {
        $this->moyenne = $moyenne;

        return $this;
    }
}
