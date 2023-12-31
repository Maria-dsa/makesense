<?php

namespace App\Entity;

use App\Repository\DecisionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DecisionRepository::class)]
class Decision
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez indiquer un titre')]
    #[Assert\Length(max: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $utility = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $context = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $benefits = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $inconvenients = null;

    #[ORM\OneToMany(mappedBy: 'decision', targetEntity: Contributor::class, cascade: ['persist', 'remove'])]
    private Collection $contributors;

    #[ORM\ManyToOne(inversedBy: 'decision')]
    private ?User $user = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $firstDecision = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $definitiveDecision = null;

    #[ORM\OneToMany(mappedBy: 'decision', targetEntity: Contribution::class, cascade: ['persist', 'remove'])]
    private Collection $contributions;

    #[ORM\OneToMany(mappedBy: 'decision', targetEntity: Timeline::class, cascade: ['persist', 'remove'])]
    private Collection $timelines;

    public function __construct()
    {
        $this->contributors = new ArrayCollection();
        $this->contributions = new ArrayCollection();
        $this->timelines = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getUtility(): ?string
    {
        return $this->utility;
    }

    public function setUtility(?string $utility): self
    {
        $this->utility = $utility;

        return $this;
    }

    public function getContext(): ?string
    {
        return $this->context;
    }

    public function setContext(?string $context): self
    {
        $this->context = $context;

        return $this;
    }

    public function getBenefits(): ?string
    {
        return $this->benefits;
    }

    public function setBenefits(?string $benefits): self
    {
        $this->benefits = $benefits;

        return $this;
    }

    public function getInconvenients(): ?string
    {
        return $this->inconvenients;
    }

    public function setInconvenients(?string $inconvenients): self
    {
        $this->inconvenients = $inconvenients;

        return $this;
    }

    /**
     * @return Collection<int, Contributor>
     */
    public function getContributors(): Collection
    {
        return $this->contributors;
    }

    public function addContributor(Contributor $contributor): self
    {
        if (!$this->contributors->contains($contributor)) {
            $this->contributors->add($contributor);
            $contributor->setDecision($this);
        }

        return $this;
    }

    public function removeContributor(Contributor $contributor): self
    {
        if ($this->contributors->removeElement($contributor)) {
            // set the owning side to null (unless already changed)
            if ($contributor->getDecision() === $this) {
                $contributor->setDecision(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getFirstDecision(): ?string
    {
        return $this->firstDecision;
    }

    public function setFirstDecision(?string $firstDecision): self
    {
        $this->firstDecision = $firstDecision;

        return $this;
    }

    public function getDefinitiveDecision(): ?string
    {
        return $this->definitiveDecision;
    }

    public function setDefinitiveDecision(?string $definitiveDecision): self
    {
        $this->definitiveDecision = $definitiveDecision;

        return $this;
    }

    /**
     * @return Collection<int, Contribution>
     */
    public function getContributions(): Collection
    {
        return $this->contributions;
    }

    public function addContribution(Contribution $contribution): self
    {
        if (!$this->contributions->contains($contribution)) {
            $this->contributions->add($contribution);
            $contribution->setDecision($this);
        }

        return $this;
    }

    public function removeContribution(Contribution $contribution): self
    {
        if ($this->contributions->removeElement($contribution)) {
            // set the owning side to null (unless already changed)
            if ($contribution->getDecision() === $this) {
                $contribution->setDecision(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Timeline>
     */
    public function getTimelines(): Collection
    {
        return $this->timelines;
    }

    public function addTimeline(Timeline $timeline): self
    {
        if (!$this->timelines->contains($timeline)) {
            $this->timelines->add($timeline);
            $timeline->setDecision($this);
        }

        return $this;
    }

    public function removeTimeline(Timeline $timeline): self
    {
        if ($this->timelines->removeElement($timeline)) {
            // set the owning side to null (unless already changed)
            if ($timeline->getDecision() === $this) {
                $timeline->setDecision(null);
            }
        }

        return $this;
    }
}
