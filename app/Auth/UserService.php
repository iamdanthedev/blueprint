<?php

namespace App\Auth;

use App\Entities\User;
use Doctrine\ORM\EntityManagerInterface;
use Laravel\Socialite\Facades\Socialite;

class UserService
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function handleGithubUser(\Laravel\Socialite\Two\User $socialiteUser): User {
        $userRepo = $this->em->getRepository(User::class);

        $user = $userRepo->findOneBy(['email' => $socialiteUser->getEmail()]);

        if (is_null($user)) {
            $user = User::create(
                name: $socialiteUser->getName(),
                email: $socialiteUser->getEmail(),
                rememberToken: $socialiteUser->token
            );
            $user->setGithubId($socialiteUser->getId());

            $this->em->persist($user);
        }

        $this->em->flush();

        return $user;
    }

}
