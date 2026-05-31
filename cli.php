<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/app/Middleware/env_helper.php';

loadEnv(__DIR__ . '/.env');

use Config\Database as DatabaseConfig;
use Core\Database;

$dbConfig = DatabaseConfig::config();

$db = new Database(
    $dbConfig['driver'],
    [
        'host' => $dbConfig['host'],
        'port' => $dbConfig['port'],
    ],
    $dbConfig['username'],
    $dbConfig['password']
);

$sqlFile = file_get_contents(__DIR__ . '/database.sql');

if ($sqlFile === false) {
    die("Could not read database.sql\n");
}

$statements = array_filter(array_map('trim', explode(';', $sqlFile)));

foreach ($statements as $statement) {
    if ($statement === '') {
        continue;
    }

    $db->query($statement);
}

echo "Database schema applied successfully.\n";
