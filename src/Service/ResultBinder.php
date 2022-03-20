<?php

namespace Memory\Service;

use Memory\Model\GameRepository;

/**
 * Service ResultBinder
 * @package Memory\Service
 */
class ResultBinder
{
    /**
     * Undocumented function
     *
     * @param float $result
     * @param GameRepository $gameRepository
     * @return int
     */
    public function findRank(float $result, GameRepository $gameRepository)
    {
        $games = $gameRepository->findAll();

        foreach ($games as $index => $game) {
            if ($game->getResult() >= $result) {
                return $index;
            }
        }
    }
}
