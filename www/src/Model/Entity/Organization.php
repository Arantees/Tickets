<?php

namespace Tickets\Model\Entity;

class Organization
{
    /**
     * Id da organização
     * @var integer
     */
    public $id = 1;
    /**
     * Id da organização
     * @var string
     */
    public $name = 'Teste Tickets';

    /**
     * Site da organização
     * @var string
     */
    public $site = 'https://github.com/Arantees/Tickets';

    /**
     * Descrição da organização
     * @var string
     */
    public $description = '"Tickets: Transforme a gestão de projetos com facilidade. Organize tarefas, colabore em tempo real e avance de forma eficiente. Descubra a simplicidade no gerenciamento com Tickets."';
}
