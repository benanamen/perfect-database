<?php

declare(strict_types=1);

namespace Unit\Database;

use InvalidArgumentException;
use PDO;
use PDOException;
use PerfectApp\Database\SqliteConnection;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(SqliteConnection::class)]
class SqliteConnectionTest extends TestCase
{
    private SqliteConnection $connection;

    protected function setUp(): void
    {
        $this->connection = new SqliteConnection();
    }

    public function testConnectWithValidConfig()
    {
        $config = [
            'path' => ':memory:',
            'options' => []
        ];

        $pdo = $this->connection->connect($config);

        $this->assertInstanceOf(PDO::class, $pdo);
    }

    public function testConnectWithMissingRequiredKeys()
    {
        $config = [
            'path' => ':memory:'
        ];

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid config array. Missing required keys: options');

        $this->connection->connect($config);
    }

    public function testConnectWithInvalidPath()
    {
        $config = [
            'path' => '/invalid/path',
            'options' => []
        ];

        $this->expectException(PDOException::class);

        $this->connection->connect($config);
    }
}
