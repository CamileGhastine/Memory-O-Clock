<div class="frame">

    <p><span id="rules">Règles :</span> Les cartes sont étalées faces cachées sur la table et le joueur retourne deux cartes.
        Si elles sont identiques, les cartes restent face visible, sinon elles sont remises face cachée.
        Le but du jeu est de retourner le plus rapidement possible toutes les cartes avant la fin du compte à rebours.
    </p>
</div>

<p>
    <a role="button" class="btn" href="?page=game">Jouez</a>
</p>

<h2>Classement des leaders &#127942;</h2>

<div>&#129351; &#129352; &#x1F949;</div>
<table>
    <thead>
        <tr>
            <th>Classement</th>
            <th>temps (s)</th>
        </tr>
    </thead>	
    <tbody>
        <?php
        foreach ($games as $rank => $game) {
        ?>
            <tr>
                <td><?= $rank + 1 ?></td>
                <td><?= $game->getResult() ?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>