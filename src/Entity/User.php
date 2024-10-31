<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\HasLifecycleCallbacks]

class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 300)]
    private ?string $name = null;

    #[ORM\Column(length: 600)]
    private ?string $password = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birth_date = null;

    #[ORM\Column(length: 12, nullable: true)]
    private ?string $postcode = null;

    #[ORM\Column(length: 25)]
    private ?string $status = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $code_erp = null;

    #[ORM\Column(length: 300, nullable: true)]
    private ?string $photo = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $hire_date = null;

    #[ORM\Column(length: 300)]
    private ?string $email = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, TimeRecord>
     */
    #[ORM\OneToMany(targetEntity: TimeRecord::class, mappedBy: 'user_id')]
    private Collection $timeRecords;

    /**
     * @var Collection<int, CalculatedHours>
     */
    #[ORM\OneToMany(targetEntity: CalculatedHours::class, mappedBy: 'user_id')]
    private Collection $calculatedHours;

    /**
     * @var Collection<int, Vacation>
     */
    #[ORM\OneToMany(targetEntity: Vacation::class, mappedBy: 'username', orphanRemoval: true)]
    private Collection $vacations;

    public function __construct()
    {
        $this->timeRecords = new ArrayCollection();
        $this->calculatedHours = new ArrayCollection();
        $this->vacations = new ArrayCollection();
    }

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birth_date;
    }

    public function setBirthDate(\DateTimeInterface $birth_date): static
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(?string $postcode): static
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getCodeErp(): ?string
    {
        return $this->code_erp;
    }

    public function setCodeErp(?string $code_erp): static
    {
        $this->code_erp = $code_erp;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getHireDate(): ?\DateTimeInterface
    {
        return $this->hire_date;
    }

    public function setHireDate(\DateTimeInterface $hire_date): static
    {
        $this->hire_date = $hire_date;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }
    #[ORM\PrePersist]
    public function setCreatedAt( ): void
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }
    #[ORM\PreUpdate]
    public function setUpdatedAt(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    /**
     * @return Collection<int, TimeRecord>
     */
    public function getTimeRecords(): Collection
    {
        return $this->timeRecords;
    }

    public function addTimeRecord(TimeRecord $timeRecord): static
    {
        if (!$this->timeRecords->contains($timeRecord)) {
            $this->timeRecords->add($timeRecord);
            $timeRecord->setUserId($this);
        }

        return $this;
    }

    public function removeTimeRecord(TimeRecord $timeRecord): static
    {
        if ($this->timeRecords->removeElement($timeRecord)) {
            // set the owning side to null (unless already changed)
            if ($timeRecord->getUserId() === $this) {
                $timeRecord->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CalculatedHours>
     */
    public function getCalculatedHours(): Collection
    {
        return $this->calculatedHours;
    }

    public function addCalculatedHour(CalculatedHours $calculatedHour): static
    {
        if (!$this->calculatedHours->contains($calculatedHour)) {
            $this->calculatedHours->add($calculatedHour);
            $calculatedHour->setUserId($this);
        }

        return $this;
    }

    public function removeCalculatedHour(CalculatedHours $calculatedHour): static
    {
        if ($this->calculatedHours->removeElement($calculatedHour)) {
            // set the owning side to null (unless already changed)
            if ($calculatedHour->getUserId() === $this) {
                $calculatedHour->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Vacation>
     */
    public function getVacations(): Collection
    {
        return $this->vacations;
    }

    public function addVacation(Vacation $vacation): static
    {
        if (!$this->vacations->contains($vacation)) {
            $this->vacations->add($vacation);
            $vacation->setUsername($this);
        }

        return $this;
    }

    public function removeVacation(Vacation $vacation): static
    {
        if ($this->vacations->removeElement($vacation)) {
            // set the owning side to null (unless already changed)
            if ($vacation->getUsername() === $this) {
                $vacation->setUsername(null);
            }
        }

        return $this;
    }
}
