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
                <div class="window">
                    <h2>Description</h2>
                    <p><?= $games->summary ?></p>
                </div>
            <?php } else { ?>
                <div>Le jeu n'a pas été trouvé !</div>
            <?php } ?>
            <?php if (isset($_SESSION['isConnect'])) { ?>
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="subtitle">Modifications</h2>
                        <div class="row">
                            <div class="col-md-7">
                                <form method="POST" action="gameDetails.php?id=<?= $games->id ?>">
                                    <fieldset class="window">
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
                                            <fieldset class="window">
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
                                            <h2 class="subtitle">Suppression</h2>
                                            <div class="window">
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
            <!--liste des commentaires accessible à tous-->
            <div class="row">
                <div class="col-md-12">
                    <h2 class="subtitle">Commentaires</h2>
                    <div class="text-center">
                        <button type="button" class="btn btn-amber btn-lg" id="hide" title="Masquer commentaires">Masquer</button>
                        <button type="button" class="btn btn-yellow btn-lg" id="show" title="Afficher commentaires">Afficher</button>
                    </div>
                    <div class="comments">
                        <?php if ($isComment) { ?>
                            <?php foreach ($isComment as $comment) { ?>
                                <div class="row">
                                    <div class="col-sm-2 comment">
                                        <div><?= $comment->username; ?></div>
                                        <div><img src="../uploads/avatars/<?= $comment->avatar; ?>" width="150" class="img-fluid"/></div>
                                    </div>
                                    <div class="col-sm-10 comment">
                                        <div class="comment"><?= $comment->date; ?><?= $comment->hour; ?></div>
                                        <div><?= $comment->text; ?></div>
                                        <!--modifier un commentaire-->
                                        <?php if (isset($_SESSION['isConnect']) && $_SESSION['id'] == $comment->id_dwwm_users) { ?>
                                            <div><a class="btn btn-lime" href="commentDetails.php?id=<?= $comment->id; ?>">Editer</a></div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="window">Encore aucun commentaire !</div>
                        <?php } ?>
                        <!--ajouter un commentaire, utilisateur inscrit-->
                        <?php if (isset($_SESSION['isConnect'])) { ?>
                            <form method="POST" action="">
                                <fieldset class="window">
                                    <legend><strong>Ajouter un commentaire</strong></legend>
                                    <?php if ($isSuccess) { ?>
                                        <p class="text-success">Votre commentaire a bien été envoyé.</p>
                                        <?php
                                    }
                                    if ($isError) {
                                        ?>
                                        <p class="text-danger">Erreur, envoi impossible.</p>
                                    <?php } ?>
                                    <div class="form-group">
                                        <div class="form-row"> 
                                            <div class="col-md-10">
                                                <textarea name="text" type="text" class="form-control" id="text" placeholder="Ecrire un commentaire"></textarea>
                                                <p class="text-danger"><?= isset($formError['text']) ? $formError['text'] : '' ?></p>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="submit" value="Envoyer" name="submitComment" class="btn btn-light-green"/>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <a href="gamesList.php" class="btn btn-lg btn-dark-green">Retour à la liste des jeux.</a>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>