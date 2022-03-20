<?php

namespace Memory\Model;

use PDO;
use PDOException;
use Config\Config;

/**
 * Class AbstractRepository
 * @package Memory\Model
 */
abstract class AbstractRepository
{
    /**
     * Connection to database
     * @return PDO
     */
    protected function getDBConnection(): PDO
    {
        $dbInfos = (new Config())::configDB();

        try {
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ];

            return new PDO(
                'mysql:host=' . $dbInfos['db_host'] . ';dbname=' . $dbInfos['db_name'],
                $dbInfos['db_user'],
                $dbInfos['db_pass'],
                $options
            );
        } catch (PDOException $e) {
            print "Erreur: " . $e->getMessage() . " !!!<br/>";
            die();
        }
    }
}
