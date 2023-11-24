<?php

namespace App\Domain\Requerimientos\Repository;

use App\Factory\QueryFactory;
use DomainException;

final class RequerimientosRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->fecha = date("Y-m-d H:i:s" , time() - 21600); // Aca esta la fecha del dia (UNIX) menos 5  horas por el uso horario de venezuela
        $this->queryFactory = $queryFactory;

    }

    public function insertRequerimientos(array $requerimientos): int
    {

        return (int)$this->queryFactory->newInsert('requerimientos', $this->toRow($requerimientos))
            ->execute()
            ->lastInsertId();
    }

    public function getRequerimientosById(int $requerimientosId): array
    {
        $query = $this->queryFactory->newSelect('requerimientos');
        $query->select(
            [
                'requerimientos.id',
                'requerimientos.id_formato_cita',
                'formato_citas.formato_cita',
                'requerimientos.id_estado',
                'requerimientos.id_condicion',
                'requerimientos.id_usuario',
                'requerimientos.id_pais',
                'requerimientos.id_estado_pais',
                'paises.pais',
                'estados_paises.estado_pais',
                'usuarios.nombre',
                'usuarios.apellido',
                'usuarios.identificacion',
                'requerimientos.id_trabajador',                
                'estados.estado',
                'requerimientos.created',
                'requerimientos.updated'
            ]
        )

        ->leftjoin(['formato_citas'=>'formato_citas'], 'formato_citas.id = requerimientos.id_formato_cita')
        ->leftjoin(['usuarios'=>'usuarios'], 'usuarios.id = requerimientos.id_usuario')
        ->leftjoin(['paises'=>'paises'], 'paises.id = requerimientos.id_pais')
        ->leftjoin(['estados_paises'=>'estados_paises'], 'estados_paises.id = requerimientos.id_estado_pais')
        ->leftjoin(['estados'=>'estados'], 'estados.id = requerimientos.id_estado');
        
        $query->where(['requerimientos.id_condicion' => 1,'requerimientos.id' => $requerimientosId]);


        $row = $query->execute()->fetch('assoc');
        //var_dump($row);

        if (!$row) {
            throw new DomainException(sprintf('Requerimientos not found: %s', $requerimientosId));
        }

        return $row;
    }

    public function updateRequerimientos(int $requerimientosId, array $requerimientos): array
    {
        $row = $this->toRowUpdate($requerimientos);

        $this->queryFactory->newUpdate('requerimientos', $row)
            ->where(['id' => $requerimientosId])
            ->execute();
        return $row;
    }

    public function existsRequerimientosId(int $requerimientosId): bool
    {
        $query = $this->queryFactory->newSelect('requerimientos');
        $query->select('id')->where(['id' => $requerimientosId]);

        return (bool)$query->execute()->fetch('assoc');
    }

    public function deleteRequerimientosById(int $requerimientosId): void
    {
        $this->queryFactory->newDelete('requerimientos')
            ->where(['id' => $requerimientosId])
            ->execute();
    }

    private function toRow(array $requerimientos): array
    {
        return [
            'id_formato_cita' => $requerimientos['id_formato_cita'],
            'id_usuario' => $requerimientos['id_usuario'],
            'id_condicion' => 1,
            'id_estado' => $requerimientos['id_estado'],
            'id_trabajador' => $requerimientos['id_trabajador'],
            'created' =>$this->fecha,
            'updated' => null
           
        ];
    }
    private function toRowUpdate(array $requerimientos): array
    {
        return [
            'id_formato_cita' => $requerimientos['id_formato_cita'],
            'id_condicion' => $requerimientos['id_condicion'],
            'id_estado' => $requerimientos['id_estado'],
            'id_trabajador' => $requerimientos['id_trabajador'],
            'updated' => $this->fecha
           
        ];
    }
}
