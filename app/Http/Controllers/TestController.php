<?php

namespace App\Http\Controllers;

use App\Entities\Project;
use App\Entities\Tenant;
use App\Entities\Workspace;
use App\Workspace\ProjectAccessor;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Facades\Response;

class TestController extends Controller
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function index()
    {
        $tenant = new Tenant('test1');
        $workspace = new Workspace($tenant, 'test2');
        $project = new Project($workspace, 'tst', 'Test project');

        $this->em->persist($tenant);
        $this->em->persist($workspace);
        $this->em->persist($project);

        $this->em->flush();

        $projectAccessor = new ProjectAccessor($tenant->getId(), $workspace->getId(), $project->getId());
        $projectAccessor->init();

        $result = [
            'tenant' => $tenant,
            'workspace' => $workspace,
            'project' => $project,
            'branch' => $projectAccessor->getCurrentBranchName()
        ];

        return Response::json($result);
    }
}
