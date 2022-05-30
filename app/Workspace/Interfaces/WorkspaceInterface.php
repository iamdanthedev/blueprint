<?php

namespace App\Workspace\Interfaces;

interface WorkspaceInterface
{
    public function getTenantId(): string;
    public function getWorkspaceId(): string;
    public function getProjectAccessor(): ProjectAccessorInterface;
}
