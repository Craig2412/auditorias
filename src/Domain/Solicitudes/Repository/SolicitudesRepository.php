<?php

namespace App\Domain\Solicitudes\Repository;

use App\Factory\QueryFactory;
use DomainException;

final class SolicitudesRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->fecha = date("Y-m-d H:i:s" , time() - 18000); // Aca esta la fecha del dia (UNIX) menos 5  horas por el uso horario de venezuela
        $this->queryFactory = $queryFactory;
    }

    public function insertSolicitudes(array $solicitudes): int
    {
        $id = (int)$this->queryFactory->newInsert('solicitudes', $this->toRow($solicitudes))
            ->execute()
            ->lastInsertId();
            return $id;
    }

    public function getSolicitudesById(int $solicitudesId): array
    {
        $query = $this->queryFactory->newSelect('solicitudes');
        $query->select(
            [
                'solicitudes.id',
                'solicitudes.num_solicitud',
                'solicitudes.num_registro',
                'solicitudes.descripcion',
                'solicitudes.respuesta',
                'solicitudes.id_categoria',
                'categorias.categoria',
                'solicitudes.id_condicion',
                'solicitudes.id_requerimiento',
                'solicitudes.id_estado',
                'estados.estado',
                'solicitudes.created',
                'solicitudes.updated'
            ]
        )   
            ->leftjoin(['categorias'=>'categorias'], 'categorias.id = solicitudes.id_categoria')
            ->leftjoin(['estados'=>'estados'], 'estados.id = solicitudes.id_estado');

        $query->where(['solicitudes.id_condicion' => 1,'id_requerimiento' => $solicitudesId]);

        $row = $query->execute()->fetchAll('assoc');
        if (!$row) {
            throw new DomainException(sprintf('Solicitudes not found: %s', $solicitudesId));
        }
        return $row;
    }

    public function updateSolicitudes(int $solicitudesId, array $solicitudes): array
    {
        $row = $this->toRowUpdate($solicitudes);

        $this->queryFactory->newUpdate('solicitudes', $row)
            ->where(['id' => $solicitudesId])
            ->execute();
        
        return $row;
    }

    public function existsSolicitudesId(int $solicitudesId): bool
    {
        $query = $this->queryFactory->newSelect('solicitudes');
        $query->select('id')->where(['id' => $solicitudesId]);

        return (bool)$query->execute()->fetch('assoc');
    }

    public function deleteSolicitudesById(int $solicitudesId): void
    {
        $this->queryFactory->newDelete('solicitudes')
            ->where(['id' => $solicitudesId])
            ->execute();
    }

    private function toRow(array $solicitudes): array
    {
        return [
            'num_solicitud' => $solicitudes['num_solicitud'],
            'num_registro' => $solicitudes['num_registro'],
            'descripcion' => $solicitudes['descripcion'],
            'respuesta' => null,
            'id_categoria' => $solicitudes['id_categoria'],
            'id_requerimiento' => $solicitudes['id_requerimiento'],
            'id_condicion' =>1,
            'id_estado' => 6,
            'created' => $this->fecha,
            'updated' => null
        ];
    }
    private function toRowUpdate(array $solicitudes): array
    {
        return [
            'descripcion' => $solicitudes['descripcion'],
            'respuesta' => $solicitudes['respuesta'],
            'id_condicion' =>$solicitudes['id_condicion'],
            'id_estado' => $solicitudes['id_estado'],
            'updated' => $this->fecha
        ];
    }
}


