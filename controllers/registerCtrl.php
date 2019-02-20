<?php
$users = new users();
//déclaration des regex :
$usernameRegex = '/^[a-zA-Z0-9-_]+$/';
//création d'un tableau où l'on vient stocker les erreurs :
$formError = array();
$isSuccess = FALSE;
$isError = FALSE;

$defaultAvatar = "mushroom.jpg";

//si le submit existe
if (isset($_POST['submit'])) {
    //si $_POST['username'] existe
    if (isset($_POST['username'])) {
        //si $_POST['username'] n'est pas vide
        if (!empty($_POST['username'])) {
            //on vérifie que la longueur du pseudo est inférieur à 30 caractères
            $usernameLength = strlen($_POST['username']);
            if ($usernameLength <= 30) {
                //on vérifie si $_POST['lastname'] respecte la regex
                if (preg_match($usernameRegex, $_POST['username'])) {
                    $username = htmlspecialchars($_POST['username']);
                    //sinon on stock un message dans le tableau formError    
                } else {
                    $formError['username'] = 'Erreur, saisie invalide.';
                }
            } else {
                $formError['username'] = 'Erreur, le pseudo ne doit pas dépasser 30 caractères.';
            }
        } else {
            $formError['username'] = 'Erreur, veuillez remplir le champ.';
        }
    }
    if (isset($_POST['mail'])) {
        if (!empty($_POST['mail'])) {
            //emploi de la fonction PHP filter_var pour valider l'adresse mail
            if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                $mail = htmlspecialchars($_POST['mail']);
            } else {
                $formError['mail'] = 'Erreur, saisie invalide.';
            }
        } else {
            $formError['mail'] = 'Erreur, veuillez remplir le champ.';
        }
    }
    if (isset($_POST['mailConfirm'])) {
        if (!empty($_POST['mailConfirm'])) {
            if (filter_var($_POST['mailConfirm'], FILTER_VALIDATE_EMAIL)) {
                $mailConfirm = htmlspecialchars($_POST['mailConfirm']);
            } else {
                $formError['mailConfirm'] = 'Erreur, saisie invalide.';
            }
        } else {
            $formError['mailConfirm'] = 'Erreur, veuillez remplir le champ.';
        }
    }
    if (isset($mail) && isset($mailConfirm)) {
        if ($mail == $mailConfirm) {
            if (!empty($_POST['password'])) {
                if (!empty($_POST['passwordConfirm'])) {
                    if ($_POST['password'] == $_POST['passwordConfirm']) {
                        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                        $accountMessage = 'Félicitations, le compte a bien été créé.';
                    } else {
                        $formError['passwordError'] = 'Les mots de passe doivent être identiques.';
                    }
                } else {
                    $formError['passwordConfirm'] = 'Erreur, veuillez remplir le champ.';
                }
            } else {
                $formError['password'] = 'Erreur, veuillez remplir le champ.';
            }
        } else {
            $formError['mailError'] = 'Les adresses mail doivent être identiques.';
        }
    } else {
        $accountMessage = 'Désolé, le compte n\'a pu être créé.';
    }
    
    if (count($formError) == 0) {
        $users->username = $username;
        $users->mail = $mail;
        $users->password = $password;
        $users->avatar = $defaultAvatar;
        $checkUser = $users->checkFreeUser();
        if ($checkUser === '1') {
            $formError['checkUser'] = 'Ce compte n\'est pas disponible.';
        } else if ($checkUser === '0') {
            $isSuccess = $users->addUser();
        } else {
            $formError['checkUser'] = 'Echec.';
        }
    }
}
