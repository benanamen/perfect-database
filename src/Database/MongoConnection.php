<?php

/** @noinspection ALL */

declare(strict_types=1);

namespace PerfectApp\Database;

use InvalidArgumentException;
use MongoDB\Client;

class MongoConnection implements ConnectionInterface
{
    final public function connect(array $config)
    {
        $requiredKeys = ['uri', 'database'];
        if (array_diff($requiredKeys, array_keys($config))) {
            throw new InvalidArgumentException(
                "Invalid config array. Missing required keys: " . implode(
                    ", ",
                    array_diff($requiredKeys, array_keys($config))
                )
            );
        }

        $client = new Client($config['uri']);
        return $client->selectDatabase($config['database']);
    }
}
