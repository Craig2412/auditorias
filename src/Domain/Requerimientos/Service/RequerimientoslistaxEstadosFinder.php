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

    public function findRequerimientoslistaxEstados(array $array): RequerimientoslistaxEstadosFinderResult
    {
        // Input validation
        $requerimientoslistaxEstados = $this->repository->findRequerimientoslistaxEstados($array);

        return $this->createResult($requerimientoslistaxEstados);
    }

    private function createResult(array $requerimientoslistaxEstadosRows): RequerimientoslistaxEstadosFinderResult
    {
        $result = new RequerimientoslistaxEstadosFinderResult();
        
        foreach ($requerimientoslistaxEstadosRows as $requerimientoslistaxEstadosRow) {
            $requerimientoslistaxEstados = new RequerimientoslistaxEstadosFinderItem();
           
            $requerimientoslistaxEstados->id = $requerimientoslistaxEstadosRow['id'];
            $requerimientoslistaxEstados->id_formato_cita = $requerimientoslistaxEstadosRow['id_formato_cita'];
            $requerimientoslistaxEstados->formato_cita = $requerimientoslistaxEstadosRow['formato_cita'];
            $requerimientoslistaxEstados->id_estado = $requerimientoslistaxEstadosRow['id_estado'];
            $requerimientoslistaxEstados->id_condicion = $requerimientoslistaxEstadosRow['id_condicion'];
            $requerimientoslistaxEstados->id_usuario = $requerimientoslistaxEstadosRow['id_usuario'];
            $requerimientoslistaxEstados->nombre = $requerimientoslistaxEstadosRow['nombre'];
            $requerimientoslistaxEstados->apellido = $requerimientoslistaxEstadosRow['apellido'];
            $requerimientoslistaxEstados->identificacion = $requerimientoslistaxEstadosRow['identificacion'];
            $requerimientoslistaxEstados->id_pais = $requerimientoslistaxEstadosRow['id_pais'];
            $requerimientoslistaxEstados->pais = $requerimientoslistaxEstadosRow['pais'];
            $requerimientoslistaxEstados->id_estado_pais = $requerimientoslistaxEstadosRow['id_estado_pais'];
            $requerimientoslistaxEstados->estado_pais = $requerimientoslistaxEstadosRow['estado_pais'];
            $requerimientoslistaxEstados->id_trabajador = $requerimientoslistaxEstadosRow['id_trabajador'];
            $requerimientoslistaxEstados->trabajador = $requerimientoslistaxEstadosRow['trabajador'];
            $requerimientoslistaxEstados->estado = $requerimientoslistaxEstadosRow['estado'];
            $requerimientoslistaxEstados->created = $requerimientoslistaxEstadosRow['created'];
            $requerimientoslistaxEstados->updated = $requerimientoslistaxEstadosRow['updated'];

            $result->requerimientoslistaxEstados[] = $requerimientoslistaxEstados;
        }
        
        return $result;
    }
}
