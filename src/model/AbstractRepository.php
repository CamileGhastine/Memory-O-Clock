<?php

namespace Memory\Model;

use PDO;
use PDOException;

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
        try {
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ];
            
            return new PDO('mysql:host=localhost;dbname=memory', 'root', '', $options);
        } catch (PDOException $e) {
            print "Erreur: " . $e->getMessage() . " !!!<br/>";
            die();
        }
    }
}
