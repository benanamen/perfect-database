<?php

declare(strict_types=1);

namespace PerfectApp\Database;

use PDO;

interface ConnectionInterface
{
    /**
     * Connects to a database using PDO.
     *
     * @param array $config An array containing the database configuration parameters.
     *                      Expected keys: host, dbname, charset, username, password, options.
     * @return PDO A PDO instance representing the database connection.
     *
     */
    public function connect(array $config): PDO;
}
