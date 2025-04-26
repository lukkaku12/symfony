<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function listUsers(): array 
    {
        return $this->em->getRepository(User::class)->findAll();
    }

    public function createUser(string $name, string $lastname): User
    {
        $user = new User();
        $user->setNames($name);
        $user->setLastnames($lastname);

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    public function getUser(int $id): ?User
    {
        return $this->em->getRepository(User::class)->find($id);
    }

    public function updateUser(int $id, string $name, string $lastname): ?User
    {
        $user = $this->em->getRepository(User::class)->find($id);
        if (!$user) {
            return null;
        }

        $user->setNames($name);
        $user->setLastnames($lastname);

        $this->em->flush();
        return $user;
    }

    public function deleteUser(int $id): bool
    {
        $user = $this->em->getRepository(User::class)->find($id);
        if (!$user) {
            return false;
        }

        $this->em->remove($user);
        $this->em->flush();
        return true;
    }
}