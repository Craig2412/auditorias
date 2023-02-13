<?php
   

function Tuupola()
{
    return(new Tuupola\Middleware\JwtAuthentication([
        "attribute" => "jwt",
        "secret" => '1',
        "ignore" => ["/api/user/authenticate"],
    ]));
}