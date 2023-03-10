<?php

namespace App\Action\Categories;

use App\Domain\Categories\Service\CategoriesUpdater;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CategoriesUpdaterAction
{
    private CategoriesUpdater $categoriesUpdater;

    private JsonRenderer $renderer;

    public function __construct(CategoriesUpdater $categoriesUpdater, JsonRenderer $jsonRenderer)
    {
        $this->categoriesUpdater = $categoriesUpdater;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Extract the form data from the request body
        $categoriesId = (int)$args['id_category'];
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $new_date = $this->categoriesUpdater->updateCategories($categoriesId, $data);

        // Build the HTTP response
        return $this->renderer->json($response,['datos nuevos' => $new_date]);
    }
}
