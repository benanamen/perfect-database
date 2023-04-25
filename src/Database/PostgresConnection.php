<?php

declare(strict_types=1);

namespace PerfectApp\Database;

use PDO;

class PostgresConnection extends BaseConnection
{
    final public function createConnection(array $config): PDO
    {
        $dsn = "pgsql:host={$config['host']};
        port={$config['port']};
        dbname={$config['dbname']}";

        return new PDO($dsn, $config['username'], $config['password'], $config['options']);
    }
}
