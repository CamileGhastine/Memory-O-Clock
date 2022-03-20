<?php

namespace Memory\Model;

use PDO;
use Memory\Model\Entity\Game;

/**
 * Class GameRepository
 * @package Memory\Model
 */
class GameRepository extends AbstractRepository
{
    /**
     * @var PDO
     */
    private $db;

    /**
     * GameRepository conctructor
     * @return void
     */
    public function __construct()
    {
        $this->db = $this->getDBConnection();
    }

    /**
     * Find the 10th best time
     * @return array
     */
    public function findTopTen()
    {
        $sql = 'SELECT result FROM game ORDER BY result ASC LIMIT 10';
        $request = $this->db->query($sql);
        $request->setFetchMode(PDO::FETCH_CLASS, Game::class);

        $games = $request->fetchAll();

        $request->closeCursor();

        return $games;
    }

    /**
     * find all the result
     * @return array
     */
    public function findAll()
    {
        $sql = 'SELECT result FROM game ORDER BY result ASC';
        $request = $this->db->query($sql);
        $request->setFetchMode(PDO::FETCH_CLASS, Game::class);

        $games = $request->fetchAll();

        $request->closeCursor();

        return $games;
    }

    /**
     * Save the result in the database
     * @param Game $game
     * @return void
     */
    public function add(Game $game)
    {
        $sql = 'INSERT INTO game(result) VALUES (:result)';
        $request = $this->db->prepare($sql);
        $request->execute([
            'result' => $game->getResult()
        ]);
    }
}
