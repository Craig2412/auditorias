<?php

namespace App\Domain\Users\Service;

use App\Domain\Users\Data\UsersFinderItem;
use App\Domain\Users\Data\UsersFinderResult;
use App\Domain\Users\Repository\UsersFinderRepository;

final class UsersFinder
{
    private UsersFinderRepository $repository;

    public function __construct(UsersFinderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findUsers(): UsersFinderResult
    {
        // Input validation
        // ...

        $users = $this->repository->findUsers();

        return $this->createResult($users);
    }

    private function createResult(array $usersRows): UsersFinderResult
    {
        $result = new UsersFinderResult();

        foreach ($usersRows as $usersRow) {
            $users = new UsersFinderItem();
            $users->id = $usersRow['id'];
            $users->name = $usersRow['name'];
            $users->surname = $usersRow['surname'];
            $users->email = $usersRow['email'];
            $users->identification = $usersRow['identification'];
            $users->pass = $usersRow['pass'];
            $users->phone = $usersRow['phone'];
            $users->role = $usersRow['role'];
            $users->condition = $usersRow['condition'];
            $users->created = $usersRow['created'];
            $users->updated = $usersRow['updated'];

            $result->users[] = $users;
        }

        return $result;
    }
}