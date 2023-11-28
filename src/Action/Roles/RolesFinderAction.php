<?php

namespace App\Action\Roles;

use App\Domain\Roles\Data\RolesFinderResult;
use App\Domain\Roles\Service\RolesFinder;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class RolesFinderAction
{
    private RolesFinder $rolesFinder;

    private JsonRenderer $renderer;

    public function __construct(RolesFinder $rolesFinder, JsonRenderer $jsonRenderer)
    {
        $this->rolesFinder = $rolesFinder;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Optional: Pass parameters from the request to the service method
        // ...

        $roless = $this->rolesFinder->findRoless();

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($roless));
    }

    public function transform(RolesFinderResult $result): array
    {
        $roless = [];
        
        foreach ($result->roless as $roles) {
            $roless[] = [
                'id' => $roles->id,
                'rol' => $roles->rol
            ];
        }

        return [
            'roless' => $roless,
        ];
    }
}
