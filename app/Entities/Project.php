<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'blp_project')]
class Project extends BaseEntity
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'Ramsey\Uuid\Doctrine\UuidGenerator')]
    protected string $id;

    #[ORM\Column(type: 'string')]
    protected string $projectKey;

    #[ORM\Column(type: 'string')]
    protected string $name;

    #[ORM\ManyToOne(targetEntity: 'Workspace', inversedBy: 'projects')]
    #[ORM\JoinColumn(name: 'workspace_id', referencedColumnName: 'id')]
    private Workspace $workspace;

    #[ORM\Column(nullable: true)]
    protected ?string $remote;

    public function __construct(Workspace $workspace, string $key, string $name)
    {
        $this->workspace = $workspace;
        $this->projectKey = $key;
        $this->name = $name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getWorkspace(): Workspace
    {
        return $this->workspace;
    }

    /**
     * @return string|null
     */
    public function getRemote(): ?string
    {
        return $this->remote;
    }

    /**
     * @param string|null $remote
     */
    public function setRemote(?string $remote): void
    {
        $this->remote = $remote;
    }

    public function toJson() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'projectKey' => $this->projectKey,
            'workspace' => $this->workspace->toJson(),
        ];
    }
}
