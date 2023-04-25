<?php

declare(strict_types=1);

namespace PerfectApp\Database;

use PDO;

class MysqlConnection extends BaseConnection
{
    public function createConnection(array $config): PDO
    {
        $dsn = "mysql:host={$config['host']};
        port={$config['port']};
        dbname={$config['dbname']};
        charset={$config['charset']}";

        return new PDO($dsn, $config['username'], $config['password'], $config['options']);
    }
}
