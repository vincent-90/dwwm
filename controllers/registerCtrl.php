<?php
//instanciation de l'objet users. 
//$users devient une instance de la classe users.
//la méthode magique construct est appelée automatiquement grâce au mot clé new.
$users = new users();
//déclaration des regex :
$usernameRegex = '/^[a-zA-Z0-9-_]+$/';
//création d'un tableau où l'on vient stocker les erreurs :
$formError = array();
$isSuccess = FALSE;
$isError = FALSE;
//variable contenant l'avatar par défaut :
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
                //on vérifie si $_POST['username'] respecte la regex
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
    //si $_POST['mail'] existe
    if (isset($_POST['mail'])) {
        //si $_POST['mail'] n'est pas vide
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
    //on vérifie que les variables $mail et $mailConfirm existent
    if (isset($mail) && isset($mailConfirm)) {
        //si elles sont identiques
        if ($mail == $mailConfirm) {
            //on vérifie $_POST['password'] n'est pas vide
            if (!empty($_POST['password'])) {
                //on vérifie $_POST['passwordConfirm'] n'est pas vide
                if (!empty($_POST['passwordConfirm'])) {
                    //si ils sont identiques
                    if ($_POST['password'] == $_POST['passwordConfirm']) {
                        //emploi de la fonction password_hash pour créer une clé de hashage du mot de passe
                        //le résultat de PASSWORD_BCRYPT sera toujours une chaîne de 60 caractères
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
    //si aucune erreur n'a été comptabilisé
    if (count($formError) == 0) {
        $users->username = $username;
        $users->mail = $mail;
        $users->password = $password;
        $users->avatar = $defaultAvatar;
        //on vérifie que le pseudo et/ou le mail n'est pas déjà pris
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
