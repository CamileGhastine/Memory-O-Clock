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
        $sql = 'SELECT id, score, playedAt FROM game ORDER BY score ASC LIMIT 100';
        $request = $this->db->query($sql);
        $request->setFetchMode(PDO::FETCH_CLASS, Game::class);

        $games = $request->fetchAll();

        $request->closeCursor();

        return $games;
    }

    public function add(Game $game)
    {
        $sql = 'INSERT INTO game(playedAt, score) VALUES (:date, :score)';
        $request= $this->db->prepare($sql);
        $request->execute([
            'date' => $game->getPlayedAT(),
            'score' => $game->getScore()
        ]);
    }
}
