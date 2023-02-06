<?php

// Dev environment

return function (array $settings): array {
    // Error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');

    $settings['error']['display_error_details'] = true;
    $settings['logger']['level'] = \Monolog\Level::Debug;

    // Database
    $settings['db']['host'] = '172.16.0.196';
    $settings['db']['username'] = 'postgres';
    $settings['db']['database'] = 'migracioness';
    $settings['db']['encoding'] = 'utf8';

    return $settings;
};
