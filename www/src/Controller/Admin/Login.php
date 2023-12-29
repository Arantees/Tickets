<?php

namespace Tickets\Controller\Admin;

use Tickets\Http\Request;
use Tickets\Utils\View;
class Login extends Page{

    /**
     * Metodo responsavel por retornar a renderizaçao de uma instancia de login
     * @param Request $request
     * @return string
     */
    public static function getLogin($request){
        //Conteudo da pagina de login
        $content = View::render('pages/admin/login',[]);

    
    //retorna a pagina completa
    return parent::getPage('Login > Tickets', $content);
   
    }
}