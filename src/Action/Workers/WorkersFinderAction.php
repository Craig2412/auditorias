<?php

namespace App\Action\Workers;

use App\Domain\Workers\Data\WorkersFinderResult;
use App\Domain\Workers\Service\WorkersFinder;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class WorkersFinderAction
{
    private WorkersFinder $workersFinder;

    private JsonRenderer $renderer;

    public function __construct(WorkersFinder $workersFinder, JsonRenderer $jsonRenderer)
    {
        $this->workersFinder = $workersFinder;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Optional: Pass parameters from the request to the service method
        // ...

        $workers = $this->workersFinder->findWorkers();

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($workers));
    }

    public function transform(WorkersFinderResult $result): array
    {
        $workers = [];

        foreach ($result->workers as $workers) {
            $worker[] = [
                'id' => $workers->id,
                'charge' => $workers->charge,
                'name' => $workers->name,
                'surname' => $workers->surname,
                'status' => $workers->status,
                'deparment' => $workers->deparment,
                'created' => $workers->created,
                'updated' => $workers->updated
            ];
        }

        return [
            'workers' => $worker,
        ];
    }
}
