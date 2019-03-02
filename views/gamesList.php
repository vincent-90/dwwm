<?php
include '../configuration.php';
include '../controllers/gamesListCtrl.php';
include 'header.php';
?>
<div class="container-fluid pattern">
    <div class="row">
        <div class="text-center col-12">
            <h1 class="title">Liste des jeux</h1>
<?php
            if (isset($_GET['idDelete'])) {
                if ($isDelete) {
                    ?>
                    <p class="text-success form">Le jeu est bien supprimé !</p>
                <?php } else { ?>
                    <p class="text-danger form">Echec de la suppression !</p>
                    <?php
                }
            }
            ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Jaquette</th>
                            <th scope="col">Console</th>
                            <th scope="col">Titre</th>
                            <th scope="col">Sortie</th>
                            <th scope="col">Détail</th>
                            <?php if(isset($_SESSION['isConnect']) && $_SESSION['id_dwwm_grades'] == 57) { ?>
                            <th scope="col">Effacer</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($gamesList as $game) { ?>
                            <tr>
                                <td><img src="../uploads/games/<?= $game->image; ?>" width="150" class="img-fluid"/></td>
                                <td><?= $game->name; ?></td>
                                <td><?= $game->title; ?></td>
                                <td><?= $game->date; ?></td>
                                <td><a class="btn btn-lime" href="gameDetails.php?id=<?= $game->id; ?>">Détails</a></td>
                      <?php if(isset($_SESSION['isConnect']) && $_SESSION['id_dwwm_grades'] == 57) { ?>
                                <td><a class="btn btn-danger" href="gamesList.php?idDelete=<?= $game->id ?>">Effacer</a></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>                 
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<?php include 'footer.php'; ?>