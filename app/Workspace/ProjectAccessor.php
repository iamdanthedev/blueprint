<?php

namespace App\Workspace;

use CzProject\GitPhp\Exception;
use CzProject\GitPhp\Git;
use CzProject\GitPhp\GitException;
use CzProject\GitPhp\Runners\CliRunner;

class ProjectAccessor implements Interfaces\ProjectAccessorInterface
{
    private string $repositoryPath;

    public function __construct(string $tenantId, string $workspaceId, string $projectId)
    {
        $this->repositoryPath = "/Users/danthedev/Desktop/blueprint/{$tenantId}/{$workspaceId}/{$projectId}";
    }

    public function init()
    {
        $git = $this->getGit();

        try {
            $repo = $git->open($this->repositoryPath);
        }
        catch (GitException $e) {
            if (str_contains($e->getMessage(), 'not found'))
            {
                $this->createRepository();
            }
            else
            {
                throw $e;
            }
        }
    }

    public function createRepository()
    {
        mkdir($this->repositoryPath, 0777, true);

        $git = $this->getGit();
        $repo = $git->init($this->repositoryPath);

        file_put_contents("{$this->repositoryPath}/blueprint.config.json", "{}");
        $repo->addAllChanges();
        $repo->commit('Add Blueprint configuration file');

        dd($repo->getCurrentBranchName());
    }


    public function getCurrentBranchName()
    {
        $git = $this->getGit();
        $repo = $git->open($this->repositoryPath);
        return $repo->getCurrentBranchName();
    }

    public function readBlueprintFolder(): string
    {
        // TODO: Implement readBlueprintFolder() method.
    }

    private function getGit(): Git
    {
        return new Git(new CliRunner('/opt/homebrew/bin/git'));
    }
}
