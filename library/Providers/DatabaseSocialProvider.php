<?php

declare(strict_types=1);

namespace Gewaer\Providers;

use Canvas\Providers\DatabaseProvider as CanvasDatabaseProvider;
use function Baka\envValue;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Di\DiInterface;
use PDO;
use Phalcon\Db\Adapter\Pdo\Mysql;

class DatabaseSocialProvider implements ServiceProviderInterface
{
    /**
    * @param DiInterface $container
    */
    public function register(DiInterface $container) : void
    {
        $container->setShared(
            'dbSocial',
            function () {
                $options = [
                    'host' => envValue('DATA_API_SOCIAL_MYSQL_HOST', 'localhost'),
                    'username' => envValue('DATA_API_SOCIAL_MYSQL_USER', 'nanobox'),
                    'password' => envValue('DATA_API_SOCIAL_MYSQL_PASS', ''),
                    'dbname' => envValue('DATA_API_SOCIAL_MYSQL_NAME', 'gonano'),
                    'charset' => 'utf8',
                    "options" => [ PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING ]
                ];

                try {
                    $connection = new Mysql($options);

                    // Set everything to UTF8
                    $connection->execute('SET NAMES utf8mb4', []);
                } catch (PDOException $e) {
                    throw new ServerErrorHttpException($e->getMessage());
                }

                return $connection;
            }
        );
    }
}
