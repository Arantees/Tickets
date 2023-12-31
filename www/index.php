<?php

require __DIR__.'/Includes/app.php';

use Tickets\Http\Router;


//Inicia o router
$obRouter = new Router(URL);
//FunctionsUtils::print_pre($obRouter);

//Inclui as rotas de paginas
include __DIR__.'/Routes/pages.php';

//Inclui as rotas do Painel
include __DIR__.'/Routes/admin.php';

// imprime o response da rota
$retorno = $obRouter->run();
$retorno->sendResponse();