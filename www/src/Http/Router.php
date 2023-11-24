<?php

namespace Tickets\Http;
use \Closure;
class Router{
    /**
     * Url completa do projeto(raiz)
     * @var string
     */
    private $url = '';
    /**
     * Prefixo de todas as rotas
     * @var string
     */
    private $prefix= '';

    /**
     * Indice de rotas
     * @var array
     */
    private $routes = [];

    /**
     *Instancia de request
     *@var Request 
     */
    private $request;

    /**
     * Metodo responsavel por iniciar a classe
     * @param string $url
     */
    public function __construct($url){
        $this->request = new Request();
        $this->url     = $url;
        $this->setPrefix();
    }

    private function setPrefix(){
        //Informacoes da url atual
        $parseUrl = parse_url($this->url);
        
        //Define o prefixo
        $this->prefix =$parseUrl['patch'] ?? 'cade vc';
    }

    /**
     * Metodo responsavel por adicionar uma rota na classe
     */
    private function addRoute(string $method ,string $route,array $params=[]){
          //Validacao dos parametros
          foreach ($params as $key=>$value){
            if($value instanceof Closure){
                $params['Controller'] = $value;
                unset($params[$key]);
            }
          }
        
    }

    /**
     * metodo responsavel por definir uma rota de GET
     */
    public function get($route, $params = []){
        return $this->addRoute('GET', $route, $params);
    }
    
}