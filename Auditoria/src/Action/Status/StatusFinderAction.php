<?php

namespace App\Action\Status;

use App\Domain\Status\Data\StatusFinderResult;
use App\Domain\Status\Service\StatusFinder;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class StatusFinderAction
{
    private StatusFinder $statusFinder;

    private JsonRenderer $renderer;

    public function __construct(StatusFinder $statusFinder, JsonRenderer $jsonRenderer)
    {
        $this->statusFinder = $statusFinder;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        // Optional: Pass parameters from the request to the service method
        // ...
        $tipo_status = (string)$args['tipo_status'];


        $status = $this->statusFinder->findStatus(strtoupper($tipo_status));

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($status));
    }

    public function transform(StatusFinderResult $result): array
    {
        $statuss = [];

        foreach ($result->status as $state) {
            $status[] = [
                'id' => $state->id,
                'status' => $state->status,
                'status_number' => $state->status_number,
                'grouping' => $state->grouping,
                'condition' => $state->condition,
                'updated' => $state->updated,
                'created' => $state->created
            ];
        }

        return [
            'status' => $status,
        ];
    }
}
