<?php

namespace Tickets\Http;

class Response
{

    /**
     * Codigo do status HTTP
     * @var  integer
     */

    private $httpCode = 200;

    /**
     * Cabeçalho do response
     * @var array
     */
    private $headers = [];
    /**
     * Tipo de conteudo que esta sendo retornado 
     * @var mixed
     */
    private $contentType = 'text/html';

    /**
     * conteudo do Response
     * @var mixed
     */
    private $content;

    /**
     * Metodo responsavel por iniciar a classe e definir os valores
     */
    public function __construct(int $httpCode, mixed $content, string $contentType = 'text/html')
    {
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setcontentType($contentType);
    }
    /**
     * Metodo responsavel por alterar o content type do response
     */
    public function setContentType(string $contentType)
    {
        $this->contentType = $contentType;
        $this->addHeader('Content-Type', $contentType);
    }
    /**
     * Metodo responsavel por adicionar um registro no cabeçalho do response
     */
    public function addHeader(string $key, string $value)
    {
        $this->headers[$key] = $value;
    }
    /**
     * Metodo responsavel por enviar os headers para o navegador
     */
    private function sendHeaders()
    {
        //Status
        http_response_code($this->httpCode);

        //ENVIAR HEADERS
        foreach ($this->headers as $key => $value) {
            header($key . ': ' . $value);
        }
    }

    /**
     * Metodo responsavel por enviar resposta pro usuario
     */
    public function sendResponse()
    {
        //Envia os headers
        $this->sendHeaders();

        //Exibe conteudo
        switch ($this->contentType) {
            case 'text/html':
                echo $this->content;
                exit;
        }
    }
}
