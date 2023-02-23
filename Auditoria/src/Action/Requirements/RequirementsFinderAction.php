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

        foreach ($result->requirements as $requirement) {
            $requirements[] = [
                'id' => $requirement->id,
                'format_appointment' => $requirement->format_appointment,
                'name' => $requirement->name,//worker
                'surname' => $requirement->surname,//worker
                'status' => $requirement->status,
                'created' => $requirement->created,
                'updated' => $requirement->updated
            ];
        }

        return [
            'requirements' => $requirements,
        ];
    }
}
