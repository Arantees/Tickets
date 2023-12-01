<?php

namespace Tickets\Controller\Pages;

use Tickets\Utils\View;

class Testimony extends Page
{
    /**
     * método responsavel por retornar para o counteudo da view de depoimentos
     */
    public static function getTestimonies():string
    {
        // View de depoimentos
        $content =  View::render('pages/testimonies', [

        ]);        

        //RETORNA A VIEW DA PAGINA
        return parent::getPage('Depoimentos > Tickets', $content);
    }
}
