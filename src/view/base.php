<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Jeu memory</title>
</head>

<!-- cette page sert de base à toutes les pages de notre site -->
<body>
    <!-- On y inclut un header et une navbar -->
    <?php require 'shared/_header.php'; ?>
    <?php require 'shared/_nav.php'; ?>

    <!-- On y injecte la vue adéquate déterminée par le contrôleur -->
    <div id="baseWrapper">
        <h1>&#127167; Memory &#127167;</h1>
        <?= $content ?>
    </div>

</body>

</html>