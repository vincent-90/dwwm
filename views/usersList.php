<?php
include '../configuration.php';
include '../controllers/usersListCtrl.php';
include 'header.php';
?>
<div class="container-fluid pattern">
    <div class="row">
        <div class="text-center col-12">
            <h1 class="title">Liste des membres</h1>
            <?php
            if (isset($_GET['idDelete'])) {
                if ($isDelete) {
                    ?>
                    <p class="text-success window">Le compte est bien supprimé !</p>
                <?php } else { ?>
                    <p class="text-danger window">Echec de la suppression !</p>
                    <?php
                }
            }
            ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Avatar</th>
                            <th scope="col">Pseudo</th>
                            <th scope="col">Adresse mail</th>
                            <th scope="col">Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usersList as $user) { ?>
                            <tr>
                                <td><img src="../uploads/avatars/<?= $user->avatar ?>" width="150" class="img-fluid"/></td>
                                <td><?= $user->username ?></td>
                                <td><?= $user->mail ?></td>
                                <td>
                                    <div><a class="btn btn-danger" href="usersList.php?idDelete=<?= $user->id ?>">Supprimer</a></div>
                                    <div>Attention, cette action est irréversible.</div>
                                </td>
                            </tr>
                        <?php } ?>                 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>