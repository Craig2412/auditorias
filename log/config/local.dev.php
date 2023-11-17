<?php

// Dev environment

return function (array $settings): array {
    // Error reporting
    
    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');

    $settings['error']['display_error_details'] = true;
    $settings['logger']['level'] = \Monolog\Level::Debug;

    // Database
    $settings['db']['host'] = 'localhost';
    $settings['db']['username'] = 'root';
    $settings['db']['database'] = 'cakephp';
    $settings['db']['encoding'] = 'utf8';

    $_ENV['bcrypt']= 12;

    return $settings;
};
