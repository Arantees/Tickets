<?php

namespace Tickets\Controller\Pages;


use Tickets\Utils\View;
use Tickets\Http\Request;

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
     * Metodo responsavel por renderizar o layout da paginaçao
     * @param \Tickets\Http\Request $request
     * @param \Tickets\Model\Database\Pagination $obPagination
     * @return string
     */
    public static function getPagination($request, $obPagination)
    {
        //Paginas
        $pages = $obPagination->getPages();

        //Verifica a quantiade de paginas
        if (count($pages) <= 1) return '';

        //Links
        $links = '';

        //Url atual (sem gets)
        $url = $request->getRouter()->getCurrentUrl();

        //GEt
        $queryParams = $request->getQueryParams();

        //Renderiza os links
        foreach ($pages as $page) {
            $queryParams['page'] = $page['page'];

            //Link
            $link = $url . '?' . http_build_query($queryParams);

            //View
            $links .= View::render('pages/pagination/link', [
                'page'  => $page['page'],
                'link' => $link,
                'active' => $page['current'] ? 'active' : ''
            ]);
        }

        //Renderiza box de paginacao
        return View::render('pages/pagination/box', [          
            'links' => $links
        ]);
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
