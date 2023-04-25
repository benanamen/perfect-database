<?php

declare(strict_types=1);

namespace PerfectApp\Database;

use InvalidArgumentException;
use PDO;

abstract class BaseConnection implements ConnectionInterface
{
    public function connect(array $config): PDO
    {
        $requiredKeys = ['host', 'dbname', 'charset', 'username', 'password'];

        if (array_diff($requiredKeys, array_keys($config))) {
            throw new InvalidArgumentException(
                "Invalid config array. Missing required keys: " . implode(
                    ", ",
                    array_diff($requiredKeys, array_keys($config))
                )
            );
        }

        if (!is_numeric($config['port']) || $config['port'] < 1 || $config['port'] > 65535) {
            throw new InvalidArgumentException('Invalid port number');
        }

        return $this->createConnection($config);
    }

    abstract protected function createConnection(array $config): PDO;
}
