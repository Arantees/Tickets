<?php

namespace Tickets\Controller\Admin;

use Tickets\Utils\View;

class Page{
    /**
     * Metodo responsavel por retornar o conteudo da estrutura generica de pagina do painel
     * @param string $title
     * @param string $content
     * @return string
     */
    public static function getPage($title, $content){
        return View::render('pages/admin/page',[
            'title'   => $title,
            'content' => $content
        ]);                
    }
}