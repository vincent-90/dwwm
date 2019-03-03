<?php
include '../configuration.php';
include '../controllers/profileCtrl.php';
include 'header.php';
?>
<div class="container-fluid pattern">
    <div class="row">
        <div class="text-center col-12">
            <?php
            if (isset($_GET['idDelete'])) {
                if ($isDelete) {
                    session_destroy();
                    header('Location:index.php');
                    exit();
                } else {
                    ?>
                    <p class="text-danger">Echec de la suppression !</p>
                    <?php
                }
            }
            ?>
            <?php if (isset($_SESSION['isConnect'])) { ?>
                <h1 class="title">Informations</h1>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Avatar</th>
                                <th scope="col">Pseudo</th>
                                <th scope="col">Adresse mail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><img src="../uploads/avatars/<?= $_SESSION['avatar']; ?>" width="150" class="img-fluid" alt="avatar"/></td>
                                <td><?= $_SESSION['username']; ?></td>
                                <td><?= $_SESSION['mail']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <h2 class="subtitle">Modifications</h2>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <form method="POST" action="profile.php">
                                    <fieldset class="window">
                                        <legend><strong>Modifier profil</strong></legend>
                                        <?php if ($isSuccess) { ?>
                                            <p class="text-success"><?= isset($accountMessage) ? $accountMessage : '' ?></p>
                                            <?php
                                        }
                                        if ($isError) {
                                            ?>
                                            <p class="text-danger"><?= isset($accountMessage) ? $accountMessage : '' ?></p>
                                        <?php } ?>
                                        <p class="text-danger"><?= isset($formError['checkUser']) ? $formError['checkUser'] : '' ?></p>
                                        <div class="form-group">
                                            <div class="form-row">             
                                                <label for="username" class="col-sm-4 col-form-label">Pseudo :</label>
                                                <div class="col-sm-8">
                                                    <input name="username" type="text" class="form-control" id="username" placeholder="<?= $_SESSION['username']; ?>" value="<?= isset($username) ? $username : '' ?>"/>
                                                    <p class="text-danger"><?= isset($formError['username']) ? $formError['username'] : '' ?></p>
                                                </div>
                                            </div>
                                            <div class="form-row">             
                                                <label for="mail" class="col-sm-4 col-form-label">Adresse mail :</label>
                                                <div class="col-sm-8">
                                                    <input name="mail" type="email" class="form-control" id="mail" placeholder="<?= $_SESSION['mail']; ?>" value="<?= isset($mail) ? $mail : '' ?>"/>
                                                    <p class="text-danger"><?= isset($formError['mail']) ? $formError['mail'] : '' ?></p>
                                                </div>
                                            </div>
                                            <div class="form-row">             
                                                <label for="mailConfirm" class="col-sm-4 col-form-label">Confirmer mail :</label>
                                                <div class="col-sm-8">
                                                    <input name="mailConfirm" type="email" class="form-control" id="mailConfirm" placeholder="E-mail de confirmation" value="<?= isset($mailConfirm) ? $mailConfirm : '' ?>"/>
                                                    <p class="text-danger"><?= isset($formError['mailConfirm']) ? $formError['mailConfirm'] : '' ?></p>
                                                </div>
                                            </div>
                                            <div class="text-danger"><?= isset($formError['mailError']) ? $formError['mailError'] : '' ?></div>
                                            <div class="form-row">             
                                                <label for="password" class="col-sm-4 col-form-label">Mot de passe :</label>
                                                <div class="col-sm-8">
                                                    <input name="password" type="password" class="form-control" id="password" placeholder="Mot de passe"/>
                                                    <p class="text-danger"><?= isset($formError['password']) ? $formError['password'] : '' ?></p>
                                                </div>
                                            </div>
                                            <div class="form-row">             
                                                <label for="passwordConfirm" class="col-sm-4 col-form-label">Confirmer mot de passe :</label>
                                                <div class="col-sm-8">
                                                    <input name="passwordConfirm" type="password" class="form-control" id="passwordConfirm" placeholder="Mot de passe de confirmation"/>
                                                    <p class="text-danger"><?= isset($formError['passwordConfirm']) ? $formError['passwordConfirm'] : '' ?></p>
                                                </div>
                                            </div>
                                            <div class="text-danger"><?= isset($formError['passwordError']) ? $formError['passwordError'] : '' ?></div>
                                            <div class="form-row">
                                                <div class="col-sm-12">
                                                    <input type="submit" value="Mettre à jour" name="submit" class="btn btn-light-green"/>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form method="POST" action="profile.php" enctype="multipart/form-data">
                                            <fieldset class="window">
                                                <legend><strong>Modifier photo de profil</strong></legend>
                                                <p class="text-success"><?= isset($avatarMessage) ? $avatarMessage : '' ?></p>
                                                <p class="text-danger"><?= isset($formError['avatar']) ? $formError['avatar'] : '' ?></p>
                                                <div class="form-group">
                                                    <div class="form-row">   
                                                        <div class="col-sm-12">
                                                        <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Avatar</span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <label class="custom-file-label" for="avatar"></label>
                                                            <input name="avatar" type="file" class="custom-file-input" id="avatar"/>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-sm-12">
                                                            <input type="submit" value="Changer d'avatar" name="submitAvatar" class="btn btn-light-green"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                    <div class="col-md-12">
                                        <h2 class="subtitle">Suppression</h2>
                                        <div class="window">
                                            <div>Cliquez sur le bouton "<strong>effacer</strong>" pour supprimer votre compte.</div>
                                            <div>Attention, cette action est irréversible.</div>
                                            <a class="btn btn-danger" href="profile.php?idDelete=<?= $_SESSION['id'] ?>">Effacer</a> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div>Erreur, profil non trouvé !</div>
            <?php } ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>