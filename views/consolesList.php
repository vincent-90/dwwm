<?php
include '../models/consoles.php';
include '../controllers/consolesListCtrl.php';
include 'header.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="text-center col-12">
            <h1>Liste des consoles</h1>
            
            <?php
            if (isset($_GET['idDelete'])) {
                if ($isDelete) {
                    ?>
                    <p class="text-success">La console est bien supprimée !</p>
                <?php } else { ?>
                    <p class="text-danger">Echec de la suppression !</p>
                    <?php
                }
            }
            ?>
            
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Photo</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Description</th>
                            <th scope="col">Date de sortie</th>
                            <th scope="col">Détail</th>
                            <?php if(isset($_SESSION['isConnect']) && $_SESSION['id_dwwm_grades'] == 1) { ?>
                            <th scope="col">Effacer</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($consolesList as $console) { ?>
                            <tr>
                                <td><?= $console->image; ?></td>
                                <td><img src="<?= $console->image; ?>" width="150" /></td>
                                <td><?= $console->name; ?></td>
                                <td><?= $console->summary; ?></td>
                                <td><?= $console->date; ?></td>
                                <td><a class="btn blue-gradient btn-lg btn-block" href="consoleDetail.php?id=<?= $console->id; ?>">Détails</a></td>
                                
                                <?php if(isset($_SESSION['isConnect']) && $_SESSION['id_dwwm_grades'] == 1) { ?>
                                <td><a class="btn blue-gradient btn-lg btn-block" href="consolesList.php?idDelete=<?= $console->id ?>">Effacer</a></td>
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