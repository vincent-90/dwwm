<?php
include '../configuration.php';
include '../controllers/consoleDetailsCtrl.php';
include 'header.php';
?>
<div class="container-fluid pattern">
    <div class="row">
        <div class="text-center col-12">
            <h1 class="title">Détails de la console</h1>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Photo</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Date de sortie</th>
                        </tr>
                    </thead>
                    <?php if ($consoleDetail) { ?>
                        <tbody>
                            <tr>
                                <td><img src="../uploads/consoles/<?= $consoles->image; ?>" width="250" class="img-fluid"/></td>
                                <td><?= $consoles->name ?></td>
                                <td><?= $consoles->date ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form">
                    <h2>Description</h2>
                    <p><?= $consoles->summary ?></p>
                </div>
            <?php } else { ?>
                <div>La console n'a pas été trouvée !</div>
            <?php } ?>
            <?php if (isset($_SESSION['isConnect'])) { ?>
                <h2 class="title">Modifications</h2>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-7">
                                <form method="POST" action="consoleDetails.php?id=<?= $consoles->id ?>">
                                    <fieldset class="form">
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
                                                <label for="name" class="col-sm-4 col-form-label">Nom de la console :</label>
                                                <div class="col-sm-8">
                                                    <input name="name" type="text" class="form-control" id="name" placeholder="<?= $consoles->name; ?>" value="<?= $consoles->name; ?>"/>
                                                    <p class="text-danger"><?= isset($formError['name']) ? $formError['name'] : '' ?></p>
                                                </div>
                                            </div>
                                            <div class="form-row">             
                                                <label for="summary" class="col-sm-4 col-form-label">Description :</label>
                                                <div class="col-sm-8">
                                                    <textarea name="summary" type="text" class="form-control" id="summary" placeholder="<?= $consoles->summary; ?>"></textarea>
                                                    <p class="text-danger"><?= isset($formError['summary']) ? $formError['summary'] : '' ?></p>
                                                </div>
                                            </div>
                                            <div class="form-row">             
                                                <label for="date" class="col-sm-4 col-form-label">Date de sortie :</label>
                                                <div class="col-sm-8">
                                                    <input name="date" type="date" class="form-control" id="date" placeholder="<?= $consoles->date; ?>" value="<?= $consoles->dateUS; ?>"/>
                                                    <p class="text-danger"><?= isset($formError['date']) ? $formError['date'] : '' ?></p>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-sm-12">
                                                    <input type="submit" value="Modifier" name="submit" class="btn btn-light-green"/>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form method="POST" action="" enctype="multipart/form-data">
                                            <fieldset class="form">
                                                <legend><strong>Changer de photo</strong></legend>
                                                <p class="text-success"><?= isset($imageMessage) ? $imageMessage : '' ?></p>
                                                <p class="text-danger"><?= isset($formError['image']) ? $formError['image'] : '' ?></p>
                                                <div class="form-group">
                                                    <div class="form-row justify-content-end">   
                                                        <div class="col-sm-12">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">Photo</span>
                                                                </div>
                                                                <div class="custom-file">
                                                                    <label class="custom-file-label" for="image"></label>
                                                                    <input name="image" type="file" class="custom-file-input" id="image"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-sm-12">
                                                            <input type="submit" value="Changer d'image" name="submitImage" class="btn btn-light-green"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                    <?php if ($_SESSION['id_dwwm_grades'] == 1) { ?>
                                        <div class="col-md-12">
                                            <h2 class="title">Suppression</h2>
                                            <div class="form">
                                                <div>Attention, cette action est irréversible.</div>
                                                <a class="btn btn-danger" href="consoleDetails.php?idDelete=<?= $consoles->id; ?>">Effacer</a> 
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <a href="consolesList.php" class="btn btn-lg btn-dark-green">Retour à la liste des consoles.</a>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>