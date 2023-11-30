<?php
use Tickets\Http\Response;
use \Tickets\Controller\Pages;

//ROTA HOME
$obRouter->get('/', [
    function (){
        return new Response(200, Pages\Home::getHome());
    }
]);
//ROTA Sobre
$obRouter->get('/sobre', [
    function (){
        return new Response(200, Pages\About::getAbout());
    }
]);
//ROTA Dinamica
$obRouter->get('/pagina/{idPagina}/{acao}', [
    function ($idPagina,$acao){
        return new Response(200, 'pagina - ' . $idPagina . ' - ' . $acao);
    }
]);