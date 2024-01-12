<?php

namespace App\Entity;

use App\Repository\GroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupRepository::class)]
#[ORM\Table(name: '`group`')]
class Group
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(nullable: true)]
    private ?int $member = null;

    #[ORM\Column(nullable: true)]
    private ?int $ticket = null;

    #[ORM\ManyToMany(targetEntity: MemberGroup::class, mappedBy: 'groupe')]
    private Collection $memberGroups;

    public function __construct()
    {
        $this->memberGroups = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getMember(): ?int
    {
        return $this->member;
    }

    public function setMember(?int $member): static
    {
        $this->member = $member;

        return $this;
    }

    public function getTicket(): ?int
    {
        return $this->ticket;
    }

    public function setTicket(?int $ticket): static
    {
        $this->ticket = $ticket;

        return $this;
    }

    /**
     * @return Collection<int, MemberGroup>
     */
    public function getMemberGroups(): Collection
    {
        return $this->memberGroups;
    }

    public function addMemberGroup(MemberGroup $memberGroup): static
    {
        if (!$this->memberGroups->contains($memberGroup)) {
            $this->memberGroups->add($memberGroup);
            $memberGroup->addGroupe($this);
        }

        return $this;
    }

    public function removeMemberGroup(MemberGroup $memberGroup): static
    {
        if ($this->memberGroups->removeElement($memberGroup)) {
            $memberGroup->removeGroupe($this);
        }

        return $this;
    }
}
