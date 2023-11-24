<?php

namespace Tickets\Controller\Pages;


use Tickets\Utils\View;

class Page
{
    /**
     * Metodo responsavel por renderizar o topo da pagina
     */
    private static function getHeader(): string
    {
        return View::render("pages/header");
    }
    /**
     * Metodo responsavel por renderizar o rodapé da pagina
     */
    private static function getFooter(): string
    {
        return View::render("pages/footer");
    }
    /**
     * método responsavel por retornar para o counteudo da pagina
     */
    public static function getPage($title, $content): string
    {
        return View::render('pages/page', [
            'title'  => $title,
            'header' => self::getHeader(),
            'content' => $content,
            'footer' => self::getFooter()
        ]);
    }
}
