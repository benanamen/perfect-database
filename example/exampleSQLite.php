<?php

use PerfectApp\Database\SqliteConnection;

require '../vendor/autoload.php';

$config = require './dbConfig.php';

//Options: dev-mysql,  prod-mysql, sqlite, postgresql
const DB_CONNECTION = 'sqlite';

$pdo = (new SqliteConnection())->connect($config[DB_CONNECTION]);

$sql = "SELECT * FROM users";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
var_dump($result);
