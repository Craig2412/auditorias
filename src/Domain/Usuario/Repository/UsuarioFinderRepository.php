<?php

namespace App\Domain\Usuario\Repository;

use App\Factory\QueryFactory;

final class UsuarioFinderRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function findUsuario($nro_pag,$where,$cant_registros): array
    {
        //Paginador
        $limit = $cant_registros;
        $offset = ($nro_pag - 1) * $limit;
        $query = $this->queryFactory->newSelect('usuarios');
        //Fin Paginador
        
        $query->select(
            [
                'usuarios.id',
                'usuarios.nombre',
                'usuarios.apellido',
                'usuarios.correo',
                'usuarios.identificacion',
                'usuarios.clave',
                'usuarios.telefono',
                'usuarios.id_rol',
                'roles.rol',
                'usuarios.created',
                'usuarios.updated'
            ]
        )
        ->leftjoin(['roles'=>'roles'], 'roles.id = usuarios.id_rol');

        if (!empty($where)) {
            $query->where(['usuarios.id_condicion' => 1,$where]);  
        }    else {
            $query->where(['usuarios.id_condicion' => 1]);
        }

        //Paginador
        
        $query->offset([$offset]);
        $query->limit([$limit]);
        //Fin paginador


        return $query->execute()->fetchAll('assoc') ?: [];
    }
}
