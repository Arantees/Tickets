<?php

require __DIR__. '/../vendor/autoload.php';

use Tickets\Utils\FunctionsUtils;
use Tickets\Utils\View;
use WilliamCosta\DotEnv\Environment;
use WilliamCosta\DatabaseManager\Database;

Environment::load(__DIR__.'/../');


//Define as configuraçoes de banco de dados;


//FunctionsUtils::print_pre(getenv('URL'));
define('URL', getenv('URL'));

//Define valor padrao das variaveis
View::init([
    'URL' => URL
]);