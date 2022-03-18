<table>
    <thead>
        <tr>
            <th colspan="3">Top 10 des meilleurs temps</th>
        </tr>
        <tr>
            <th>Classement</th>
            <th>Score</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($games as $rank => $game) {
        ?>
            <tr>
                <td><?= $rank + 1 ?></td>
                <td><?= $game->getScore() ?></td>
                <td><?= $game->getPlayedAt() ?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>


<p><a href="?page=game">jouez</a></p>