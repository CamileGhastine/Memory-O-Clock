<table>
    <thead>
        <tr>
            <th colspan="3">Tableau des leaders</th>
        </tr>
        <tr>
            <th>Classement</th>
            <th>temps</th>
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


<p><a href="?page=game">jouez</a></p>