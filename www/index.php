<?php

require_once 'vendor/autoload.php';

use Tickets\Controller\Pages\Home;
use Tickets\Model\Connection;

$connection = (new Connection()) -> createConnection();
$obResponse = new \Tickets\Http\Response(200, 'Hello World');

$obResponse ->sendResponse();
exit;
echo Home::getHome();
