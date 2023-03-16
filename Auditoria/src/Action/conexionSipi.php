<?php
namespace App\Action;
use Cake\Database\Connection;

final class conexionSipi
{
    public function connecting()
    {
        /*$driver = new postgres([
            'host' => '172.16.0.195',
            'database' => 'brpi',
            'username' => 'postgres',
            'password' => ''
        ]);*/
        $connection = new Connection([
            'driver' => \Cake\Database\Driver\Postgres::class,
            'host' => '172.16.0.195',
            'database' => 'brpi',
            'username' => 'postgres',
            'encoding' => 'utf8',
            'collation' => 'utf8mb4_unicode_ci',
            
           ]);

    var_dump($connection);
    }
    
}
