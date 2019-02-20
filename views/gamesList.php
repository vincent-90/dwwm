<?php
include '../models/games.php';
include '../controllers/gamesListCtrl.php';
include 'header.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="text-center col-12">
            <h1>Liste des jeux</h1>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Jaquette</th>
                            <th scope="col">Console</th>
                            <th scope="col">Titre</th>
                            <th scope="col">Synopsis</th>
                            <th scope="col">Date de sortie</th>
                            <th scope="col">Détail</th>
                       
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($gamesList as $game) { ?>
                            <tr>
                                <td><img src="../uploads/games/<?= $game->image; ?>" width="150" /></td>
                                <td><?= $game->name; ?></td>
                                <td><?= $game->title; ?></td>
                                <td><?= $console->summary; ?></td>
                                <td><?= $console->date; ?></td>
                                <td><a class="btn btn-lime" href="gameDetail.php?id=<?= $game->id; ?>">Détails</a></td>
                      
                            </tr>
                        <?php } ?>                 
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<?php include 'footer.php'; ?>