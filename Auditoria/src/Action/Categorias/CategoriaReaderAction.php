<?php

namespace App\Action\Category;

use App\Domain\Category\Data\CategoryReaderResult;
use App\Domain\Category\Service\CategoryReader;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CategorysReaderAction
{
    private CategoryReader $categoriaReader;

    private JsonRenderer $renderer;

    public function __construct(CategoryReader $categoriaReader, JsonRenderer $jsonRenderer)
    {
        $this->categoriaReader = $categoriaReader;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Fetch parameters from the request
        $categoriaId = (int)$args['categoria_id'];

        // Invoke the domain and get the result
        $categoria = $this->categoriaReader->getCategory($categoriaId);

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($categoria));
    }

    private function transform(CategoryReaderResult $categoria): array
    {
        return [
            'id' => $categoria->id,
            'categoria' => $categoria->number,
            'id_condicion' => $categoria->id_condicion,
            'id_departamento' => $categoria->id_departamento,
            'created' => $categoria->created,
            'updated' => $categoria->updated
        ];
    }
}
