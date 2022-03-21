<?php
/* Le modèle s'occupe exclusivement des données.
Il peut communiquer avec une base de données (ici en sql) pour écupérer les données.
(Mais les données peuvent aussi être contenues dans des variables ou générer par des calculs.)
La base de données (bdd) interprète les requêtes sql envoyées par le serveur.
Ces requêtes sont de 4 types :
- C : create pour créer de nouvelles données dans la bdd (INSERT INTO).
- R : read pour récupérer des données existantes dans la bdd (SELECT).
- U : update pour modifier des données existantes dans la bdd (UPDATE).
- D : delete pour supprimer des données existantes dans la bdd (DELETE). 
*/

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
     * Find the 10th best time
     * @return array
     */
    public function findTopTen()
    {
        // Ecriture de la requète en langage sql (R du CRUD).
        $sql = 'SELECT result FROM game ORDER BY result ASC LIMIT 10';
        // La méthode query() de la classe PDO prépare et execute la requète sql.
        $request = $this->db->query($sql);
        // setFetchMode() permet de définir le mode de récupératin des données.
        // Ici on souhaite que chaque ligne de la bdd permette de construire un objets Game.
        $request->setFetchMode(PDO::FETCH_CLASS, Game::class);
        // FetchAll() renvoie un tableau contenant tous les objets Game.
        $games = $request->fetchAll();
        // closeCursor() libère la connexion au serveur.
        $request->closeCursor();

        // Enfin on retourne le tableau d'objets au contrôleur.
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
        // Ecriture de la requète en langage sql (C du CRUD).
        // ici on fait ce qu'on appelle une requète préparée.
        // En effet, le "résult" n'est pas directement introduit dans la requète sql.
        // A la place du "résult", on va placer un marqueur nominatif ":result" dans la requète.
        $sql = 'INSERT INTO game(result) VALUES (:result)';
        // La méthode prepare() de la classe PDO prépare la requète sql sans l'éxecuter.
        $request = $this->db->prepare($sql);
        // execute() execute la requète en injectant seulement maintenant la valeur du résultat.
        $request->execute([
            'result' => $game->getResult()
        ]);
        /*
        - Pourquoi réalise-t-on une requète préparée ?
        "Never trust user's input".
        Il ne faut jamais avoir confiance aux données provenant des utilisateurs.
        Si le résultat qu'on souhaite entrer en bdd contenait du code sql malveillant,
        sans requète préparée, on s'exposerait à une faille SQLi (ou injection SQL).
        PDO nous permet de nous prémunir de l'injection SQL avec les requètes préparées.
        La requète préparée permet de transformer le code sql malveillant en code inoffensif.

        - Quand faire une requète préparée ?
        On réalise une requète préparée pour TOUTES les requètes contenant des données entrées par l'utilisateur.
        Dans notre exemple, le resultat du memory n'est pas entré par l'utilisateur.
        Ce résultat est calculé par le code javascript et envoyé en POST au serveur.
        Néanmoins, il n'est pas très compliqué d'envoyer une "fausse" requète POST 
        et donc d'y injecter un résultat contentant du code sql malveillant.
        C'est pour cela, qu'ici une requète préparée est nécéssaire.
        */
    }
}
