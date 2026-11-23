<?php
namespace App\Database;

class Mysql
{
    public function connectBDD(): \PDO
    {
        $file = dirname(__DIR__, 2) . '/.env';

        if (!file_exists($file)) {
            throw new \Exception('Le fichier .env est introuvable.');
        }

        $config = parse_ini_file($file);

        if ($config === false) {
            throw new \Exception('Impossible de lire le fichier .env.');
        }

        $host = $config['DB_HOST'] ?? '127.0.0.1';
        $port = $config['DB_PORT'] ?? '3306';
        $name = $config['DB_NAME'] ?? 'last_roll';
        $user = $config['DB_USER'] ?? 'root';
        $password = $config['DB_PASSWORD'] ?? '';

        $dsn = "mysql:host=$host;port=$port;dbname=$name;charset=utf8mb4";

        return new \PDO($dsn, $user, $password, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);
    }
}
