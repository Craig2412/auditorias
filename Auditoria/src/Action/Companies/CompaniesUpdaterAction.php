<?php

namespace App\Action\Companies;

use App\Domain\Companies\Service\CompaniesUpdater;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CompaniesUpdaterAction
{
    private CompaniesUpdater $companiesUpdater;

    private JsonRenderer $renderer;

    public function __construct(CompaniesUpdater $companiesUpdater, JsonRenderer $jsonRenderer)
    {
        $this->companiesUpdater = $companiesUpdater;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Extract the form data from the request body
        $companiesId = (int)$args['id_company'];
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $new_date = $this->companiesUpdater->updateCompanies($companiesId, $data);

        // Build the HTTP response
        return $this->renderer->json($response,['datos nuevos' => $new_date]);
    }
}
