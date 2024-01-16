<?php

namespace App\Domain\Requerimientos\Repository;

use App\Factory\QueryFactory;

final class RequerimientosbyEstadosFinderRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function findRequerimientosbyEstados(): array
    {
        
        $query = $this->queryFactory->newSelect('requerimientos');
        $query->select([
            'total' => $query->func()->count('*'),
            'estados.estado'
        ])
        ->leftJoin('estados', 'estados.id = requerimientos.id_estado')
        ->group('requerimientos.id_estado');

        $query->where(['requerimientos.id_condicion' => 1]);
        
        $array = [
            [
                'total' => 0,
                'estado' => 'PROCESADO'
            ],
            [
                'total' => 0,
                'estado' => 'ASIGNADO'
            ],
            [
                'total' => 0,
                'estado' => 'NUEVO'
            ]
        ];

        for ($i=0; $i < count($query->execute()->fetchAll('assoc')) ; $i++) { 
            switch ($query->execute()->fetchAll('assoc')[$i]['estado']) {
                case 'NUEVO':
                    $array[2]['total'] = $query->execute()->fetchAll('assoc')[$i]['total'];
                    break;
                
                case 'ASIGNADO':
                    $array[1]['total'] = $query->execute()->fetchAll('assoc')[$i]['total'];
                    break;
                
                case 'PROCESADO':
                    $array[0]['total'] = $query->execute()->fetchAll('assoc')[$i]['total'];
                    break;
                
            }
        }

        return $array ?: [];
    }
}
