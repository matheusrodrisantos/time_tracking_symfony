<?php

namespace App\Entity;

use App\Repository\CalculatedHoursRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CalculatedHoursRepository::class)]
class CalculatedHours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $worked_hours = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $hours_balance = null;

    #[ORM\ManyToOne(inversedBy: 'calculatedHours')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getWorkedHours(): ?\DateTimeInterface
    {
        return $this->worked_hours;
    }

    public function setWorkedHours(\DateTimeInterface $worked_hours): static
    {
        $this->worked_hours = $worked_hours;

        return $this;
    }

    public function getHoursBalance(): ?\DateTimeInterface
    {
        return $this->hours_balance;
    }

    public function setHoursBalance(\DateTimeInterface $hours_balance): static
    {
        $this->hours_balance = $hours_balance;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }
}
