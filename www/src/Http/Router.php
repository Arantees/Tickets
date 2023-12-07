<?php

namespace Tickets\Http;

use \Closure;
use \Exception;
use \ReflectionFunction;
use Tickets\Utils\FunctionsUtils;

class Router
{
    /**
     * Url completa do projeto(raiz)
     * @var string
     */
    private $url = '';
    /**
     * Prefixo de todas as rotas
     * @var string
     */
    private $prefix = '';
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
    public function __construct($url)
    {
        $this->request = new Request();
        $this->url     = $url;
        $this->setPrefix();
    }
    /**
     * Metodo responsavel por definir o prefixo das rotas
     */
    private function setPrefix()
    {
        // Informacoes da url atual
        $parseUrl = parse_url($this->url);
        // Define o prefixo diretamente
        $this->prefix = $parseUrl['path'] ?? '';
    }
    /**
     * Metodo responsavel por adicionar uma rota na classe
     */
    private function addRoute(string $method, string $route, array $params = [])
    {
        //Validacao dos parametros
        foreach ($params as $key => $value) {
            if ($value instanceof Closure) {
                $params['Controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }

        //Variaveis da Rota
        $params['variables'] = [];
        //Padrao de validaçao das variaveis das rotas
        $patternVariable = '/{(.*?)}/';
        if (preg_match_all($patternVariable, $route, $matches)) {
            $route = preg_replace($patternVariable, '(.*?)', $route);
            // FunctionsUtils::print_pre($matches);
            $params['variables'] = $matches[1];
        }


        //Padrao de validacao da url
        $patternRoute = '/^' . str_replace('/', '\/', $route) . '$/';
        // FunctionsUtils::print_pre($patternRoute);
        // FunctionsUtils::print_pre($params);

        //Adiciona a rota dentro da classe
        $this->routes[$patternRoute][$method] = $params;
        // FunctionsUtils::print_pre($this->routes['/^\/cleber$/']['GET']['Controller']);
    }


    /**
     * metodo responsavel por definir uma rota de GET
     */
    public function get(string $route, array $params = [])
    {
        return $this->addRoute('GET', $route, $params);
    }
    /**
     * metodo responsavel por definir uma rota de POST
     */
    public function post(string $route, array $params = [])
    {
        return $this->addRoute('POST', $route, $params);
    }
    /**
     * metodo responsavel por definir uma rota de PUT
     */
    public function put(string $route, array $params = [])
    {
        return $this->addRoute('PUT', $route, $params);
    }
    /**
     * metodo responsavel por definir uma rota de DELETE
     */
    public function delete(string $route, array $params = [])
    {
        return $this->addRoute('DELETE', $route, $params);
    }

    /**
     * Metodo responsavel por retornar a URI desconsiderando o prefixo
     * @return string
     */
    private function getUri()
    {
        //Uri da request
        $uri = $this->request->getUri();
        // FunctionsUtils::print_pre($uri);
        // Fatia a URI com o prefix
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : ($uri);
        // Retorna uri sem prefixo
        return end($xUri);
    }
    /**
     * Metodo responsavel por retornar os dados da rota atual
     * @return string
     */
    private function getRoute()
    {
        //URI
        $uri = $this->getUri();
        //Method
        $httpMethod = $this->request->getHttpMethod();

        //Validacao das Rotas
        foreach ($this->routes as $patternRoute => $methods) {
            //FunctionsUtils::print_pre($this->routes);
            //Verifica se a URI bate com o padrao
            if (preg_match($patternRoute, $uri, $matches)) {
                //FunctionsUtils::print_pre($methods[$httpMethod]);

                //Verifica o metodo
                if (isset($methods[$httpMethod])) {
                    //Remove a primeira posicao
                    unset($matches[0]);

                    //Variaveis processadas
                    $keys = $methods[$httpMethod]['variables'];
                    $methods[$httpMethod]['variables'] = array_combine($keys, $matches);
                    $methods[$httpMethod]['variables']['request'] = $this->request;
                    // Retorno dos parametros da rota
                    return $methods[$httpMethod];
                }
                //Metodo nao permitido/definido
                throw new Exception("Metodo nao permitido", 405);
            }
        }
        //URL nao encontrada
        throw new Exception("Url nao encontrada", 404);
    }
    /**
     * Metodo responsavel por executar a rota atual
     * @return Response
     */
    public function run()
    {
        try {
            //Obtem a rota atual
            $route = $this->getRoute();

            //Verifica o controlador
            if (!isset($route['Controller'])) {
                throw new Exception("A URL nao pôde ser processada", 500);
            }
            // Argumentos da funçao 
            $args = [];

            //Reflection
            $reflection = new ReflectionFunction($route['Controller']);
            foreach ($reflection->getParameters() as $parameter) {
                $name = $parameter->getName();
                $args[$name] = $route['variables'][$name] ?? '';
            }

            //Retorna a execuçao da funçao
            return call_user_func_array($route['Controller'], $args);
            // FunctionsUtils::print_pre($route);

        } catch (Exception $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
    }
}
