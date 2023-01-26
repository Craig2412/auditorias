<?php

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/resources/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/resources/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => 'pgsql',
            'host' => '172.16.0.196',//'localhost',//
            'name' => 'migracioness',
            'user' =>'postgres',// 'root',//
            'pass' => '',
            'port' => '5432',//'3306',//
            'charset' => 'utf8',
        ],
        'development' => [
            'adapter' => 'pgsql',
            'host' => '172.16.0.196',//'localhost',//
            'name' => 'migracioness',
            'user' =>'postgres',// 'root',//
            'pass' => '',
            'port' => '5432',//'3306',//
            'charset' => 'utf8',
        ],
        'testing' => [
            'adapter' => 'pgsql',
            'host' => '172.16.0.196',//'localhost',//
            'name' => 'migracioness',
            'user' =>'postgres',// 'root',//
            'pass' => '',
            'port' => '5432',//'3306',//
            'charset' => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];
