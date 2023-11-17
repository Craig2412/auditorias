<?php

namespace App\Action\Workers;

use App\Domain\Workers\Service\WorkersCreator;
use App\Renderer\JsonRenderer;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class WorkersCreatorAction
{
    private JsonRenderer $renderer;

    private WorkersCreator $workersCreator;

    public function __construct(WorkersCreator $workersCreator, JsonRenderer $renderer)
    {
        $this->workersCreator = $workersCreator;
        $this->renderer = $renderer;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Extract the form data from the request body
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $workersId = $this->workersCreator->createWorkers($data);

        // Build the HTTP response
        return $this->renderer
            ->json($response, ['id_worker' => $workersId])
            ->withStatus(StatusCodeInterface::STATUS_CREATED);
    }
}
