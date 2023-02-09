<?php

namespace App\Action\Category;

use App\Domain\Category\Data\CategoryReaderResult;
use App\Domain\Category\Service\CategoryReader;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CategorysReaderAction
{
    private CategoryReader $categoryReader;

    private JsonRenderer $renderer;

    public function __construct(CategoryReader $categoryReader, JsonRenderer $jsonRenderer)
    {
        $this->categoryReader = $categoryReader;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Fetch parameters from the request
        $categoryId = (int)$args['category_id'];

        // Invoke the domain and get the result
        $category = $this->categoryReader->getCategory($categoryId);

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($category));
    }

    private function transform(CategoryReaderResult $category): array
    {
        return [
            'id' => $category->id,
            'category' => $category->number,
            'id_condicion' => $category->id_condicion,
            'id_departamento' => $category->id_departamento,
            'created' => $category->created,
            'updated' => $category->updated
        ];
    }
}
