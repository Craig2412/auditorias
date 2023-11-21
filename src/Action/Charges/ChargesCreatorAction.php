<?php

namespace App\Action\Charges;

use App\Domain\Charges\Service\ChargesCreator;
use App\Renderer\JsonRenderer;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ChargesCreatorAction
{
    private JsonRenderer $renderer;

    private ChargesCreator $chargesCreator;

    public function __construct(ChargesCreator $chargesCreator, JsonRenderer $renderer)
    {
        $this->chargesCreator = $chargesCreator;
        $this->renderer = $renderer;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Extract the form data from the request body
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $chargesId = $this->chargesCreator->createCharges($data);

        // Build the HTTP response
        return $this->renderer
            ->json($response, ['id_charge' => $chargesId])
            ->withStatus(StatusCodeInterface::STATUS_CREATED);
    }
}
