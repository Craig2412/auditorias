<?php

namespace App\Domain\Requerimientos\Service;

use App\Domain\Requerimientos\Data\RequerimientosbyEstadosFinderItem;
use App\Domain\Requerimientos\Data\RequerimientosbyEstadosFinderResult;
use App\Domain\Requerimientos\Repository\RequerimientosbyEstadosFinderRepository;

final class RequerimientosbyEstadosFinder
{
    private RequerimientosbyEstadosFinderRepository $repository;

    public function __construct(RequerimientosbyEstadosFinderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findRequerimientosbyEstados(): RequerimientosbyEstadosFinderResult
    {
        // Input validation
        $requerimientosbyEstados = $this->repository->findRequerimientosbyEstados();

        return $this->createResult($requerimientosbyEstados);
    }

    private function createResult(array $requerimientosbyEstadosRows): RequerimientosbyEstadosFinderResult
    {
        $result = new RequerimientosbyEstadosFinderResult();
        
        foreach ($requerimientosbyEstadosRows as $requerimientosbyEstadosRow) {
            $requerimientosbyEstados = new RequerimientosbyEstadosFinderItem();
           
            $requerimientosbyEstados->estado = $requerimientosbyEstadosRow['estado'];
            $requerimientosbyEstados->total = $requerimientosbyEstadosRow['total'];

            $result->requerimientosbyEstados[] = $requerimientosbyEstados;
        }
        
        return $result;
    }
}