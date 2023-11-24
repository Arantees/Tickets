<?php

require_once 'vendor/autoload.php';
use Tickets\Controller\Pages\Home;
use Tickets\Http\Response;
use Tickets\Http\Router;
use Tickets\Utils\FuncoesUtils;

define('URL', 'http://localhost/tickets');
$obRouter= new Router(URL);
FuncoesUtils::print_pre($obRouter);

//ROTA HOME
$obRouter->get('/',[
    function(){
        return new Response(200,Home::getHome());
    }
]);

