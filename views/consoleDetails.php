<?php
include '../configuration.php';
include '../controllers/consoleDetailsCtrl.php';
include 'header.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="text-center col-12">
            <h1>Détails de la console :</h1>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Photo</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Description</th>
                            <th scope="col">Date de sortie</th>
                        </tr>
                    </thead>
                    <?php if ($consoleDetail) { ?>
                        <tbody>
                            <tr>
                                <td><img src="../uploads/consoles/<?= $consoles->image; ?>" width="150" /></td>
                                <td><?= $consoles->name ?></td>
                                <td><?= $consoles->summary ?></td>
                                <td><?= $consoles->date ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
                <div>La console n'a pas été trouvée !</div>
            <?php } ?>
            <h2>Modifications</h2>
            <form method="POST" action="" enctype="multipart/form-data">
                <fieldset>
                    <legend><strong>Changer de photo</strong></legend>
                    <p class="text-success"><?= isset($imageMessage) ? $imageMessage : '' ?></p>
                    <p class="text-danger"><?= isset($formError['image']) ? $formError['image'] : '' ?></p>
                    <div class="form-group">
                        <div class="form-row">             
                            <label for="image" class="col-sm-2 col-form-label">Photo :</label>
                            <div class="col-sm-10">
                                <input name="image" type="file" class="form-control" id="image"/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-12">
                                <input type="submit" value="Changer d'image" name="submitImage"/>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="POST" action="consoleDetails.php?id=<?= $consoles->id ?>" enctype="multipart/form-data">
                <fieldset>
                    <legend><strong>Modifier les informations</strong></legend>
                    <?php if ($isSuccess) { ?>
                        <p class="text-success"><?= isset($updateMessage) ? $updateMessage : '' ?></p>
                        <?php
                    }
                    if ($isError) {
                        ?>
                        <p class="text-danger"><?= isset($updateMessage) ? $updateMessage : '' ?></p>
                    <?php } ?>
                    <div class="form-group">
                        <div class="form-row">             
                            <label for="name" class="col-sm-2 col-form-label">Nom de la console :</label>
                            <div class="col-sm-10">
                                <input name="name" type="text" class="form-control" id="name" placeholder="<?= $consoles->name; ?>" value="<?= $consoles->name; ?>"/>
                                <p class="text-danger"><?= isset($formError['name']) ? $formError['name'] : '' ?></p>
                            </div>
                        </div>
                        <div class="form-row">             
                            <label for="summary" class="col-sm-2 col-form-label">Description :</label>
                            <div class="col-sm-10">
                                <textarea name="summary" type="text" class="form-control" id="summary" placeholder="<?= $consoles->summary; ?>"></textarea>
                                <p class="text-danger"><?= isset($formError['summary']) ? $formError['summary'] : '' ?></p>
                            </div>
                        </div>
                        <div class="form-row">             
                            <label for="date" class="col-sm-2 col-form-label">Date de sortie (France) :</label>
                            <div class="col-sm-10">
                                <input name="date" type="date" class="form-control" id="date" placeholder="<?= $consoles->date; ?>" value="<?= $consoles->dateUS; ?>"/>
                                <p class="text-danger"><?= isset($formError['date']) ? $formError['date'] : '' ?></p>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-sm-12">
                                <input type="submit" value="Modifier" name="submit"/>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
            <p><a href="consolesList.php">Retour</a> à la liste des consoles.</p>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>