<?php

namespace App\Action\Categories;

use App\Domain\Categories\Service\CategoriesCreator;
use App\Renderer\JsonRenderer;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CategoriesCreatorAction
{
    private JsonRenderer $renderer;

    private CategoriesCreator $categoriesCreator;

    public function __construct(CategoriesCreator $categoriesCreator, JsonRenderer $renderer)
    {
        $this->categoriesCreator = $categoriesCreator;
        $this->renderer = $renderer;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Extract the form data from the request body
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $categoriesId = $this->categoriesCreator->createCategories($data);

        // Build the HTTP response
        return $this->renderer
            ->json($response, ['categories_id' => $categoriesId])
            ->withStatus(StatusCodeInterface::STATUS_CREATED);
    }
}
