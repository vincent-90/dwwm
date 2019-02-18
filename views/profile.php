<?php
include '../models/users.php';
include '../controllers/profileCtrl.php';
include 'header.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="text-center col-12">
            
            <?php
            if (isset($_GET['idDelete'])) {
                if ($isDelete) {
                    session_destroy();
        header('Location:index.php');
        exit();
                 } else { ?>
                    <p class="text-danger">Echec de la suppression !</p>
                    <?php
                }
            }
            ?>
            
            <h1>Informations :</h1>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Avatar</th>
                            <th scope="col">Pseudo</th>
                            <th scope="col">Adresse mail</th>
                            <th scope="col">Mot de passe</th>
                        </tr>
                    </thead>
                    <?php if (isset($_SESSION['isConnect'])) { ?>
                        <tbody>
                            <tr>
                                <td><?= $_SESSION['avatar']; ?></td>
                                <td><?= $_SESSION['username']; ?></td>
                                <td><?= $_SESSION['mail']; ?></td>
                                <td><?= $_SESSION['password']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <div>
                <img src="../uploads/<?= $_SESSION['avatar']; ?>" width="150" />
            </div>
            <p class="text-danger"><?= isset($formError['avatar']) ? $formError['avatar'] : '' ?></p>
            <p class="text-success"><?= isset($avatarMessage) ? $avatarMessage : '' ?></p>
            <h2>Avatar</h2>
            <form method="POST" action="" enctype="multipart/form-data">
                <fieldset>
                    <legend><strong>Modifier photo de profil</strong></legend>
                    <div class="form-group">
                        <div class="form-row">             
                            <label for="avatar" class="col-sm-2 col-form-label">Avatar :</label>
                            <div class="col-sm-10">
                                <input name="avatar" type="file" class="form-control" id="avatar"/>
                                
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-12">
                                <input type="submit" value="Changer d'avatar" name="submitAvatar"/>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
                
                <h2>Modifications</h2>
            <?php if ($isSuccess) { ?>
                 <p class="text-success"><?= isset($accountMessage) ? $accountMessage : '' ?></p>
                <p class="text-success">Modifications enregistrées !</p>
                <?php
            }
            if ($isError) {
                ?>
                <p class="text-danger"><?= isset($accountMessage) ? $accountMessage : '' ?></p>
                <p class="text-danger">Désolé, les modifications n'ont pu être enregistrées.</p>
            <?php } ?>
            <p class="text-danger"><?= isset($formError['checkUser']) ? $formError['checkUser'] : '' ?></p>
            <form method="POST" action="">
                <fieldset>
                    <legend><strong>Modifier profil</strong></legend>
                    <div class="form-group">
                        <div class="form-row">             
                            <label for="username" class="col-sm-2 col-form-label">Pseudo :</label>
                            <div class="col-sm-10">
                                <input name="username" type="text" class="form-control" id="username" placeholder="<?= $_SESSION['username']; ?>" value="<?= isset($username) ? $username : '' ?>"/>
                                <p class="text-danger"><?= isset($formError['username']) ? $formError['username'] : '' ?></p>
                            </div>
                        </div>
                        <div class="form-row">             
                            <label for="mail" class="col-sm-2 col-form-label">Adresse mail :</label>
                            <div class="col-sm-10">
                                <input name="mail" type="email" class="form-control" id="mail" placeholder="<?= $_SESSION['mail']; ?>" value="<?= isset($mail) ? $mail : '' ?>"/>
                                <p class="text-danger"><?= isset($formError['mail']) ? $formError['mail'] : '' ?></p>
                            </div>
                        </div>
                        <div class="form-row">             
                            <label for="mailConfirm" class="col-sm-2 col-form-label">Confirmer adresse mail :</label>
                            <div class="col-sm-10">
                                <input name="mailConfirm" type="email" class="form-control" id="mail" placeholder="E-mail de confirmation" value="<?= isset($mailConfirm) ? $mailConfirm : '' ?>"/>
                                <p class="text-danger"><?= isset($formError['mailConfirm']) ? $formError['mailConfirm'] : '' ?></p>
                            </div>
                        </div>
                        <div class="text-danger"><?= isset($formError['mailError']) ? $formError['mailError'] : '' ?></div>
                        <div class="form-row">             
                            <label for="password" class="col-sm-2 col-form-label">Mot de passe :</label>
                            <div class="col-sm-10">
                                <input name="password" type="password" class="form-control" id="password" placeholder="Mot de passe"/>
                                <p class="text-danger"><?= isset($formError['password']) ? $formError['password'] : '' ?></p>
                            </div>
                        </div>
                        <div class="form-row">             
                            <label for="passwordConfirm" class="col-sm-2 col-form-label">Confirmer mot de passe :</label>
                            <div class="col-sm-10">
                                <input name="passwordConfirm" type="password" class="form-control" id="passwordConfirm" placeholder="Mot de passe de confirmation"/>
                                <p class="text-danger"><?= isset($formError['passwordConfirm']) ? $formError['passwordConfirm'] : '' ?></p>
                            </div>
                        </div>
                        <div class="text-danger"><?= isset($formError['passwordError']) ? $formError['passwordError'] : '' ?></div>
                        <div class="form-row">
                            <div class="col-sm-12">
                                <input type="submit" value="Mettre à jour" name="submit"/>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
            
            <h2>Suppression</h2>
            <div>Cliquez sur "<strong>effacer</strong>" pour supprimer un patient.</div>
            <div>Attention, cette action est irréversible.</div>
        <a class="btn blue-gradient btn-lg btn-block" href="profile.php?idDelete=<?= $_SESSION['id'] ?>">Effacer</a>
        
                
            <?php } else { ?>
                <div>Erreur, profil non trouvé !</div>
            <?php } ?>
</div>
    </div>
</div>
<?php include 'footer.php'; ?>