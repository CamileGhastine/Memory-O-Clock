# Jeu memory - test technique O'Clock

## Les commentaires dans le code
- Les commentaires en anglais sont les commentaires habituels qu'on trouve dans un code pour en faciliter sa compréhension et son utilisation.
- Les commentaires en français sont des commentaires additionnels destonés aux apprenants à des fins pédagogiques. 

## Versions
- PHP version : 8.0.11
- serveur de base de données : 10.4.21-MariaDB
- MySQL : 8.0.11 
- Composer : 2.1.8

## Installation

1) Ouvrir la console et choisir un dossier pour installer le projet

2) Télécharger le projet avec la commande git :
`git clone https://github.com/CamileGhastine/ApiOC7.git`

3) Aller dans le repertoire du projet avec la commande :
`cd memory`

4) Installer composer et ses dépendences avec la commande :
`composer install`

5) Dans le repertoire Config, renommer le fichier "config-copy.php" en "config.php".

6) Dans le fichier nouvellement nommé "config.php" configurer : 
	- Vos informations de connection à la base de données, notamment db_user et db_pass

7) Créer une base de donnée et les fixtures avec la commande :
`composer createDB`

## Création de la base de données avec PHPmyAdmin

1) Ouvrir PHPMyAdmin.

2) Cliquer sur "Nouvelle base de données".

3) Entrer "memory" pour le nom de la base de données et cliquer sur "créer".

4) Cliquer sur l'onglet 'Importer".

5) Cliquer sur parcourir et choisir le fichier "game" dans le repertoire "database".

6) Cliquer sur "Exécuter" pour créer votre table.

## Lancement de l'application

1) Ouvrir un terminale à la racine du projet.

2) Lancer le serveur interne de PHP avec la commande :
`php -S localhost:8000 -t public/`

3) Ouvrir un navigateur à l'adresse :
`http://localhost:8000`

4) Profiter du jeu !!!