<?php

require __DIR__. '/../vendor/autoload.php';

use Tickets\Utils\FunctionsUtils;
use Tickets\Utils\View;
use WilliamCosta\DotEnv\Environment;
use Tickets\Model\Database\Database;

Environment::load(__DIR__.'/../');


//Define as configuraçoes de banco de dados;
Database::config(
    getenv('DB_HOST'),    
    getenv('DB_NAME'),
    getenv('DB_USER'),
    getenv('DB_PASS'),
    getenv('DB_PORT')
);

//FunctionsUtils::print_pre(getenv('URL'));
define('URL', getenv('URL'));

//Define valor padrao das variaveis
View::init([
    'URL' => URL
]);