
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