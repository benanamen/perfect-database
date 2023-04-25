<?php

declare(strict_types=1);

namespace Unit\Database;

use PDOException;
use PerfectApp\Database\PostgresConnection;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(PostgresConnection::class)]
class PostgresConnectionTest extends TestCase
{
    private PostgresConnection $connection;

    protected function setUp(): void
    {
        $this->connection = new PostgresConnection();
    }

    public function testCreateConnectionWithUnsupportedCharset()
    {
        $config = [
            'host' => 'localhost',
            'dbname' => 'myDB',
            'charset' => 'unsupported_charset',
            'username' => 'root',
            'password' => '',
            'port' => 3306,
            'options' => []
        ];

        $this->expectException(PDOException::class);

        $this->connection->createConnection($config);
    }
}
