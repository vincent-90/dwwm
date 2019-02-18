<?php 

$users = new users();

$isDelete = FALSE;
if (!empty($_GET['idDelete'])) {
    $users->id = htmlspecialchars($_GET['idDelete']);
    if ($users->deleteUser()) {
        $isDelete = TRUE;
    }
}

//déclaration des regex :
$usernameRegex = '/^[a-zA-Z0-9]+$/';
//création d'un tableau où l'on vient stocker les erreurs :
$formError = array();
$isSuccess = FALSE;
$isError = FALSE;

//si le submit existe
if (isset($_POST['submit'])) {
    //si $_POST['username'] existe
    if (isset($_POST['username'])) {
        //si $_POST['username'] n'est pas vide
        if (!empty($_POST['username'])) {
            //on vérifie que la longueur du pseudo est inférieur à 30 caractères.
            $usernameLength = strlen($_POST['username']);
            if ($usernameLength <= 30) {
                //on vérifie si $_POST['lastname'] respecte la regex
                if (preg_match($usernameRegex, $_POST['username'])) {
                    $username = htmlspecialchars($_POST['username']);
                    //sinon on stock un message dans le tableau formError    
                } else {
                    $formError['username'] = 'Erreur, le pseudo ne peut avoir que des lettres et/ou des chiffres.';
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
            //emploi de la fonction PHP filter_var pour valider l'adresse mail
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
                        $accountMessage = 'Félicitations, le compte a bien été modifié.';
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
        $accountMessage = 'Erreur, le compte n\'a pu être modifié.';
    }


    if (count($formError) == 0) {
        //session_start();
        $users->id = $_GET['id'];
        $users->username = $username;
        $users->mail = $mail;
        $users->password = $password;
        $checkUser = $users->checkFreeUser();
        if ($checkUser === '1') {
            $formError['checkUser'] = 'Ce compte n\'est pas disponible.';
        } else if ($checkUser === '0') {
            $updateProfile = $users->updateProfile();
            if ($updateProfile) {
                
                session_start();
                $_SESSION['mail'] = $mail;
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
//                $_SESSION['avatar'] = $updateProfile->avatar;
//                $_SESSION['id'] = $updateProfile->id;
//                $_SESSION['id_dwwm_grades'] = $updateProfile->id_dwwm_grades;
                $_SESSION['isConnect'] = true;
                $isSuccess = TRUE;
//                var_dump($_SESSION);
                
            } else {
                $isError = TRUE;
            }
        } else {
            $formError['checkUser'] = 'Le développeur est en pause';
        }
    }
    
}


if (isset($_POST['submitAvatar'])) {
    //on vérifie que file avatar existe et qu'il possede bien un nom
    if (isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])) {
        $tailleMax = 2097152; //environ 2Mo
        $extValides = array ('jpg', 'jpeg', 'gif', 'png');
        //on verifie la taille du fichier importé
        if ($_FILES['avatar']['size'] <= $tailleMax) {
            //strtolower convertie une chaîne en minuscule
            //substr permet d'ignore un caractère (ici le point)
            //strrchr récupére l'ext du fichier
            $extUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
            //on verifie l'ext du fichier envoyé
            if (in_array($extUpload, $extValides)) {
                session_start();
                $chemin = "../uploads/".$_SESSION['id'].".".$extUpload;
                //move_uploaded_file permet de rediriger le fichier
                $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                if ($resultat) {
                    $avatarMessage = 'Félicitations, l\'avatar a bien été modifié.';
                 //   $updateAvatar = $users->updateAvatar();
//                    if($updateAvatar){
//                    $users->avatar = $resultat;
//                    }
                } else {
                    $formError['avatar'] = "echec de l'upload";
                }
            } else {
                $formError['avatar']= "mauvais format";
            }
        } else {
            $formError['avatar'] = "votre fichier ne doit pas dépasser 2 Mo.";
        }
    }
    
    if (count($formError) == 0) {
        $users->id = $_GET['id'];
        $users->avatar = $chemin;
        $updateAvatar = $users->updateAvatar();
            if ($updateAvatar) {
                
                //session_start();
                $_SESSION['avatar'] = $_SESSION['id'].".".$extUpload;
                $_SESSION['isConnect'] = true;
                //$isSuccess = TRUE;
                
            } else {
                $isError = TRUE;
            }
    }
}
