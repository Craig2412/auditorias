<?php

namespace App\Domain\Requerimientos\Repository;

use App\Factory\QueryFactory;

final class RequerimientosFinderRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function findRequerimientos($nro_pag,$where,$cant_registros): array
    {
        //Paginador
        $limit = $cant_registros;
        $offset = ($nro_pag - 1) * $limit;
        $query = $this->queryFactory->newSelect('requerimientos');
        //Fin Paginador
        
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
                'trabajador.nombre as trabajador',
                'usuarios.apellido',
                'usuarios.identificacion',
                'requerimientos.id_trabajador',                
                'estados.estado',
                'requerimientos.created',
                'requerimientos.updated'
            ]
        )

        ->leftjoin(['formato_citas'=>'formato_citas'], 'formato_citas.id = requerimientos.id_formato_cita')
        ->leftjoin(['trabajador'=>'usuarios'], 'trabajador.id = requerimientos.id_trabajador')
        ->leftjoin(['usuarios'=>'usuarios'], 'usuarios.id = requerimientos.id_usuario')
        ->leftjoin(['paises'=>'paises'], 'paises.id = requerimientos.id_pais')
        ->leftjoin(['estados_paises'=>'estados_paises'], 'estados_paises.id = requerimientos.id_estado_pais')
        ->leftjoin(['estados'=>'estados'], 'estados.id = requerimientos.id_estado');

        //Paginador
        if (!empty($where)) {
            $query->where(['requerimientos.id_condicion' => 1,$where]);  
        }    else {
            $query->where(['requerimientos.id_condicion' => 1]);
        }     
        $query->offset([$offset]);
        $query->limit([$limit]);
        //Fin paginador

        return $query->execute()->fetchAll('assoc') ?: [];
    }
}
