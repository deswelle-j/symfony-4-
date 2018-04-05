<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParticipantRepository")
 */
class Participant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $haveCar;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVincent;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Event", inversedBy="participants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $event;


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

    public function getHaveCar(): ?bool
    {
        return $this->haveCar;
    }

    public function setHaveCar(bool $haveCar): self
    {
        $this->haveCar = $haveCar;

        return $this;
    }

    public function getIsVincent(): ?bool
    {
        return $this->isVincent;
    }

    public function setIsVincent(bool $isVincent): self
    {
        $this->isVincent = $isVincent;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

}
