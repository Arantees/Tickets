<?php

namespace Tickets\Http;

class Request {
    /**
     * Método HTTP da requisiçao
     */
    private $httpMethod;

    /**
     * Uri da pagina
     */
    private $uri;

    /**
     * Parametros da URL ($_GET)
     */
    private $queryParams = [];

    /**
     * Variaveis recebidas no post da pagina ($_POST)
     * @var array
     */
    private $postVars = [];

     /**
     * Cabeçalho da requisiçao
     * @var array
     */
    private $headers = [];

   public function __construct() {
        $this->queryParams = $_GET ??[];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders();
        $this->httpMethod= $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri =$_SERVER['REQUEST_URI'] ?? '';
    }

    public function getQueryParams(){
        return $this->queryParams;
    }
    
    public function getPostVars(){
        return $this->postVars;
    }
}