[![codecov](https://codecov.io/gh/benanamen/perfect-database/branch/master/graph/badge.svg?token=USDDdj2mU0)](https://codecov.io/gh/benanamen/perfect-database)

[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-database&metric=coverage)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-database)
[![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-database&metric=sqale_rating)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-database)
[![Code Smells](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-database&metric=code_smells)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-database)
[![Technical Debt](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-database&metric=sqale_index)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-database)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-database&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-database)
[![Reliability Rating](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-database&metric=reliability_rating)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-database)
[![Duplicated Lines (%)](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-database&metric=duplicated_lines_density)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-database)
[![Vulnerabilities](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-database&metric=vulnerabilities)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-database)
[![Bugs](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-database&metric=bugs)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-database)
[![Security Rating](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-database&metric=security_rating)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-database)



# Introduction:
These Database Connection Classes are designed to establish a connection with SQLite, MSSQL, Postgres, MongoDB and MySQL databases. These classes provide a common interface for connecting to different databases using PHP Data Objects (PDO) extension This end user documentation and usage instructions will help you to configure and use the SQLiteConnection and MysqlConnection classes in your PHP project.

## Installation

You can install the package using Composer. Run the following command in your project directory:

```bash
composer require krubio/perfect-database
```

This will download the package and its dependencies and add the package to your `composer.json` file.

## Usage

Once you have installed the package, you can use the SqliteConnection and MysqlConnection classes by importing them into your code and creating instances of them. Here is an example:

```php
<?php

require_once 'vendor/autoload.php';

use PerfectApp\Database\SqliteConnection;
use PerfectApp\Database\MysqlConnection;

    // SQLite configuration
$config = [
    'path' => 'path/to/database/file',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ],
];

// Create a SQLite connection
$sqliteConnection = new SqliteConnection();
$pdo = $sqliteConnection->connect($config);

// MySQL configuration
$config = [
    'host' => 'localhost',
    'port' => 3306,
    'dbname' => 'my_database',
    'charset' => 'utf8mb4',
    'username' => 'my_username',
    'password' => 'my_password',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ],
];

// Create a MySQL connection
$mysqlConnection = new MysqlConnection();
$pdo = $mysqlConnection->connect($config);
```

Note that the `vendor/autoload.php` file is required to load the classes from the package using Composer's autoloading feature. If you're not using Composer, you'll need to manually include the files for the classes you want to use.

That's it! You can now use the PDO object returned by the `connect` method to interact with your database.

Example:

```php
$stmt = $pdo->prepare("SELECT * FROM users WHERE id=:id");
$stmt->bindValue(':id', 1, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
```

## Configuration:
To establish a connection with a database using these classes, you need to provide a configuration array with the required parameters. The configuration array must have the following keys:

For SqliteConnection:
* 'path': The path to the SQLite database file.
* 'options': An array of PDO options. (optional)

For MysqlConnection:
* 'host': The MySQL server hostname or IP address.
* 'port': The MySQL server port number.
* 'dbname': The name of the MySQL database.
* 'charset': The character set to use for the connection.
* 'username': The MySQL username.
* 'password': The MySQL password.
* 'options': An array of PDO options. (optional)

Note: The configuration array must contain all the required keys. Otherwise, an InvalidArgumentException will be thrown.