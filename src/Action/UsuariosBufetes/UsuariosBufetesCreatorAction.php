<?php

namespace App\Action\UsuariosBufetes;

use App\Domain\UsuariosBufetes\Service\UsuariosBufetesCreator;
use App\Renderer\JsonRenderer;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UsuariosBufetesCreatorAction
{
    private JsonRenderer $renderer;

    private UsuariosBufetesCreator $usuariosbufetesCreator;

    public function __construct(UsuariosBufetesCreator $usuariosbufetesCreator, JsonRenderer $renderer)
    {
        $this->usuariosbufetesCreator = $usuariosbufetesCreator;
        $this->renderer = $renderer;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Extract the form data from the request body
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $usuariosbufetesId = $this->usuariosbufetesCreator->createUsuariosBufetes($data);

        // Build the HTTP response
        return $this->renderer
            ->json($response, ['usuariosbufetes_id' => $usuariosbufetesId])
            ->withStatus(StatusCodeInterface::STATUS_CREATED);
    }
}
