<?php

namespace Tickets\Controller\Pages;

use Tickets\Utils\View;
use Tickets\Model\Entity\Organization;

class Home extends Page
{
    /**
     * método responsavel por retornar para o counteudo da view da home
     * @return  string
     */
    public static function getHome(): string
    {
        $obOrganization = new Organization;
        
        $content =  View::render('pages/home', [
            'name'  => $obOrganization->name
        ]);        
        //RETORNA A VIEW DA PAGINA
        return parent::getPage('Home > Tickets', $content);
    }
}
