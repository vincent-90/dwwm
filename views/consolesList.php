<?php
include '../configuration.php';
include '../controllers/consolesListCtrl.php';
include 'header.php';
?>
<div class="container-fluid pattern">
    <div class="row">
        <div class="text-center col-12">
            <h1 class="title">Liste des consoles</h1>
            <?php
            if (isset($_GET['idDelete'])) {
                if ($isDelete) {
                    ?>
                    <p class="text-success form">La console est bien supprimée !</p>
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
                            <th scope="col">Photo</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Sortie</th>
                            <th scope="col">Détail</th>
                            <?php if(isset($_SESSION['isConnect']) && $_SESSION['id_dwwm_grades'] == 57) { ?>
                            <th scope="col">Effacer</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($consolesList as $console) { ?>
                            <tr>
                                <td><img src="../uploads/consoles/<?= $console->image; ?>" width="150" class="img-fluid"/></td>
                                <td><?= $console->name; ?></td>
                                <td><?= $console->date; ?></td>
                                <td><a class="btn btn-lime" href="consoleDetails.php?id=<?= $console->id; ?>">Détails</a></td>
                                <?php if(isset($_SESSION['isConnect']) && $_SESSION['id_dwwm_grades'] == 57) { ?>
                                <td><a class="btn btn-danger" href="consolesList.php?idDelete=<?= $console->id ?>">Effacer</a></td>
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