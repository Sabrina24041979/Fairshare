<?php

namespace App\Entity;

use App\Repository\MemberGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MemberGroupRepository::class)]
class MemberGroup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_enrolment = null;

    #[ORM\Column(length: 255)]
    private ?string $role = null;

    #[ORM\ManyToMany(targetEntity: group::class, inversedBy: 'memberGroups')]
    private Collection $groupe;

    public function __construct()
    {
        $this->groupe = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEnrolment(): ?\DateTimeInterface
    {
        return $this->date_enrolment;
    }

    public function setDateEnrolment(?\DateTimeInterface $date_enrolment): static
    {
        $this->date_enrolment = $date_enrolment;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection<int, group>
     */
    public function getGroupe(): Collection
    {
        return $this->groupe;
    }

    public function addGroupe(group $groupe): static
    {
        if (!$this->groupe->contains($groupe)) {
            $this->groupe->add($groupe);
        }

        return $this;
    }

    public function removeGroupe(group $groupe): static
    {
        $this->groupe->removeElement($groupe);

        return $this;
    }
}
