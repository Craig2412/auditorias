<?php

namespace App\Action\Charges;

use App\Domain\Charges\Data\ChargeFinderResult;
use App\Domain\Charges\Service\ChargeFinder;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ChargesFinderAction
{
    private ChargeFinder $customerFinder;

    private JsonRenderer $renderer;

    public function __construct(ChargeFinder $customerFinder, JsonRenderer $jsonRenderer)
    {
        $this->customerFinder = $customerFinder;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Optional: Pass parameters from the request to the service method
        // ...

        $charges = $this->customerFinder->findCustomers();

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($charges));
    }

    public function transform(ChargeFinderResult $result): array
    {
        $charges = [];

        foreach ($result->charges as $customer) {
            $charges[] = [
                'id' => $customer->id,
                'charge' => $customer->charge,
            ];
        }

        return [
            'charges' => $charges,
        ];
    }
}
