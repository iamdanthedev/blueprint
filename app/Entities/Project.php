<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;

#[ORM\Entity]
#[ORM\Table(name: 'blp_project')]
class Project
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'Ramsey\Uuid\Doctrine\UuidGenerator')]
    protected string $id;

    #[ORM\Column(type: 'string')]
    protected string $key;

    #[ORM\Column(type: 'string')]
    protected string $name;

    #[ORM\ManyToOne(targetEntity: 'Workspace', inversedBy: 'projects')]
    #[ORM\JoinColumn(name: 'workspace_id', referencedColumnName: 'id')]
    private Workspace $workspace;

    public function getId(): string
    {
        return $this->id;
    }

    public function getWorkspace(): Workspace
    {
        return $this->workspace;
    }
}
