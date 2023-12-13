<?php

namespace App\Domain\Usuario\Service;

use App\Domain\Usuario\Repository\UsuarioRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

final class UsuarioUpdater
{
    private UsuarioRepository $repositoryUpdate;

    private UsuarioValidatorUpdate $usuarioValidatorUpdate;

    private LoggerInterface $logger;

    public function __construct(
        UsuarioRepository $repositoryUpdate,
        UsuarioValidatorUpdate $usuarioValidatorUpdate,
        LoggerFactory $loggerFactory
    ) {
        $this->repositoryUpdate = $repositoryUpdate;
        $this->usuarioValidatorUpdate = $usuarioValidatorUpdate;
        $this->logger = $loggerFactory
            ->addFileHandler('usuario_updater.log')
            ->createLogger();
    }

    public function updateUsuario(int $usuarioId, array $data): array
    {

        // Input validation
        $this->usuarioValidatorUpdate->validateUsuarioUpdate($usuarioId, $data);

        // Update the row
        $var = $this->repositoryUpdate->updateUsuario($usuarioId, $data);
        

        // Logging
        $this->logger->info(sprintf('Usuario updated successfully: %s', $usuarioId));

        return $var;
    }
}
