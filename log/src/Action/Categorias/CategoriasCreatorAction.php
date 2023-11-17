<?php

namespace App\Action\Categorias;

use App\Domain\Categorias\Service\CategoriasCreator;
use App\Renderer\JsonRenderer;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CategoriasCreatorAction
{
    private JsonRenderer $renderer;

    private CategoriasCreator $categoriasCreator;

    public function __construct(CategoriasCreator $categoriasCreator, JsonRenderer $renderer)
    {
        $this->categoriasCreator = $categoriasCreator;
        $this->renderer = $renderer;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Extract the form data from the request body
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $categoriasId = $this->categoriasCreator->createCategorias($data);

        // Build the HTTP response
        return $this->renderer
            ->json($response, ['categorias_id' => $categoriasId])
            ->withStatus(StatusCodeInterface::STATUS_CREATED);
    }
}
