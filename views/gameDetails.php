<?php
include '../configuration.php';
include '../controllers/gameDetailsCtrl.php';
include 'header.php';
?>
<div class="container-fluid pattern">
    <div class="row">
        <div class="text-center col-12">
            <h1 class="title">Détails du jeu</h1>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Jaquette</th>
                            <th scope="col">Console</th>
                            <th scope="col">Titre</th>
                            <th scope="col">Date de sortie</th>
                        </tr>
                    </thead>
                    <?php if ($gameDetail) { ?>
                        <tbody>
                            <tr>
                                <td><img src="../uploads/games/<?= $games->image; ?>" width="250" class="img-fluid"/></td>
                                <td><?= $games->name ?></td>
                                <td><?= $games->title ?></td>
                                <td><?= $games->date ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form">
                    <h2>Description</h2>
                    <p><?= $games->summary ?></p>
                </div>
            <?php } else { ?>
                <div>Le jeu n'a pas été trouvé !</div>
            <?php } ?>
            <?php if (isset($_SESSION['isConnect'])) { ?>
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title">Modifications</h2>
                        <div class="row">
                            <div class="col-md-7">
                                <form method="POST" action="gameDetails.php?id=<?= $games->id ?>">
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
                                                <label for="title" class="col-sm-4 col-form-label">Titre :</label>
                                                <div class="col-sm-8">
                                                    <input name="title" type="text" class="form-control" id="title" placeholder="<?= $games->title; ?>" value="<?= $games->title; ?>"/>
                                                    <p class="text-danger"><?= isset($formError['title']) ? $formError['title'] : '' ?></p>
                                                </div>
                                            </div>
                                            <div class="form-row">             
                                                <label for="summary" class="col-sm-4 col-form-label">Description :</label>
                                                <div class="col-sm-8">
                                                    <textarea name="summary" type="text" class="form-control" id="summary" placeholder="<?= $games->summary; ?>" value="<?= $games->summary; ?>"></textarea>
                                                    <p class="text-danger"><?= isset($formError['summary']) ? $formError['summary'] : '' ?></p>
                                                </div>
                                            </div>
                                            <div class="form-row">             
                                                <label for="date" class="col-sm-4 col-form-label">Date de sortie (France) :</label>
                                                <div class="col-sm-8">
                                                    <input name="date" type="date" class="form-control" id="date" placeholder="<?= $games->date; ?>" value="<?= $games->dateUS; ?>"/>
                                                    <p class="text-danger"><?= isset($formError['date']) ? $formError['date'] : '' ?></p>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <label for="idConsole" class="col-sm-4 col-form-label">Choisir une console : </label>
                                                <div class="col-sm-8">
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
                                                    <input type="submit" value="Modifier" name="submitGame" class="btn btn-light-green"/>
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
                                                <legend><strong>Changer de jaquette</strong></legend>
                                                <p class="text-success"><?= isset($imageMessage) ? $imageMessage : '' ?></p>
                                                <p class="text-danger"><?= isset($formError['image']) ? $formError['image'] : '' ?></p>
                                                <div class="form-group">
                                                    <div class="form-row justify-content-end">   
                                                        <div class="col-sm-12">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">Jaquette</span>
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
                                    <?php if ($_SESSION['id_dwwm_grades'] == 57) { ?>
                                        <div class="col-md-12">
                                            <h2 class="title">Suppression</h2>
                                            <div class="form">
                                                <div>Attention, cette action est irréversible.</div>
                                                <a class="btn btn-danger" href="gameDetails.php?idDelete=<?= $games->id; ?>">Effacer</a> 
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <a href="gamesList.php" class="btn btn-lg btn-dark-green">Retour à la liste des jeux.</a>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>