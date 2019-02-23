<?php
include '../configuration.php';
include '../controllers/loginCtrl.php';
include 'header.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="text-center col-12">
            <h1>Connexion</h1>
            <form method="POST" action="">
                <fieldset>
                    <legend><strong>Accéder à mon compte</strong></legend>
                    <div class="form-group">
                        <div class="form-row">             
                            <label for="mailLogin" class="col-sm-2 col-form-label">Adresse mail :</label>
                            <div class="col-sm-10">
                                <input name="mailLogin" type="email" class="form-control" id="mailLogin" placeholder="E-mail" value="<?= isset($mailLogin) ? $mailLogin : '' ?>"/>
                                <p class="text-danger"><?= isset($formError['mailLogin']) ? $formError['mailLogin'] : '' ?></p>
                            </div>
                        </div>
                        <div class="form-row">             
                            <label for="passwordLogin" class="col-sm-2 col-form-label">Mot de passe :</label>
                            <div class="col-sm-10">
                                <input name="passwordLogin" type="password" class="form-control" id="passwordLogin" placeholder="Mot de passe"/>
                                <p class="text-danger"><?= isset($formError['passwordLogin']) ? $formError['passwordLogin'] : '' ?></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-12">
                                <input type="submit" value="Se connecter" name="submitLogin"/>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>