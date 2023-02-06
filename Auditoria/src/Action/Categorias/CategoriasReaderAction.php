<?php

namespace App\Action\Categorias;

use App\Domain\Categorias\Data\CategoriasReaderResult;
use App\Domain\Categorias\Service\CategoriasReader;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CategoriasReaderAction
{
    private CategoriasReader $categoriasReader;

    private JsonRenderer $renderer;

    public function __construct(CategoriasReader $categoriasReader, JsonRenderer $jsonRenderer)
    {
        $this->categoriasReader = $categoriasReader;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Fetch parameters from the request
        $categoriasId = (int)$args['categorias_id'];

        // Invoke the domain and get the result
        $categorias = $this->categoriasReader->getCategorias($categoriasId);

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($categorias));
    }

    private function transform(CategoriasReaderResult $categorias): array
    {
        return [
                'id' => $categorias->id,
                'categoria' => $categorias->categoria,
                'id_condicion' => $categorias->id_condicion,
                'id_departamento' => $categorias->id_departamento
        ];
    }
}
