<?php

namespace Tickets\Controller\Pages;

use Tickets\Utils\View;

class Home extends Page
{
    /**
     * método responsavel por retornar para o counteudo da view da home
     * @return  string
     */
    public static function getHome()
    {
        $content =  View::render('pages/home', [
            'name'  => ' Tickets Arantes',
            'description'=> 'Aprendendo a renderizar'
        ]);
        //RETORNA A VIEW DA PAGINA
        return parent::getPage('Teste-Tickets', $content) ;
    }
}
