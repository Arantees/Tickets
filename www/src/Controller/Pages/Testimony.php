<?php

namespace Tickets\Controller\Pages;

use Tickets\Utils\View;
use Tickets\Model\Entity\Testimony as EntityTestimony;
use Tickets\Utils\FunctionsUtils;
use \Tickets\Model\Database\Pagination;

class Testimony extends Page
{

     /**
    * Metodo responsavel por obter a renderizacao dos itens de depoimentos para a pagina
    *@param \Tickets\Http\Request @request
    *@param \Tickets\Model\Database\Pagination $obPagination
    */
    private static function getTestimonyItens($request,&$obPagination){
         //Depoimentos
        $itens = '';

        //Quantidade total de registro
        $quantidadeTotal = EntityTestimony::getTestimonies('', '','','COUNT(*) as qtd')-> fetchObject()->qtd;
        
        //Pagina atual
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page']  ?? 1;

        //Instancia de paginaçao
        $obPagination = new Pagination($quantidadeTotal,$paginaAtual,3);

        //Resultados da pagina
        $results = EntityTestimony::getTestimonies('', 'id DESC',$obPagination->getLimit());

        //Renderiza o item
        while($obTestimony = $results->fetchObject(EntityTestimony::class)){
            $itens .=  View::render('pages/testimony/item', [
                'nome' => $obTestimony->nome,
                'mensagem' => $obTestimony->mensagem,
                'data' => date('d/m/Y H:i:s', strtotime($obTestimony->data))
            ]); 
        }
        
        return $itens;        
    }
    /**
     * método responsavel por retornar para o counteudo da view de depoimentos
     * @param \Tickets\Http\Request
     * @return string
     */
    public static function getTestimonies($request):string
    {        
        // View de depoimentos
        $content =  View::render('pages/testimonies', [
            'itens' => self::getTestimonyItens($request,$obPagination),
            'pagination' => parent::getPagination($request,$obPagination)
        ]);        

        //RETORNA A VIEW DA PAGINA
        return parent::getPage('Depoimentos > Tickets', $content);
    }

    /**
     * Metodo responsavel por cadastrar depoimentos
     * @param \Tickets\Http\Request
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
        //Retorna a pagina de listagem de depoimentos
        return self::getTestimonies($request);
    }
}
