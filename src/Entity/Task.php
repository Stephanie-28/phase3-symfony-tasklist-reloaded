<?php

namespace App\Entity;

use App\Enum\StatusEnum;
use App\Repository\TaskRepository;
use App\Entity\Priority;
use App\Entity\Folder;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $Title = null;

    #[ORM\Column]
    private ?bool $IsPinned = null;

    #[ORM\Column(enumType: StatusEnum::class)]
    private ?StatusEnum $StatusEnum = null;

    #[ORM\ManyToOne(targetEntity: Priority::class)]
    private ?Priority $priority = null;

    #[ORM\ManyToOne(targetEntity: Folder::class)]
    private ?Folder $folder = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): static
    {
        $this->Title = $Title;

        return $this;
    }

    public function isPinned(): ?bool
    {
        return $this->IsPinned;
    }

    public function setIsPinned(bool $IsPinned): static
    {
        $this->IsPinned = $IsPinned;

        return $this;
    }

    public function getStatusEnum(): ?StatusEnum
    {
        return $this->StatusEnum;
    }

    public function setStatusEnum(StatusEnum $StatusEnum): static
    {
        $this->StatusEnum = $StatusEnum;

        return $this;
    }

    public function getPriority(): ?Priority
    {
        return $this->priority;
    }

    public function setPriority(?Priority $priority): static
    {
        $this->priority = $priority;
        return $this;
    }

    public function getFolder(): ?Folder
    {
        return $this->folder;
    }

    public function setFolder(?Folder $folder): static
    {
        $this->folder = $folder;
        return $this;
    }
}
