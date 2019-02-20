<?php
include '../models/consoles.php';
include '../controllers/consoleDetailCtrl.php';
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
                            <th scope="col">Summary</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <?php if ($isConsole) { ?>
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
            <h2>Modifier les informations</h2>
            <?php if ($isSuccess) { ?>
                <p class="text-success">Modifications enregistrées !</p>
                <?php
            }
            if ($isError) {
                ?>
                <p class="text-danger">Désolé, les modifications n'ont pu être enregistrées.</p>
            <?php } ?>
            <form method="POST" action="consoleDetail.php?id=<?= $consoles->id ?>" enctype="multipart/form-data">
                <fieldset>
                    <legend><strong>Modifications</strong></legend>
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
                                <input name="summary" type="text" class="form-control" id="summary" placeholder="<?= $consoles->summary; ?>" value="<?= $consoles->summary; ?>"/>
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
                            <label for="image" class="col-sm-2 col-form-label">Photo :</label>
                            <div class="col-sm-10">
                                <input name="image" type="file" class="form-control" id="image" placeholder="<?= $consoles->image; ?>" value="<?= $consoles->image; ?>"/>
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
            <p><a href="consolesList.php">Retour</a> à la liste des consoles.</p>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>