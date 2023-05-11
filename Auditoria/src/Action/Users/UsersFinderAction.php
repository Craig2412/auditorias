<?php

namespace App\Action\Users;

use App\Domain\Users\Data\UsersFinderResult;
use App\Domain\Users\Service\UsersFinder;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UsersFinderAction
{
    private UsersFinder $usersFinder;

    private JsonRenderer $renderer;

    public function __construct(UsersFinder $usersFinder, JsonRenderer $jsonRenderer)
    {
        $this->usersFinder = $usersFinder;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        // Optional: Pass parameters from the request to the service method

        $users = $this->usersFinder->findUsers();

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($users));
    }

    public function transform(UsersFinderResult $result): array
    {
        $userss = [];

        foreach ($result->users as $user) {
            $users[] = [
                'id' => $user->id,
                'name' => $user->name,
                'surname' => $user->surname,
                'email' => $user->email,
                'identification' => $user->identification,
                'pass' => $user->pass,
                'phone' => $user->phone,
                'role' => $user->role,
                'condition' => $user->condition,
                'updated' => $user->updated,
                'created' => $user->created
            ];
        }

        return [
            'users' => $users,
        ];
    }
}
