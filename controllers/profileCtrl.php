<?php
session_start();
$users = new users();

$isDelete = FALSE;
if (!empty($_GET['idDelete'])) {
    $users->id = htmlspecialchars($_GET['idDelete']);
    if ($users->deleteUser()) {
        $isDelete = TRUE;
    }
}

//déclaration des regex :
$usernameRegex = '/^[a-zA-Z0-9-_]+$/';
//création d'un tableau où l'on vient stocker les erreurs :
$formError = array();
$isSuccess = FALSE;
$isError = FALSE;

if (isset($_POST['submit'])) {
    if (isset($_POST['username'])) {
        if (!empty($_POST['username'])) {
            $usernameLength = strlen($_POST['username']);
            if ($usernameLength <= 30) {
                if (preg_match($usernameRegex, $_POST['username'])) {
                    $username = htmlspecialchars($_POST['username']);    
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
        $accountMessage = 'Désolé, le compte n\'a pu être modifié.';
    }

    if (count($formError) == 0) {
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
                $_SESSION['mail'] = $mail;
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['isConnect'] = true;
                $isSuccess = TRUE;
            } else {
                $isError = TRUE;
            }
        } else {
            $formError['checkUser'] = 'Echec.';
        }
    }
}

if (isset($_POST['submitAvatar'])) {
    //on vérifie que $_FILES['avatar'] existe et qu'il possède bien un nom
    if (isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])) {
        $sizeMax = 2097152; //environ 2Mo
        $validExt = array ('jpg', 'jpeg', 'gif', 'png');
        //on vérifie la taille du fichier importé
        if ($_FILES['avatar']['size'] <= $sizeMax) {
            //strtolower convertie une chaîne de caractère en minuscule
            //substr permet d'ignorer un caractère (ici le point)
            //strrchr récupére l'extension du fichier
            $uploadExt = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
            //on vérifie l'extension du fichier envoyé
            if (in_array($uploadExt, $validExt)) {
                $way = "../uploads/avatars/".$_SESSION['id'].".".$uploadExt;
                //move_uploaded_file permet de rediriger le fichier
                $result = move_uploaded_file($_FILES['avatar']['tmp_name'], $way);
                if ($result) {
                    $avatarMessage = 'Félicitations, l\'avatar a bien été modifié.';
                    $image = $_SESSION['id'].".".$uploadExt;
                } else {
                    $formError['avatar'] = "Echec de l'upload";
                }
            } else {
                $formError['avatar']= "Erreur, ne sont accepter que les formats jpg, jpeg, gif ou png.";
            }
        } else {
            $formError['avatar'] = "Erreur, votre fichier ne doit pas dépasser 2 Mo.";
        }
    }
    
    if (count($formError) == 0) {
        $users->id = $_GET['id'];
        $users->avatar = $image;
        $updateAvatar = $users->updateAvatar();
            if ($updateAvatar) {
                $_SESSION['avatar'] = $_SESSION['id'].".".$uploadExt;
                $_SESSION['isConnect'] = true;
                $isSuccess = TRUE;
            } else {
                $isError = TRUE;
            }
    }
}
