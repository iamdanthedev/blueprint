<?php

namespace App\Http\Controllers;

use App\Entities\Tenant;
use App\Entities\Workspace;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\Request;

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

        $this->em->persist($tenant);
        $this->em->persist($workspace);
        $this->em->flush();
    }
}
