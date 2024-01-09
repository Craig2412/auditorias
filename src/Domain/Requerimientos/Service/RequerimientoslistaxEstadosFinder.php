<?php

namespace App\Domain\Requerimientos\Service;

use App\Domain\Requerimientos\Data\RequerimientoslistaxEstadosFinderItem;
use App\Domain\Requerimientos\Data\RequerimientoslistaxEstadosFinderResult;
use App\Domain\Requerimientos\Repository\RequerimientoslistaxEstadosFinderRepository;

final class RequerimientoslistaxEstadosFinder
{
    private RequerimientoslistaxEstadosFinderRepository $repository;

    public function __construct(RequerimientoslistaxEstadosFinderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findRequerimientoslistaxEstados(): RequerimientoslistaxEstadosFinderResult
    {
        // Input validation
        $requerimientoslistaxEstados = $this->repository->findRequerimientoslistaxEstados();

        return $this->createResult($requerimientoslistaxEstados);
    }

    private function createResult(array $requerimientoslistaxEstadosRows): RequerimientoslistaxEstadosFinderResult
    {
        $result = new RequerimientoslistaxEstadosFinderResult();
        
        foreach ($requerimientoslistaxEstadosRows as $requerimientoslistaxEstadosRow) {
            $requerimientoslistaxEstados = new RequerimientoslistaxEstadosFinderItem();
           
            $requerimientoslistaxEstados->estado = $requerimientoslistaxEstadosRow['estado'];
            $requerimientoslistaxEstados->total = $requerimientoslistaxEstadosRow['total'];

            $result->requerimientoslistaxEstados[] = $requerimientoslistaxEstados;
        }
        
        return $result;
    }
}
