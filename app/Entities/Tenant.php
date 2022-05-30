<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'blp_tenant')]
class Tenant
{
    #[Id]
    #[Column(type: 'uuid')]
    #[GeneratedValue(strategy: 'CUSTOM')]
    #[CustomIdGenerator(class: 'Ramsey\Uuid\Doctrine\UuidGenerator')]
    protected string $id;

    #[Column(type: 'string')]
    protected string $name;

    #[OneToMany(targetEntity: 'Workspace', mappedBy: 'tenant')]
    private Collection $workspaces;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->workspaces = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    public function toJson() {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}
