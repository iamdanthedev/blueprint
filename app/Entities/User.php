<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use Illuminate\Contracts\Auth\Authenticatable;
use Ramsey\Uuid\Doctrine\UuidGenerator;

#[ORM\Entity]
#[ORM\Table(name: 'bpl_user')]
class User implements Authenticatable
{
    public static function create(string $name, string $email, string $rememberToken): User {
        $user = new User();

        $user->name = $name;
        $user->email = $email;
        $user->rememberToken = $rememberToken;

        return $user;
    }

    #[ORM\Id]
    #[ORM\GeneratedValue('CUSTOM')]
    #[ORM\Column(type: 'uuid')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    protected string $id;

    #[ORM\Column(type: 'string')]
    protected string $name;

    #[ORM\Column(type: 'string')]
    protected string $email;

    #[ORM\Column(type: 'string', nullable: true)]
    protected string $password;

    #[ORM\Column(type: 'string')]
    protected string $rememberToken;

    #[ORM\Column(type: 'integer', nullable: false)]
    protected int $githubId;

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->rememberToken;
    }

    public function setRememberToken($value)
    {
        $this->rememberToken = $value;
    }

    public function getRememberTokenName()
    {
        return 'rememberToken';
    }

    public function getGithubId(): int
    {
        return $this->githubId;
    }

    public function setGithubId(int $githubId): void
    {
        $this->githubId = $githubId;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
