<?php

namespace App\Domain\Cita\Repository;

use App\Factory\QueryFactory;


final class CitabyMonthFinderRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function findCitabyMonth(int $year): array
    {
        
        $query = $this->queryFactory->newSelect('citas');
        $query->select([
            'MONTH(citas.fecha_cita) AS month',
            'COUNT(citas.id) AS total'
        ])
        ->where(['YEAR(citas.fecha_cita)' => $year])
        ->group(['month']);

        $results = $query->execute()->fetchAll('assoc');
        
        $months = range(1, 12); // Genera un array con los números de mes del 1 al 12
        
        $formattedResults = [];
        
        foreach ($months as $month) {
            $formattedResults[] = [
                'month' => $month,
                'total' => 0
            ];
        }
        
        foreach ($results as $result) {
            $formattedResults[$result['month'] - 1] = $result;
        }
        
        //var_dump($formattedResults);
        
        return $formattedResults;
    }
}
