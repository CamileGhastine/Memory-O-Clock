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
     * @var PDO
     */
    protected $db;

    /**
     * AbstractRepository conctructor
     * @return void
     */
    public function __construct()
    {
        $this->db = $this->getDBConnection();
    }
    
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
            
            // PDO est une interface qui permet d'intéroger une base de données.
            // De manière caricaturale, on peut dire qu'ici on retourne une connexion à la base de données.
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
