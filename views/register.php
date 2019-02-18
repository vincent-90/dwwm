<?php
include '../models/users.php';
include '../controllers/registerCtrl.php';
include 'header.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="text-center col-12">
            <h1>Inscription</h1>
            <?php if ($isSuccess) { ?>
                 <p class="text-success"><?= isset($accountMessage) ? $accountMessage : '' ?></p>
                <p class="text-success">Enregistrement effectué !</p>
                <p><a href="login.php">Cliquez ici</a> pour vous authentifier.</p>
                <?php
            }
            if ($isError) {
                ?>
                <p class="text-danger"><?= isset($accountMessage) ? $accountMessage : '' ?></p>
                <p class="text-danger">Désolé, le compte n'a pu être créer.</p>
            <?php } ?>
            <p class="text-danger"><?= isset($formError['checkUser']) ? $formError['checkUser'] : '' ?></p>
            <form method="POST" action="">
                <fieldset>
                    <legend><strong>Créer un compte</strong></legend>
                    <div class="form-group">
                        <div class="form-row">             
                            <label for="username" class="col-sm-2 col-form-label">Pseudo :</label>
                            <div class="col-sm-10">
                                <input name="username" type="text" class="form-control" id="username" placeholder="Pseudonyme" value="<?= isset($username) ? $username : '' ?>"/>
                                <p class="text-danger"><?= isset($formError['username']) ? $formError['username'] : '' ?></p>
                            </div>
                        </div>
                        <div class="form-row">             
                            <label for="mail" class="col-sm-2 col-form-label">Adresse mail :</label>
                            <div class="col-sm-10">
                                <input name="mail" type="email" class="form-control" id="mail" placeholder="E-mail" value="<?= isset($mail) ? $mail : '' ?>"/>
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
                                <input type="submit" value="S'inscrire" name="submit"/>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>