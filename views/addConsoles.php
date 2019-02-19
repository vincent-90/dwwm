<?php
include '../models/consoles.php';
include '../controllers/addConsolesCtrl.php';
include 'header.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="text-center col-12">
            <h1>Ajouter une console</h1>
            
            <?php if ($isSuccess) { ?>
                 <p class="text-success"><?= isset($accountMessage) ? $accountMessage : '' ?></p>
                <p class="text-success">Enregistrement effectué !</p>
                
                <?php
            }
            if ($isError) {
                ?>
                <p class="text-danger"><?= isset($accountMessage) ? $accountMessage : '' ?></p>
                <p class="text-danger">Désolé, le compte n'a pu être créer.</p>
            <?php } ?>
            <p class="text-danger"><?= isset($formError['checkConsole']) ? $formError['checkConsole'] : '' ?></p>
            <form method="POST" action="" enctype="multipart/form-data">
                <fieldset>
                    <legend><strong>Ajouter une console</strong></legend>
                    <div class="form-group">
                        
                        <div class="form-row">             
                            <label for="name" class="col-sm-2 col-form-label">Nom de la console :</label>
                            <div class="col-sm-10">
                                <input name="name" type="text" class="form-control" id="name" placeholder="Nom de la console" value="<?= isset($name) ? $name : '' ?>"/>
                                <p class="text-danger"><?= isset($formError['name']) ? $formError['name'] : '' ?></p>
                            </div>
                        </div>
                        <div class="form-row">             
                            <label for="summary" class="col-sm-2 col-form-label">Description :</label>
                            <div class="col-sm-10">
                                <input name="summary" type="text" class="form-control" id="summary" placeholder="Description" value="<?= isset($summary) ? $summary : '' ?>"/>
                                <p class="text-danger"><?= isset($formError['summary']) ? $formError['summary'] : '' ?></p>
                            </div>
                        </div>
                        <div class="form-row">             
                            <label for="date" class="col-sm-2 col-form-label">Date de sortie (France) :</label>
                            <div class="col-sm-10">
                                <input name="date" type="date" class="form-control" id="date" placeholder="" value=""/>
                                <p class="text-danger"><?= isset($formError['date']) ? $formError['date'] : '' ?></p>
                            </div>
                        </div>
                        <div class="form-row">             
                            <label for="image" class="col-sm-2 col-form-label">Photo :</label>
                            <div class="col-sm-10">
                                <input name="image" type="file" class="form-control" id="image" placeholder="Photo de la console" value="<?= isset($image) ? $image : '' ?>"/>
                                <p class="text-danger"><?= isset($formError['image']) ? $formError['image'] : '' ?></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-12">
                                <input type="submit" value="envoyer" name="submit"/>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>