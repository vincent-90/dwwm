<?php
include '../models/consoles.php';
include '../models/games.php';
include '../controllers/addGamesCtrl.php';
include 'header.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="text-center col-12">
            <h1>Ajouter un jeu</h1>
            <?php if ($isSuccess) { ?>
                <p class="text-success">Enregistrement effectué !</p>
                <?php
            }
            if ($isError) {
                ?>
                <p class="text-danger">Désolé, le jeu n'a pu être enregistrer.</p>
            <?php } ?>
            <p class="text-danger"><?= isset($formError['checkGame']) ? $formError['checkGame'] : '' ?></p>
            <form method="POST" action="" enctype="multipart/form-data">
                <fieldset>
                    <legend><strong>Proposer un jeu</strong></legend>
                    <div class="form-group">
                        <div class="form-row">             
                            <label for="title" class="col-sm-2 col-form-label">Titre :</label>
                            <div class="col-sm-10">
                                <input name="title" type="text" class="form-control" id="title" placeholder="Titre du jeu" value="<?= isset($title) ? $title : '' ?>"/>
                                <p class="text-danger"><?= isset($formError['title']) ? $formError['title'] : '' ?></p>
                            </div>
                        </div>
                        <div class="form-row">             
                            <label for="summary" class="col-sm-2 col-form-label">Synopsis :</label>
                            <div class="col-sm-10">
                                <input name="summary" type="text" class="form-control" id="summary" placeholder="Résumé du jeu" value="<?= isset($summary) ? $summary : '' ?>"/>
                                <p class="text-danger"><?= isset($formError['summary']) ? $formError['summary'] : '' ?></p>
                            </div>
                        </div>
                        <div class="form-row">             
                            <label for="date" class="col-sm-2 col-form-label">Date de sortie (France) :</label>
                            <div class="col-sm-10">
                                <input name="date" type="date" class="form-control" id="date" />
                                <p class="text-danger"><?= isset($formError['date']) ? $formError['date'] : '' ?></p>
                            </div>
                        </div>
                        <div class="form-row">             
                            <label for="image" class="col-sm-2 col-form-label">Jaquette :</label>
                            <div class="col-sm-10">
                                <input name="image" type="file" class="form-control" id="image" placeholder="Jaquette du jeu" value="<?= isset($image) ? $image : '' ?>"/>
                                <p class="text-danger"><?= isset($formError['image']) ? $formError['image'] : '' ?></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <label for="idConsole" class="col-sm-offset-2 col-sm-4 col-form-label">Choisir une console : </label>
                            <div class="col-sm-offset-2 col-sm-4">
                                <select name="idConsole">
                                    <?php foreach ($consolesList as $console) { ?>
                                        <option value="<?= $console->id ?>"><?= $console->name ?></option>
                                    <?php } ?>
                                </select>
                                <p class="text-danger"><?= isset($formError['idConsole']) ? $formError['idConsole'] : '' ?></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-12">
                                <input type="submit" value="Envoyer" name="submitGame"/>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>