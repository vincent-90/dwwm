<?php
include '../configuration.php';
include '../controllers/addGamesCtrl.php';
include 'header.php';
?>
<div class="container-fluid pattern">
    <div class="row">
        <div class="text-center col-12">
            <h1 class="title">Ajouter un jeu</h1>
            <form method="POST" action="addGames.php" enctype="multipart/form-data">
                <fieldset class="window">
                    <legend><strong>Proposer un jeu</strong></legend>
                    <?php if ($isSuccess) { ?>
                        <p class="text-success">Enregistrement effectué !</p>
                        <?php
                    }
                    if ($isError) {
                        ?>
                        <p class="text-danger">Désolé, le jeu n'a pu être enregistrer.</p>
                    <?php } ?>
                    <p class="text-danger"><?= isset($formError['checkGame']) ? $formError['checkGame'] : '' ?></p>
                    <div class="form-group">
                        <div class="form-row">             
                            <label for="title" class="col-sm-3 col-form-label">Titre du jeu :</label>
                            <div class="col-sm-9">
                                <input name="title" type="text" class="form-control" id="title" placeholder="Titre du jeu" value="<?= isset($title) ? $title : '' ?>"/>
                                <p class="text-danger"><?= isset($formError['title']) ? $formError['title'] : '' ?></p>
                            </div>
                        </div>
                        <div class="form-row">             
                            <label for="summary" class="col-sm-3 col-form-label">Description :</label>
                            <div class="col-sm-9">
                                <textarea name="summary" class="form-control" id="summary" placeholder="Résumé du jeu"></textarea>
                                <p class="text-danger"><?= isset($formError['summary']) ? $formError['summary'] : '' ?></p>
                            </div>
                        </div>
                        <div class="form-row">             
                            <label for="date" class="col-sm-3 col-form-label">Date de sortie :</label>
                            <div class="col-sm-9">
                                <input name="date" type="date" class="form-control" id="date" value="<?= isset($date) ? $date : '' ?>"/>
                                <p class="text-danger"><?= isset($formError['date']) ? $formError['date'] : '' ?></p>
                            </div>
                        </div>
                        <div class="form-row justify-content-end">   
                            <div class="col-sm-offset-3 col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Jaquette</span>
                                    </div>
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="image"></label>
                                        <input name="image" type="file" class="custom-file-input" id="image"/>
                                    </div>
                                </div>
                                <p class="text-danger"><?= isset($formError['image']) ? $formError['image'] : '' ?></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <label for="idConsole" class="col-sm-3 col-form-label">Choisir une console : </label>
                            <div class="col-sm-6">
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
                                <input type="submit" value="Envoyer" name="submitGame" class="btn btn-light-green"/>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>