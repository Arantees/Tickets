<?php

namespace Tickets\Controller\Pages;

use Tickets\Utils\View;
use Tickets\Model\Entity\Testimony as EntityTestimony;
use Tickets\Utils\FunctionsUtils;

class Testimony extends Page
{

     /**
     * Metodo responsavel por obter a renderizacao dos itens de depoimentos para a pagina
     */
    private static function getTestimonyItems(){
         //Depoimentos
        $itens = '';
        
        //Resultados da pagina
        $results = EntityTestimony::getTestimonies('', 'id DESC');

        //Renderiza o item
        while($obTestimony = $results->fetchObject(EntityTestimony::class)){
            FunctionsUtils::print_pre($obTestimony);
        }

        return $itens;
    }
    /**
     * método responsavel por retornar para o counteudo da view de depoimentos
     */
    public static function getTestimonies():string
    {
        
        // View de depoimentos
        $content =  View::render('pages/testimonies', [
            'items' => self::getTestimonyItems()
        ]);        

        //RETORNA A VIEW DA PAGINA
        return parent::getPage('Depoimentos > Tickets', $content);
    }

    /**
     * Metodo responsavel por cadastrar depoimentos
     * @param Request
     * @return string
     */
    public static function insertTestimony($request){
        // Dados do post
        $postVars = $request->getPostVars();
        //Nova instancia de depoimento
        $obTestimony = new EntityTestimony;
        $obTestimony->nome = $postVars['nome'];
        $obTestimony->mensagem = $postVars['mensagem'];
        $obTestimony->cadastrar();
        return self::getTestimonies();
    }
}
