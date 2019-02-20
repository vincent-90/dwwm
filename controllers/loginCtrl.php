<?php
$users = new users();
$formError = array();
//On initialise les variables de stockage des informations pour éviter d'avoir des erreurs dans la vue.
$mailLogin = '';
$passwordLogin = '';

if (isset($_POST['submitLogin'])) {
    if (isset($_POST['mailLogin'])) {
        if (!empty($_POST['mailLogin'])) {
            if (filter_var($_POST['mailLogin'], FILTER_VALIDATE_EMAIL)) {
                $mailLogin = htmlspecialchars($_POST['mailLogin']);
            } else {
                $formError['mailLogin'] = 'Erreur, saisie invalide.';
            }
        } else {
            $formError['mailLogin'] = 'Erreur, veuillez remplir le champ.';
        }
    }
    if (isset($_POST['passwordLogin'])) {
        if (!empty($_POST['passwordLogin'])) {
            $passwordLogin = $_POST['passwordLogin'];
        } else {
            $formError['passwordLogin'] = 'Erreur, veuillez remplir le champ.';
        }
    }
   
    if (count($formError) == 0) {
        $users->mail = $mailLogin;
        $hash = $users->getUserHash();
        if (is_object($hash)) {
            $isConnect = password_verify($passwordLogin, $hash->password);
            if ($isConnect) {
                $userInfo = $users->getUserInfo();
                session_start();
                $_SESSION['mail'] = $userInfo->mail;
                $_SESSION['username'] = $userInfo->username;
                $_SESSION['password'] = $userInfo->password;
                $_SESSION['avatar'] = $userInfo->avatar;
                $_SESSION['id'] = $userInfo->id;
                $_SESSION['id_dwwm_grades'] = $userInfo->id_dwwm_grades;
                $_SESSION['isConnect'] = true;
                header('Location:index.php');
                exit();
            }
        }
    }
}