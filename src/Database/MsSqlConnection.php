<?php

declare(strict_types=1);

namespace PerfectApp\Database;

use InvalidArgumentException;
use PDO;

class MsSqlConnection implements ConnectionInterface
{
    final public function connect(array $config): PDO
    {
        $requiredKeys = ['host', 'dbname', 'username', 'password'];
        if (array_diff($requiredKeys, array_keys($config))) {
            throw new InvalidArgumentException(
                "Invalid config array. Missing required keys: " . implode(
                    ", ",
                    array_diff($requiredKeys, array_keys($config))
                )
            );
        }

        $dsn = "sqlsrv:Server={$config['host']};Database={$config['dbname']};";
        if (!empty($config['options'])) {
            $dsn .= http_build_query($config['options'], '', ';');
        }

        return new PDO($dsn, $config['username'], $config['password']);
    }
}
