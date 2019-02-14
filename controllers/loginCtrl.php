<?php

$users = new users();
$usersVerify = $users->userLogin();

$formError = array();
$isSuccess = FALSE;
$isError = FALSE;

if (isset($_POST['submitLogin'])) {
    if (isset($_POST['mailLogin'])) {
        if (!empty($_POST['mailLogin'])) {
            if ($_POST['mailLogin'] == $usersVerify->mail) { 
                if (filter_var($_POST['mailLogin'], FILTER_VALIDATE_EMAIL)) {
                    $mailLogin = htmlspecialchars($_POST['mailLogin']);
                    if (!empty($passwordLogin)) {
                        $passwordLogin = password_verify($_POST['passwordLogin'], $usersVerify->mail);
                        if ($passwordLogin == $users->password) {
                            $userLogin = $users->userLogin();
                            $userExist = $userLogin->rowCount();
                            if ($userExist == 1) {
                                $userInfo = $userLogin->fetch();
                                $_SESSION['id'] = $userInfo['id'];
                                $_SESSION['username'] = $userInfo['username'];
                                $_SESSION['mail'] = $userInfo['mail'];
                                header("Location: profile.php?id=" . $_SESSION['id']);
                            } else {
                                $formError['userLogin'] = 'Erreur de connexion.';
                            }
                        } else {
                            $formError['passwordLogin'] = "Erreur, mauvais mot de passe.";
                        }
                    } else {
                        $formError['passwordLogin'] = 'Erreur, veuillez remplir le champ.';
                    }
                } else {
                    $formError['mailLogin'] = 'Erreur, saisie invalide.';
                }
            } else {
                $formError['mailLogin'] = 'Erreur, l\'adresse ne correspond à aucun compte';
            }
        } else {
            $formError['mailLogin'] = 'Erreur, veuillez remplir le champ.';
        }
    }
}
