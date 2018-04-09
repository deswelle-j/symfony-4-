<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 */
class Event
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Length(
     *  min = 3,
     * minMessage = "Votre nom doit au minimum contenir {{ Limit}} caratères",
     * )
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Assert\NotBlank()
     * @Assert\GreaterThan("today")
     * @ORM\Column(type="datetime")
     */
    private $startAt;

    /**
     * @Assert\NotBlank()
     * @Assert\GreaterThan(propertyPath="startAt")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $shouldEndAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Participant", mappedBy="event", orphanRemoval=true)
     */
    private $participants;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Option", inversedBy="events")
     */
    private $options;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Place")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private $place;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
        $this->options = new ArrayCollection();
    }



    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeInterface $startAt = null ): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getShouldEndAt(): ?\DateTimeInterface
    {
        return $this->shouldEndAt;
    }

    public function setShouldEndAt(\DateTimeInterface $shouldEndAt = null): self
    {
        $this->shouldEndAt = $shouldEndAt;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Participant[]
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(Participant $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants[] = $participant;
            $participant->setEvent($this);
        }

        return $this;
    }

    public function removeParticipant(Participant $participant): self
    {
        if ($this->participants->contains($participant)) {
            $this->participants->removeElement($participant);
            // set the owning side to null (unless already changed)
            if ($participant->getEvent() === $this) {
                $participant->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Option[]
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(Option $option): self
    {
        if (!$this->options->contains($option)) {
            $this->options[] = $option;
        }

        return $this;
    }

    public function removeOption(Option $option): self
    {
        if ($this->options->contains($option)) {
            $this->options->removeElement($option);
        }

        return $this;
    }

    public function getPlace(): ?Place
    {
        return $this->place;
    }

    public function setPlace(?Place $place): self
    {
        $this->place = $place;

        return $this;
    }

}
