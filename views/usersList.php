<?php
include '../models/users.php';
include '../controllers/usersListCtrl.php';
include 'header.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="text-center col-12">
            <h1>Liste des patients</h1>
            
             <?php
            if (isset($_GET['idDelete'])) {
                if ($isDelete) {
                    ?>
                    <p class="text-success">Le compte est bien supprimé !</p>
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
                            <th scope="col">Pseudo</th>
                            <th scope="col">Adresse mail</th>
                            <th scope="col">Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usersList as $user) { ?>
                            <tr>
                                <td><?= $user->username ?></td>
                                <td><?= $user->mail ?></td>
                                <td><a class="btn blue-gradient btn-lg btn-block" href="usersList.php?idDelete=<?= $user->id ?>">Effacer</a></td>
                            </tr>
                        <?php } ?>                 
                    </tbody>
                </table>
            </div>
            
             </div>
    </div>
</div>
<?php include 'footer.php'; ?>