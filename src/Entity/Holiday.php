<?php

namespace App\Entity;

use App\Repository\HolidayRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HolidayRepository::class)]
class Holiday
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $every_year = null;

    #[ORM\Column]
    private ?bool $holiday_bridge = null;

    #[ORM\Column]
    private ?bool $half_day_friday = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
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

    public function getEveryYear(): ?int
    {
        return $this->every_year;
    }

    public function setEveryYear(int $every_year): static
    {
        $this->every_year = $every_year;

        return $this;
    }

    public function isHolidayBridge(): ?bool
    {
        return $this->holiday_bridge;
    }

    public function setHolidayBridge(bool $holiday_bridge): static
    {
        $this->holiday_bridge = $holiday_bridge;

        return $this;
    }

    public function isHalfDayFriday(): ?bool
    {
        return $this->half_day_friday;
    }

    public function setHalfDayFriday(bool $half_day_friday): static
    {
        $this->half_day_friday = $half_day_friday;

        return $this;
    }
}
