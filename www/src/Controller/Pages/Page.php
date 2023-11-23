<?php

namespace Tickets\Controller\Pages;


use Tickets\Utils\View;

class Page
{
    /**
     * Metodo responsavel por renderizar o topo da pagina
     * @return string
     */
    private static function getHeader(){
        return View::render("pages/header");
    }
    /**
     * Metodo responsavel por renderizar o rodapé da pagina
     * @return string
     */
    private static function getFooter(){
        return View::render("pages/footer");
    }
    /**
     * método responsavel por retornar para o counteudo da pagina
     * @return  string
     */
    public static function getPage($title, $content)
    {
        return View::render('pages/page', [
            'title'  => $title,
            'header'=> self::getHeader(),
            'content'=> $content,
            'footer'=> self::getFooter()
        ]);
    }
}
