<?php
include '../configuration.php';
include '../controllers/commentDetailsCtrl.php';
include 'header.php';
?>
<div class="container-fluid pattern">
    <div class="row">
        <div class="text-center col-12">
            <h1 class="title">Détails du commentaire</h1>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">id comment</th>
                            <th scope="col">text</th>
                            <th scope="col">Datehour</th>
                            <th scope="col">id auth</th>
                        </tr>
                    </thead>
                    <?php if ($commentDetail) { ?>
                        <tbody>
                            <tr>
                                <td><?= $comments->id ?></td>
                                <td><?= $comments->text ?></td>
                                <td><?= $comments->date ?><?= $comments->hour ?></td>
                                <td><?= $comments->id_dwwm_consoles ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php if (isset($_SESSION['isConnect']) && $_SESSION['id'] == $comments->id) { ?>
            <div class="row">
                <div class="col-md-9">
                
            
                <form method="POST" action="">
                    <fieldset class="window">
                        <legend><strong>Editer mon commentaire</strong></legend>
                        <?php if ($isSuccess) { ?>
                            <p class="text-success">Modifications enregistrées !</p>
                            <?php
                        }
                        if ($isError) {
                            ?>
                            <p class="text-danger">Désolé, les modifications n'ont pu être enregistrées !</p>
                        <?php } ?>
                        <div class="form-group">
                            <div class="form-row"> 
                                <div class="col-md-10">
                                    <textarea name="updateText" type="text" class="form-control" id="updateText" placeholder="Modifier votre commentaire"></textarea>
                                    <p class="text-danger"><?= isset($formError['updateText']) ? $formError['updateText'] : '' ?></p>
                                </div>
                                <div class="col-md-2">
                                    <input type="submit" value="Modifier" name="submitUpdateComment" class="btn btn-light-green"/>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
                </div>
                <div class="col-md-3">
                    <h2 class="subtitle">Suppression</h2>
                    <div class="window">
                        <div>Attention, cette action est irréversible.</div>
                        <a class="btn btn-danger" href="commentDetails.php?idDelete=<?= $comments->id; ?>">Effacer</a> 
                    </div>
                </div>
            </div>
            <?php } ?>
        <?php } else { ?>
            <div class="window">Commentaire non trouvé !</div>
        <?php } ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>