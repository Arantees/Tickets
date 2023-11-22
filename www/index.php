<?php

require_once 'vendor/autoload.php';

use Tickets\Controller\Pages\Home;
use Tickets\Model\Connection;

$connection = (new Connection()) -> createConnection();

echo Home::getHome();
