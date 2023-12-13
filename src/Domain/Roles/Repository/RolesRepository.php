<?php

namespace App\Domain\Roles\Repository;

use App\Factory\QueryFactory;
use DomainException;

final class RolesRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->fecha = date("Y-m-d H:i:s" , time() - 18000); // Aca esta la fecha del dia (UNIX) menos 5  horas por el uso horario de venezuela
        $this->queryFactory = $queryFactory;
    }
    
    public function insertRoles(array $roles): int
    {
        return (int)$this->queryFactory->newInsert('roles', $this->toRow($roles))
        ->execute()
        ->lastInsertId();
    }
    
    public function getRolesById(int $rolesId): array
    {
        $query = $this->queryFactory->newSelect('roles');
        $query->select(
            [
                'roles.id',
                'roles.rol'
            ]

        );

        $query->where(['roles.id'=> $rolesId]);
            
            $row = $query->execute()->fetch('assoc');
            
            if (!$row) {
                throw new DomainException(sprintf('Roles no encontrados: %s', $rolesId));
        }
        
        return $row;
    }
    
    public function updateRoles(int $rolesId, array $roles): array
    {
        $row = $this->toRow($roles);
        
        $this->queryFactory->newUpdate('roles', $row)
        ->where(['id' => $rolesId])
        ->execute();

        return $row;

    }

    public function existsRolesId(int $rolesId): bool
    {
        $query = $this->queryFactory->newSelect('roles');
        $query->select('id')->where(['id' => $rolesId]);
        
        return (bool)$query->execute()->fetch('assoc');
    }
    
    public function deleteRolesById(int $rolesId): void
    {
        $this->queryFactory->newDelete('roles')
        ->where(['id' => $rolesId])
        ->execute();
    }

    private function toRow(array $roles): array
    {        
        return [
            'rol' => strtoupper($roles['rol'])
        ];
    }


    
}
