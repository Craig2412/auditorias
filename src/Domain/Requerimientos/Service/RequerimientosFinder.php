<?php

namespace App\Domain\Requerimientos\Service;

use App\Domain\Requerimientos\Data\RequerimientosFinderItem;
use App\Domain\Requerimientos\Data\RequerimientosFinderResult;
use App\Domain\Requerimientos\Repository\RequerimientosFinderRepository;

final class RequerimientosFinder
{
    private RequerimientosFinderRepository $repository;

    public function __construct(RequerimientosFinderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findRequerimientos($nro_pag,$where,$cant_registros): RequerimientosFinderResult
    {
        // Input validation
        $requerimientos = $this->repository->findRequerimientos($nro_pag,$where,$cant_registros);

        return $this->createResult($requerimientos);
    }

    private function createResult(array $requerimientosRows): RequerimientosFinderResult
    {
        $result = new RequerimientosFinderResult();

        foreach ($requerimientosRows as $requerimientosRow) {
            $requerimientos = new RequerimientosFinderItem();
            $requerimientos->id = $requerimientosRow['id'];
            $requerimientos->id_formato_cita = $requerimientosRow['id_formato_cita'];
            $requerimientos->formato_cita = $requerimientosRow['formato_cita'];
            $requerimientos->id_estado = $requerimientosRow['id_estado'];
            $requerimientos->id_condicion = $requerimientosRow['id_condicion'];
            $requerimientos->id_usuario = $requerimientosRow['id_usuario'];
            $requerimientos->nombre = $requerimientosRow['nombre'];
            $requerimientos->apellido = $requerimientosRow['apellido'];
            $requerimientos->name = $requerimientosRow['name'];
            $requerimientos->identificacion = $requerimientosRow['identificacion'];
            $requerimientos->id_pais = $requerimientosRow['id_pais'];
            $requerimientos->pais = $requerimientosRow['pais'];
            $requerimientos->id_estado_pais = $requerimientosRow['id_estado_pais'];
            $requerimientos->estado_pais = $requerimientosRow['estado_pais'];
            $requerimientos->id_trabajador = $requerimientosRow['id_trabajador'];
            $requerimientos->estado = $requerimientosRow['estado'];
            $requerimientos->created = $requerimientosRow['created'];
            $requerimientos->updated = $requerimientosRow['updated'];

            $result->requerimientos[] = $requerimientos;
        }
        return $result;
    }
}
