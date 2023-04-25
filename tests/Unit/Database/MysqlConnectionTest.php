<?php

declare(strict_types=1);

namespace Unit\Database;

use PDOException;
use PerfectApp\Database\MysqlConnection;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(MysqlConnection::class)]
class MysqlConnectionTest extends TestCase
{
    private MysqlConnection $connection;

    protected function setUp(): void
    {
        $this->connection = new MysqlConnection();
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
