<?php

namespace App\Domain\Mensaje\Repository;

use App\Factory\QueryFactory;

final class MensajeFinderRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function findMensaje($nro_pag,$where,$cant_registros,$taskId): array
    {
        //Paginador
        $limit = $cant_registros;
        $offset = ($nro_pag - 1) * $limit;
        $query = $this->queryFactory->newSelect('mensajes');
        //Fin Paginador
        
        $query->select(
            [
                'mensajes.id',
                'mensajes.note',
                'mensajes.id_usuario',
                'usuarios.name',
                'mensajes.id_solicitud',
                'solicitudes.titulo',
                'mensajes.created',
                'mensajes.updated'
            ]
        )
        ->leftjoin(['usuarios'=>'usuarios'], 'usuarios.id = mensajes.id_usuario')
        ->leftjoin(['solicitudes'=>'solicitudes'], 'solicitudes.id = mensajes.id_solicitud');

        $query->where(['mensajes.id_solicitud' => $taskId]);    

        //Paginador
        
        $query->offset([$offset]);
        $query->limit([$limit]);
        //Fin paginador


        return $query->execute()->fetchAll('assoc') ?: [];
    }
}
