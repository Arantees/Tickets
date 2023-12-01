<?php

require_once 'vendor/autoload.php';

use Tickets\Http\Router;
use Tickets\Utils\FunctionsUtils;
use Tickets\Utils\View;
use WilliamCosta\DotEnv\Environment;

Environment::load(__DIR__);

FunctionsUtils::print_pre(getenv('URL')); exit;
define('URL','http://localhost/tickets');

//Define valor padrao das variaveis
View::init([
    'URL' => URL
]);

//Inicia o router
$obRouter = new Router(URL);
//FunctionsUtils::print_pre($obRouter);

//Inclui as rotas de paginas
include __DIR__.'/Router/pages.php';

// imprime o response da rota
$obRouter->run()
    ->sendResponse();
