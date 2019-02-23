<?php
include '../configuration.php';
include '../controllers/usersListCtrl.php';
include 'header.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="text-center col-12">
            <h1>Liste des membres</h1>
            <?php
            if (isset($_POST['idDelete'])) {
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
                            <th scope="col">delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usersList as $user) { ?>
                            <tr>
                                <td><?= $user->username ?></td>
                                <td><?= $user->mail ?></td>
                                <td><a class="btn btn-amber" href="usersList.php?idDelete=<?= $user->id ?>">Effacer</a></td>
                                
                                <td>
                                    <!-- Button trigger modal -->
                                    <button id="delete<?= $user->id ?>"type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal">delete</button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">supprimer l'user ?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="">
                                                        <input name="delete" type="hidden" value="<?= $user->id ?>"/>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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