<?php

namespace App\Domain\Estados\Repository;

use App\Factory\QueryFactory;
use DomainException;

final class EstadosRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->fecha = date("Y-m-d H:i:s" , time() - 18000); // Aca esta la fecha del dia (UNIX) menos 5  horas por el uso horario de venezuela
        $this->queryFactory = $queryFactory;
    }
    
    public function insertEstados(array $estados): int
    {
        return (int)$this->queryFactory->newInsert('estados', $this->toRow($estados))
        ->execute()
        ->lastInsertId();
    }
    
    public function getEstadosById(int $estadosId): array
    {
        $query = $this->queryFactory->newSelect('estados');
        $query->select(
            [
                'estados.id',
                'estados.estado',
                'estados.id_agrupacion',
                'agrupaciones.agrupacion'
            ]

        )
        ->leftjoin(['agrupaciones'=>'agrupaciones'], 'agrupaciones.id = estados.id_agrupacion')
        ;

        $query->where(['estados.id_condicion' => 1,'estados.id'=> $estadosId]);
            
            $row = $query->execute()->fetch('assoc');
            
            if (!$row) {
                throw new DomainException(sprintf('Estados no encontrados: %s', $estadosId));
        }
        
        return $row;
    }
    
    public function updateEstados(int $estadosId, array $estados): array
    {
        $row = $this->toRowUpdate($estados);
        
        $this->queryFactory->newUpdate('estados', $row)
        ->where(['id' => $estadosId])
        ->execute();

        return $row;

    }

    public function existsEstadosId(int $estadosId): bool
    {
        $query = $this->queryFactory->newSelect('estados');
        $query->select('id')->where(['id' => $estadosId]);
        
        return (bool)$query->execute()->fetch('assoc');
    }
    
    public function deleteEstadosById(int $estadosId): void
    {
        $this->queryFactory->newDelete('estados')
        ->where(['id' => $estadosId])
        ->execute();
    }

    private function toRow(array $estados): array
    {        
        return [
            'estado' => strtoupper($estados['estado']),
            'id_agrupacion' => $estados['id_agrupacion'],
            'id_condicion' => 1,
            'created' => $this->fecha
        ];
    }

    private function toRowUpdate(array $estados): array
    {        
        return [
            'estado' => strtoupper($estados['estado']),
            'id_agrupacion' => $estados['id_agrupacion'],
            'updated' => $this->fecha
        ];
    }

    
}