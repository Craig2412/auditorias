<?php

namespace App\Action\Charges;

use App\Domain\Charges\Data\ChargesReaderResult;
use App\Domain\Charges\Service\ChargesReader;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ChargesReaderAction
{
    private ChargesReader $chargesReader;

    private JsonRenderer $renderer;

    public function __construct(ChargesReader $chargesReader, JsonRenderer $jsonRenderer)
    {
        $this->chargesReader = $chargesReader;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Fetch parameters from the request
        $chargesId = (int)$args['id_charge'];

        // Invoke the domain and get the result
        $charges = $this->chargesReader->getCharges($chargesId);

        // Transform result and render to json
        //var_dump($this->transform($charges));
        return $this->renderer->json($response, $this->transform($charges));
    }

    private function transform(ChargesReaderResult $charges): array
    {
        return [
            'id' => $charges->id,
            'charge' => $charges->charge
        ];
    }
}
