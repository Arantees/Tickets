<?php

namespace Tickets\Http\Middleware;

use Tickets\Http\Middleware\Request;
use Tickets\Http\Middleware\Response;

class Queue
{
    /**
     * Mapeamento de Middlewares
     * @var array
     */
    private static $map = [];
    /**
     * Mapeamento de middlewares serao carregados em todas as rotas
     * @var array
     */
    private static $default = [];

    /**
     * Fila de middlewares a serem executados
     * @var array
     */
    private $middlewares = [];

    /**
     * funcao de execucao do controlador
     * @var \Closure
     */
    private $controller;
    /**
     * Argumentos da funcao do controlador
     * @var array
     */
    private $controllerArgs = [];
    /**
     * Metodo responsavel por construir a classe de fila de middlewares
     * @param array $middlewares
     * @param \Closure $controller
     * @param array $controllerArgs
     */
    public function __construct($middlewares, $controller, $controllerArgs)
    {
        $this->middlewares    =     array_merge(self::$default, $middlewares);
        $this->controller     =     $controller;
        $this->controllerArgs =     $controllerArgs;
    }
    
    /**
     * Metodo responsavel por definir o mapeamento de middlewares
     * @param array $map
     */
        
    public static function setMap($map)
    {
        self::$map = $map;
    }
    /**
     * Metodo responsavel por definir o mapeamento de middlewares padroes
     * @param array $default
     */
    public static function setDefault($default)
    {
        self::$default = $default;
    }
    /**
     * Metodo responsavel por executar o proximo nivel da fila de middlewares
     * @param \Tickets\Http\Request $request
     * @return \Tickets\Http\Response
     */
    public function next($request)
    {
        //Verifica se a fila esta vazia
        if (empty($this->middlewares)) {
            return call_user_func_array($this->controller, $this->controllerArgs);
        }
        //Middleware
        $middleware = array_shift($this->middlewares);
        // var_dump($middleware);
       
        //Verifica o mapeamento
         if (!isset(self::$map[$middleware])) {
            throw new \Exception("Problemas ao processar o middleware da requisicao", 500);
        }

        //Next
        $queue = $this;
        $next = function ($request) use ($queue) {
            return $queue->next($request);
        };
        
        //Executa o Middleware
        return (new self::$map[$middleware])->handle($request, $next);
    }
}
