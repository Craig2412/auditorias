<?php

namespace App\Action\Workers;

use App\Domain\Workers\Service\WorkersUpdater;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class WorkersUpdaterAction
{
    private WorkersUpdater $workersUpdater;

    private JsonRenderer $renderer;

    public function __construct(WorkersUpdater $workersUpdater, JsonRenderer $jsonRenderer)
    {
        $this->workersUpdater = $workersUpdater;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Extract the form data from the request body
        $workersId = (int)$args['id_worker'];
        $data = (array)$request->getParsedBody();
        var_dump($args);


        // Invoke the Domain with inputs and retain the result
        $this->workersUpdater->updateWorkers($workersId, $data);

        // Build the HTTP response
        return $this->renderer->json($response);
    }
}
