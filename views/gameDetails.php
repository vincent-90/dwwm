<?php
include '../configuration.php';
include '../controllers/gameDetailsCtrl.php';
include 'header.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="text-center col-12">
            <h1>Détails du jeu :</h1>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Jaquette</th>
                            <th scope="col">Console</th>
                            <th scope="col">Titre</th>
                            <th scope="col">Synopsis</th>
                            <th scope="col">Date de sortie</th>
                        </tr>
                    </thead>
                    <?php if ($gameDetail) { ?>
                        <tbody>
                            <tr>
                                <td><img src="../uploads/games/<?= $games->image; ?>" width="150" /></td>
                                <td><?= $games->name ?></td>
                                <td><?= $games->title ?></td>
                                <td><?= $games->summary ?></td>
                                <td><?= $games->date ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
                <div>Le jeu n'a pas été trouvé !</div>
            <?php } ?>
            <h2>Modifications</h2>
            <form method="POST" action="" enctype="multipart/form-data">
                <fieldset>
                    <legend><strong>Changer de jaquette</strong></legend>
                    <p class="text-success"><?= isset($imageMessage) ? $imageMessage : '' ?></p>
                    <p class="text-danger"><?= isset($formError['image']) ? $formError['image'] : '' ?></p>
                    <div class="form-group">
                        <div class="form-row">             
                            <label for="image" class="col-sm-2 col-form-label">Jaquette :</label>
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
            <form method="POST" action="gameDetails.php?id=<?= $games->id ?>" enctype="multipart/form-data">
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
                            <label for="title" class="col-sm-2 col-form-label">Titre :</label>
                            <div class="col-sm-10">
                                <input name="title" type="text" class="form-control" id="title" placeholder="<?= $games->title; ?>" value="<?= $games->title; ?>"/>
                                <p class="text-danger"><?= isset($formError['title']) ? $formError['title'] : '' ?></p>
                            </div>
                        </div>
                        <div class="form-row">             
                            <label for="summary" class="col-sm-2 col-form-label">Description :</label>
                            <div class="col-sm-10">
                                <textarea name="summary" type="text" class="form-control" id="summary" placeholder="<?= $games->summary; ?>" value="<?= $games->summary; ?>"></textarea>
                                <p class="text-danger"><?= isset($formError['summary']) ? $formError['summary'] : '' ?></p>
                            </div>
                        </div>
                        <div class="form-row">             
                            <label for="date" class="col-sm-2 col-form-label">Date de sortie (France) :</label>
                            <div class="col-sm-10">
                                <input name="date" type="date" class="form-control" id="date" placeholder="<?= $games->date; ?>" value="<?= $games->dateUS; ?>"/>
                                <p class="text-danger"><?= isset($formError['date']) ? $formError['date'] : '' ?></p>
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
                                <input type="submit" value="Modifier" name="submitGame"/>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>

            <p><a href="gamesList.php">Retour</a> à la liste des jeux.</p>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>