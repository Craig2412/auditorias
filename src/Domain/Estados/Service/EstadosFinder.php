<?php

namespace App\Domain\Estados\Service;

use App\Domain\Estados\Data\EstadosFinderItem;
use App\Domain\Estados\Data\EstadosFinderResult;
use App\Domain\Estados\Repository\EstadosFinderRepository;

final class EstadosFinder
{
    private EstadosFinderRepository $repository;

    public function __construct(EstadosFinderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findEstadoss(): EstadosFinderResult
    {
        // Input validation
        // ...

        $estadoss = $this->repository->findEstadoss();

        return $this->createResult($estadoss);
    }

    private function createResult(array $estadosRows): EstadosFinderResult
    {
        $result = new EstadosFinderResult();

        foreach ($estadosRows as $estadosRow) {
            $estados = new EstadosFinderItem();
            $estados->id = $estadosRow['id'];
            $estados->estados = $estadosRow['estado'];
            $estados->id_agrupacion = $estadosRow['id_agrupacion'];
            $estados->agrupacion = $estadosRow['agrupacion'];
            

            $result->estadoss[] = $estados;
        }
        //var_dump($result);

        return $result;
    }
}
