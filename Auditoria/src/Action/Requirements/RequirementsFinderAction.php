<?php

namespace App\Action\Requirements;

use App\Domain\Requirements\Data\RequirementsFinderResult;
use App\Domain\Requirements\Service\RequirementsFinder;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class RequirementsFinderAction
{
    private RequirementsFinder $requirementsFinder;

    private JsonRenderer $renderer;

    public function __construct(RequirementsFinder $requirementsFinder, JsonRenderer $jsonRenderer)
    {
        $this->requirementsFinder = $requirementsFinder;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Optional: Pass parameters from the request to the service method
        // ...

        $requirements = $this->requirementsFinder->findRequirements();

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($requirements));
    }

    public function transform(RequirementsFinderResult $result): array
    {
        $requirements = [];

        foreach ($result->requirements as $requirements) {
            $requirement[] = [
                'id' => $requirements->id,
                'format_appointment' => $requirements->format_appoinment,
                'name' => $requirements->name,//user
                'surname' => $requirements->surname,//user
                'worker' => $requirements->worker,
                'status' => $requirements->status,
                'created' => $requirements->created,
                'updated' => $requirements->updated
            ];
        }

        return [
            'requirements' => $requirements,
        ];
    }
}
