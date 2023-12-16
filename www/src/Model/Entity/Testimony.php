<?php

namespace Tickets\Model\Entity;

use Tickets\Utils\FunctionsUtils;
use Tickets\Model\Database\Database;

class Testimony
{
    /**
     * Id do Depoimento
     */
    public int $id;

    // Nome do usuario que fez o depoimento
    public string $nome;

    // Mensagem do depoimentos

    public string $mensagem;

    // Data da publicaçao do depoimento
    public string $data;

    /**
     *  Metodo responsavel por cadastrar a instancia atual do banco de dados
     * @return boolean
     */
    public function cadastrar()
    {
        //Define a data
        $this->data = date('Y-m-d H:i:s');

        $this->id = (new Database('depoiments'))->insert(
            [
                'nome' => $this->nome,
                'mensagem' => $this->mensagem,
                'data' => $this->data
            ]
        );
        return true;
    }
    /**
     * Metodo responsavel por retornar depoimentos
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $field
     * @return \PDOStatement
     */
    public static function getTestimonies( $where='', $order = '', $limit = '', $field = '*'){
        return (new Database('depoiments')) -> select ($where,$order,$limit, $field);
    }
}
