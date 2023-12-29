<?php

namespace Tickets\Http\Middleware;

use Tickets\Http\Request;
use Tickets\Http\Response;
class Maintenance{

    /**
     * Metodo responsavel por executar o middleware
     * @param Request $request
     * @param Closure next
     * @return Response
     */
    public function handle($request, $next){
        //Verifica o estado de manutencao da pagina
        if(getenv('MAINTENANCE') === 'true'){
            throw new \Exception("Pagina em manutençao, tente novamente mais tarde", 200);
        }

        // Executa o proximo nivel do middleware
        return $next($request);
    }
}