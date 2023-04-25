<?php

declare(strict_types=1);

namespace Unit\Database;

use InvalidArgumentException;
use PDO;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use PerfectApp\Database\BaseConnection;

#[CoversClass(BaseConnection::class)]
class BaseConnectionTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testConnectWithValidConfig(): void
    {
        $mockConnection = $this->getMockForAbstractClass(BaseConnection::class);

        $config = [
            'host' => 'localhost',
            'dbname' => 'myDB',
            'charset' => 'utf8mb4',
            'username' => 'root',
            'password' => '',
            'port' => 3306,
            'options' => []
        ];

        $pdo = $mockConnection->connect($config);

        $this->assertInstanceOf(PDO::class, $pdo);
    }

    public function testConnectThrowsExceptionWhenRequiredKeyIsMissing(): void
    {
        $config = [
            'host' => 'localhost',
            'dbname' => 'myDB',
            'charset' => 'utf8mb4',
            'password' => '',
        ];

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid config array. Missing required keys: username');

        $baseConnectionMock = $this->getMockBuilder(BaseConnection::class)
            ->getMockForAbstractClass();

        $baseConnectionMock->connect($config);
    }

    /**
     * @throws Exception
     */
    public function testConnectWithInvalidPortNumber(): void
    {
        $mockConnection = $this->getMockForAbstractClass(BaseConnection::class);

        $config = [
            'host' => 'localhost',
            'dbname' => 'myDB',
            'charset' => 'utf8mb4',
            'username' => 'root',
            'password' => '',
            'port' => 'invalid_port',
            'options' => []
        ];

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid port number');

        $mockConnection->connect($config);
    }

    /**
     * @throws Exception
     */
    public function testConnectWithOutOfRangePortNumber()
    {
        $mockConnection = $this->getMockForAbstractClass(BaseConnection::class);

        $config = [
            'host' => 'localhost',
            'dbname' => 'myDB',
            'charset' => 'utf8mb4',
            'username' => 'root',
            'password' => '',
            'port' => 0,
            'options' => []
        ];

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid port number');

        $mockConnection->connect($config);
    }
}
