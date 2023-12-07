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

//ROTA Depoimentos
$obRouter->get('/depoimentos', [
    function (){
        return new Response(200, Pages\Testimony::getTestimonies());
    }
]);
//ROTA Depoimentos (Insert)
$obRouter->post('/depoimentos', [
    function ($request){
        return new Response(200, Pages\Testimony::insertTestimony($request));
    }
]);

//ROTA Cleber
$obRouter->get(
    '/cleber',
    [function (){echo "Bem vindo Cleber";}]
);