<?php

namespace App\Action\Companies;

use App\Domain\Companies\Service\CompaniesCreator;
use App\Renderer\JsonRenderer;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CompaniesCreatorAction
{
    private JsonRenderer $renderer;

    private CompaniesCreator $companiesCreator;

    public function __construct(CompaniesCreator $companiesCreator, JsonRenderer $renderer)
    {
        $this->companiesCreator = $companiesCreator;
        $this->renderer = $renderer;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Extract the form data from the request body
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $companiesId = $this->companiesCreator->createCompanies($data);

        // Build the HTTP response
        return $this->renderer
            ->json($response, ['id' => $companiesId])
            ->withStatus(StatusCodeInterface::STATUS_CREATED);
    }
}
