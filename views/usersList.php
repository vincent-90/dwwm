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
                    <p class="text-success form">Le compte est bien supprimé !</p>
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
                            <th scope="col">Avatar</th>
                            <th scope="col">Pseudo</th>
                            <th scope="col">Adresse mail</th>
                            <th scope="col">Supprimer</th>
                            <th scope="col">Supprimer modal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usersList as $user) { ?>
                            <tr>
                                <td><img src="../uploads/avatars/<?= $user->avatar ?>" width="150" class="img-fluid"/></td>
                                <td><?= $user->username ?></td>
                                <td><?= $user->mail ?></td>
                                <td><a class="btn btn-amber" href="usersList.php?idDelete=<?= $user->id ?>">Supprimer</a></td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-amber" data-toggle="modal" data-target="#modalDelete">Supprimer</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Supprimer membre</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Etes-vous sûr de vouloir supprimer cet utilisateur ?</p>
                                                    <p>Attention cette action est irréversible.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                                                    <a class="btn btn-amber" href="usersList.php?idDelete=<?= $user->id ?>">Oui</a>
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