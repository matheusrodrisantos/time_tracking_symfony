<?php

namespace App\Entity;

use App\Repository\ScheduleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScheduleRepository::class)]
class Schedule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $daily_schedule = null;

    #[ORM\Column]
    private ?int $weekly_work_schedule = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $overtime_approved = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $lateness_tolerance = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDailySchedule(): ?\DateTimeInterface
    {
        return $this->daily_schedule;
    }

    public function setDailySchedule(\DateTimeInterface $daily_schedule): static
    {
        $this->daily_schedule = $daily_schedule;

        return $this;
    }

    public function getWeeklyWorkSchedule(): ?int
    {
        return $this->weekly_work_schedule;
    }

    public function setWeeklyWorkSchedule(int $weekly_work_schedule): static
    {
        $this->weekly_work_schedule = $weekly_work_schedule;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getOvertimeApproved(): ?\DateTimeInterface
    {
        return $this->overtime_approved;
    }

    public function setOvertimeApproved(\DateTimeInterface $overtime_approved): static
    {
        $this->overtime_approved = $overtime_approved;

        return $this;
    }

    public function getLatenessTolerance(): ?\DateTimeInterface
    {
        return $this->lateness_tolerance;
    }

    public function setLatenessTolerance(\DateTimeInterface $lateness_tolerance): static
    {
        $this->lateness_tolerance = $lateness_tolerance;

        return $this;
    }
}
