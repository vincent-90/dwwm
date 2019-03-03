<?php
//instanciation de l'objet users. 
//$users devient une instance de la classe users.
//la méthode magique construct est appelée automatiquement grâce au mot clé new.
$users = new users();
//création d'un tableau où l'on vient stocker les erreurs :
$formError = array();

//si le submit existe
if (isset($_POST['submitLogin'])) {
    //si $_POST['mailLogin'] existe
    if (isset($_POST['mailLogin'])) {
        //si $_POST['mailLogin'] n'est pas vide
        if (!empty($_POST['mailLogin'])) {
            //emploi de la fonction PHP filter_var pour valider l'adresse mail
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
    //si aucune erreur n'a été comptabilisé
    if (count($formError) == 0) {
        $users->mail = $mailLogin;
        $hash = $users->getUserHash();
        //is_object détermine si une variable est de type objet
        if (is_object($hash)) {
            //emploi de la fonction password_verify qui vérifie qu'un mot de passe correspond à un hachage
            $isConnect = password_verify($passwordLogin, $hash->password);
            if ($isConnect) {
                $userInfo = $users->getUserInfo();
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