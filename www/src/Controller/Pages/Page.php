<?php

namespace Tickets\Controller\Pages;

use Tickets\Utils\View;

class Page
{
    /**
     * método responsavel por retornar para o counteudo da pagina
     * @return  string
     */
    public static function getPage($title, $content)
    {
        return View::render('pages/page', [
            'title'  => $title,
            'content'=> $content
        ]);
    }
}
