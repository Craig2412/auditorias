<?php

namespace App\Action\Categorias;

use App\Domain\Categorias\Data\CategoriasFinderResult;
use App\Domain\Categorias\Service\CategoriasFinder;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CategoriasFinderAction
{
    private CategoriasFinder $CategoriasFinder;

    private JsonRenderer $renderer;

    public function __construct(CategoriasFinder $CategoriasFinder, JsonRenderer $jsonRenderer)
    {
        $this->categoriasFinder = $CategoriasFinder;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
       
        $categorias = $this->categoriasFinder->findcategorias();

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($categorias));
    }

    public function transform(CategoriasFinderResult $result): array
    {
        $categorias = [];

        foreach ($result->categorias as $categorias) {
            $categoria[] = [
                'id' => $categorias->id,
                'categoria' => $categorias->categoria,
                'id_condicion' => $categorias->id_condicion,
                'id_departamento' => $categorias->id_departamento
            ]; 
        }

        return [
            'categorias' => $categoria,
        ];
    }
}
