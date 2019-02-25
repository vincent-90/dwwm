<?php
include '../configuration.php';
include '../controllers/addConsolesCtrl.php';
include 'header.php';
?>
<div class="container-fluid pattern">
    <div class="row">
        <div class="text-center col-12">
            <h1 class="title">Ajouter une console</h1>
            <form method="POST" action="" enctype="multipart/form-data">
                <fieldset class="form">
                    <legend><strong>Proposer une console</strong></legend>
                     <?php if ($isSuccess) { ?>
                <p class="text-success">Enregistrement effectué !</p>
                <?php
            }
            if ($isError) {
                ?>
                <p class="text-danger">Désolé, la console n'a pu être enregistrer.</p>
            <?php } ?>
            <p class="text-danger"><?= isset($formError['checkConsole']) ? $formError['checkConsole'] : '' ?></p>
                    <div class="form-group">
                        <div class="form-row">             
                            <label for="name" class="col-sm-4 col-form-label">Nom de la console :</label>
                            <div class="col-sm-8">
                                <input name="name" type="text" class="form-control" id="name" placeholder="Nom de la console" value="<?= isset($name) ? $name : '' ?>"/>
                                <p class="text-danger"><?= isset($formError['name']) ? $formError['name'] : '' ?></p>
                            </div>
                        </div>
                        <div class="form-row">             
                            <label for="summary" class="col-sm-4 col-form-label">Description :</label>
                            <div class="col-sm-8">
                                <textarea name="summary" type="text" class="form-control" id="summary" placeholder="Description" value="<?= isset($summary) ? $summary : '' ?>"></textarea>
                                <p class="text-danger"><?= isset($formError['summary']) ? $formError['summary'] : '' ?></p>
                            </div>
                        </div>
                        <div class="form-row">             
                            <label for="date" class="col-sm-4 col-form-label">Date de sortie (France) :</label>
                            <div class="col-sm-8">
                                <input name="date" type="date" class="form-control" id="date" value="<?= isset($date) ? $date : '' ?>"/>
                                <p class="text-danger"><?= isset($formError['date']) ? $formError['date'] : '' ?></p>
                            </div>
                        </div>
                        <div class="form-row">             
                            <label for="image" class="col-sm-offset-2 col-sm-4 col-form-label">Photo :</label>
                            <div class="col-sm-offset-2 col-sm-4">
                                <input name="image" type="file" id="image" placeholder="Photo de la console"/>
                                <p class="text-danger"><?= isset($formError['image']) ? $formError['image'] : '' ?></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-12">
                                <input type="submit" value="Envoyer" name="submitConsole" class="btn btn-light-green"/>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>