<?php

namespace App\Action\Categories;

use App\Domain\Categories\Data\CategoriesFinderResult;
use App\Domain\Categories\Service\CategoriesFinder;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CategoriesFinderAction
{
    private CategoriesFinder $CategoriesFinder;

    private JsonRenderer $renderer;

    public function __construct(CategoriesFinder $CategoriesFinder, JsonRenderer $jsonRenderer)
    {
        $this->categoriesFinder = $CategoriesFinder;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Optional: Pass parameters from the request to the service method
        // ...

        $categories = $this->categoriesFinder->findcategories();

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($categories));
    }

    public function transform(CategoriesFinderResult $result): array
    {
        $categories = [];

        foreach ($result->categories as $categories) {
            $category[] = [
                'id' => $categories->id,
                'category' => $categories->category,
                'condition' => $categories->condition,
                'deparment' => $categories->deparment
            ]; 
        }

        return [
            'categories' => $category,
        ];
    }
}
