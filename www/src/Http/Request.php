<?php

namespace Tickets\Http;

class Request
{
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

    public function __construct()
    {
        $this->queryParams = $_GET ?? [];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri = $_SERVER['REQUEST_URI'] ?? '';
    }

    /**
     * Metodo responsavel por retornar o metodo HTTP da requisicao
     * @return string
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }
    /**
     * Metodo responsavel por retornar a URI da requisicao
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Metodo responsavel por retornar os headers da requisicao
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Metodo responsavel por retornar os parametros da URL da requisicao
     * @return array
     */
    public function getQueryParams()
    {
        return $this->queryParams;
    }
    /**
     * Metodo responsavel por retornar as variaveis POST da requisicao
     * @return array
     */
    public function getPostVars()
    {
        return $this->postVars;
    }
}
