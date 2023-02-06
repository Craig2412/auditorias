<?php

namespace App\Action\Categorias;

use App\Domain\Categorias\Service\CategoriaCreatorgthy;
use App\Renderer\JsonRenderer;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CategoriaCreatorAction
{
    private JsonRenderer $renderer;

    private CategoriaCreatorgthy $categoriaCreator;

    public function __construct(CategoriaCreatorgthy $categoriaCreator, JsonRenderer $renderer)
    {
        $this->categoriaCreator = $categoriaCreator;
        $this->renderer = $renderer;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Extract the form data from the request body
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $categoriaId = $this->categoriaCreator->createCategoria($data);

        // Build the HTTP response
        return $this->renderer
            ->json($response, ['id_categoria' => $categoriaId])
            ->withStatus(StatusCodeInterface::STATUS_CREATED);
    }
}
