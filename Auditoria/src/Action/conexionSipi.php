<?php
namespace App\Action;
use Cake\Database\Connection;

final class conexionSipi
{
    public function connecting()
    {
        /*
        $driver = new postgres([
            'host' => '172.16.0.195',
            'database' => 'brpi',
            'username' => 'postgres',
            'password' => ''
        ]);
        
        $connection = new Connection([
            'driver' => \Cake\Database\Driver\Postgres::class,
            'host' => '172.16.0.196',
            'database' => 'migracioness',
            'username' => 'postgres',
            'encoding' => 'utf8',
            'collation' => 'utf8mb4_unicode_ci',
            
           ]);*/
           
           
            $conexion = pg_connect("host=172.16.0.195 port=5432 dbname=bdrpi user=postgres password=");
            $query = pg_query( $conexion, "SELECT * FROM stzderec" );
            var_dump(pg_fetch_array($query));

    }
    
}
