<?php

declare(strict_types=1);

namespace PerfectApp\Database;

use InvalidArgumentException;
use PDO;

class SqliteConnection implements ConnectionInterface
{
    final public function connect(array $config): PDO
    {
        $requiredKeys = ['path', 'options'];
        if (array_diff($requiredKeys, array_keys($config))) {
            throw new InvalidArgumentException(
                "Invalid config array. Missing required keys: " . implode(
                    ", ",
                    array_diff($requiredKeys, array_keys($config))
                )
            );
        }

        $dsn = "sqlite:{$config['path']}";
        return new PDO($dsn, null, null, $config['options']);
    }
}
