<?php
/* Un service est une classe dont le rôle est de décharger le contrôleur.
Ainsi, conformément au principe single responsability (S de SOLID),
le contrôleur se contente de contrôler.
C’est une bonne pratique de déporter dans un service la logique métier */

namespace Memory\Service;

use Memory\Model\GameRepository;

/**
 * Service ResultBinder
 * @package Memory\Service
 */
class ResultBinder
{
    /**
     * find the rank of a result
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
