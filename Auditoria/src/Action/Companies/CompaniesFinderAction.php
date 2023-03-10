<?php

namespace App\Action\Companies;

use App\Domain\Companies\Data\CompaniesFinderResult;
use App\Domain\Companies\Service\CompaniesFinder;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CompaniesFinderAction
{
    private CompaniesFinder $companyFinder;

    private JsonRenderer $renderer;

    public function __construct(CompaniesFinder $companyFinder, JsonRenderer $jsonRenderer)
    {
        $this->companyFinder = $companyFinder;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Optional: Pass parameters from the request to the service method
        // ...

        $companies = $this->companyFinder->findCompanies();

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($companies));
    }

    public function transform(CompaniesFinderResult $result): array
    {
        $companies = [];

        foreach ($result->companies as $company) {
            $companies[] = [
                'id' => $company->id,
                'name' => $company->name,
                'rif' => $company->rif,
                'signature' => $company->signature
            ];
        }
        return [
            'companies' => $companies,
        ];
    }
}
