<?php

namespace Tickets\Controller\Pages;

use Tickets\Utils\View;
use Tickets\Model\Entity\Organization;

class About extends Page
{
    /**
     * método responsavel por retornar para o counteudo da view da pagina Sobre
     */
    public static function getAbout():string
    {
        $obOrganization = new Organization;
        
        $content =  View::render('pages/about', [
            'name'  => $obOrganization->name,
            'description' =>  $obOrganization->description,
            'site' => $obOrganization->site
        ]);        
        //RETORNA A VIEW DA PAGINA
        return parent::getPage('Sobre > Tickets', $content);
    }
}
