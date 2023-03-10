<?php

namespace App\Action\Companies;

use App\Domain\Companies\Data\CompaniesReaderResult;
use App\Domain\Companies\Service\CompaniesReader;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CompaniesReaderAction
{
    private CompaniesReader $companiesReader;

    private JsonRenderer $renderer;

    public function __construct(CompaniesReader $companiesReader, JsonRenderer $jsonRenderer)
    {
        $this->companiesReader = $companiesReader;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Fetch parameters from the request
        $companiesId = (int)$args['id_company'];

        // Invoke the domain and get the result
        $companies = $this->companiesReader->getCompanies($companiesId);

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($companies));
    }

    private function transform(CompaniesReaderResult $companies): array
    {
        return [
            'id' => $companies->id,
            'name' => $companies->name,
            'rif' => $companies->rif,
            'signature' => $companies->signature            
        ];
    }
}
