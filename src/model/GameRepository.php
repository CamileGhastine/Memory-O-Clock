<?php

namespace Memory\Model;

use PDO;
use Memory\Model\Entity\Game;

class GameRepository extends AbstractRepository
{
    private $db;

    public function __construct()
    {
        $this->db = $this->getDBConnection();
    }

    public function findTopTen()
    {
        $sql = 'SELECT result FROM game ORDER BY result ASC LIMIT 10';
        $request = $this->db->query($sql);
        $request->setFetchMode(PDO::FETCH_CLASS, Game::class);

        $games = $request->fetchAll();

        $request->closeCursor();

        return $games;
    }

    public function findTenth()
    {
        $sql = 'SELECT result FROM game ORDER BY result ASC LIMIT 3,4';
        $request = $this->db->query($sql);
        $request->setFetchMode(PDO::FETCH_CLASS, Game::class);

        $games = $request->fetchAll();

        $request->closeCursor();

        return $games;
    }

    public function add(Game $game)
    {
        $sql = 'INSERT INTO game(result) VALUES (:result)';
        $request= $this->db->prepare($sql);
        $request->execute([
            'result' => $game->getResult()
        ]);
    }
}
