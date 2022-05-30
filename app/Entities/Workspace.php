<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'bpl_workspace')]
class Workspace
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'Ramsey\Uuid\Doctrine\UuidGenerator')]
    protected string $id;

    #[ORM\Column(type: 'string')]
    protected string $name;

    #[ORM\ManyToOne(targetEntity: 'Tenant', inversedBy: '')]
    private Tenant $tenant;

    #[ORM\OneToMany(targetEntity: 'Project', mappedBy: 'workspaces')]
    #[ORM\JoinColumn(name: 'tenant_id', referencedColumnName: 'id')]
    private Collection $projects;


    public function __construct(Tenant $tenant, string $name)
    {
        $this->tenant = $tenant;
        $this->name = $name;
        $this->projects = new ArrayCollection();
    }

    public function toJson() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'tenant' => $this->tenant->toJson()
        ];
    }

}
