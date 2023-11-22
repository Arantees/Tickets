<?php

namespace Tickets\Model;

use PDO;

class Connection
{
    public static function createConnection(): PDO
    {
        $pdo = "pgsql:host=db;port=5432;dbname=TicketsDb;user=postgres;password=password";

        return new PDO($pdo);
    }
}