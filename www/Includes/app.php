<?php

require __DIR__. '/../vendor/autoload.php';

use Tickets\Utils\FunctionsUtils;
use Tickets\Utils\View;
use WilliamCosta\DotEnv\Environment;
use Tickets\Model\Database\Database;
use Tickets\Http\Middleware\Queue as MiddlewareQueue;

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

//Define o mapeamento de middlewares
MiddlewareQueue::setMap([
    'maintenance' => \Tickets\Http\Middleware\Maintenance::class
]);
//Define o mapeamento de middlewares padroes (executado em todas as rotas)
MiddlewareQueue::setDefault([
    'maintenance'
]);