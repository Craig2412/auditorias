<?php

namespace App\Action\Workers;

use App\Domain\Workers\Data\WorkersReaderResult;
use App\Domain\Workers\Service\WorkersReader;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class WorkersReaderAction
{
    private WorkersReader $workerReader;

    private JsonRenderer $renderer;

    public function __construct(WorkersReader $workerReader, JsonRenderer $jsonRenderer)
    {
        $this->workerReader = $workerReader;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Fetch parameters from the request
        $workerId = (int)$args['id_worker'];

        // Invoke the domain and get the result
        $worker = $this->workerReader->getWorkers($workerId);

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($worker));
    }

    private function transform(WorkersReaderResult $worker): array
    {
        return [
            'id' => $worker->id,
            'charge' => $worker->charge,
            'name' => $worker->name,
            'surname' => $worker->surname,
            'status' => $worker->status,
            'deparment' => $worker->deparment,
            'created' => $worker->created,
            'updated' => $worker->updated
        ];
    }
}
