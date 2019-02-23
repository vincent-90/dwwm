<?php

$games = new games();
if (!empty($_GET['id'])) {
    $games->id = htmlspecialchars($_GET['id']);
    $gameDetail = $games->gameDetail();
}

$consoles = new consoles();
$consolesList = $consoles->getConsolesList();

//déclaration des regex :
$dateRegex = '/[0-9]{4}-[0-9]{2}-[0-9]{2}/';
//création d'un tableau où l'on vient stocker les erreurs :
$formError = array();
$isSuccess = FALSE;
$isError = FALSE;
//initialisation de variables de stockage des informations pour éviter d'avoir des erreurs dans la vue.
$title = '';
$summary = '';

if (isset($_POST['submitGame'])) {
    if (isset($_POST['title'])) {
        if (!empty($_POST['title'])) {
            $title = htmlspecialchars($_POST['title']);
        } else {
            $formError['title'] = 'Erreur, veuillez remplir le champ.';
        }
    }
    if (isset($_POST['summary'])) {
        if (!empty($_POST['summary'])) {
            $summary = htmlspecialchars($_POST['summary']);
        } else {
            $formError['summary'] = 'Erreur, veuillez remplir le champ.';
        }
    }
    if (isset($_POST['date'])) {
        if (!empty($_POST['date'])) {
            if (preg_match($dateRegex, $_POST['date'])) {
                $date = htmlspecialchars($_POST['date']);
            } else {
                $formError['date'] = 'Date invalide.';
            }
        } else {
            $formError['date'] = 'Erreur, veuillez sélectionnez une date.';
        }
    }
    if (isset($_POST['idConsole'])) {
        if (!empty($_POST['idConsole'])) {
            $idConsole = htmlspecialchars($_POST['idConsole']);
        } else {
            $formError['idConsole'] = 'Erreur, veuillez sélectionnez une console.';
        }
    }
        if (isset($title) && isset($summary) && isset($date) && isset($idConsole)) {
        $updateMessage = 'Félicitations, les informations ont bien été enregistrées.';
    } else {
        $updateMessage = 'Désolé, les informations n\'ont pu être modifiées.';
    }

    if (count($formError) == 0) {
        $games->title = $title;
        $games->summary = $summary;
        $games->date = $date;
        $games->id_dwwm_consoles = $idConsole;
        $games->updateGame();
        if ($games->updateGame()) {
            $isSuccess = TRUE;
        } else {
            $isError = TRUE;
        }
    }
}

if (isset($_POST['submitImage'])) {
    //on vérifie que $_FILES['image'] existe et qu'il possède bien un nom
    if (isset($_FILES['image']) and ! empty($_FILES['image']['name'])) {
        $sizeMax = 5097152; //environ 5Mo
        $validExt = array('jpg', 'jpeg', 'gif', 'png');
        //on vérifie la taille du fichier importé
        if ($_FILES['image']['size'] <= $sizeMax) {
            //strtolower convertie une chaîne de caractère en minuscule
            //substr permet d'ignorer un caractère (ici le point)
            //strrchr récupére l'extension du fichier
            $uploadExt = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
            //on vérifie l'extension du fichier envoyé
            if (in_array($uploadExt, $validExt)) {
                $way = "../uploads/games/" . $games->title . "." . $uploadExt;
                //move_uploaded_file permet de rediriger le fichier
                $result = move_uploaded_file($_FILES['image']['tmp_name'], $way);
                if ($result) {
                    $imageMessage = 'Félicitations, la jaquette a bien été modifié.';
                    $image = $games->title . "." . $uploadExt;
                } else {
                    $formError['image'] = "Echec de l'upload";
                }
            } else {
                $formError['image'] = "Erreur, ne sont accepter que les formats jpg, jpeg, gif ou png.";
            }
        } else {
            $formError['image'] = "Erreur, votre fichier ne doit pas dépasser 5 Mo.";
        }
    } else {
        $formError['image'] = "Erreur, veuillez sélectionner un fichier.";
    }

    if (count($formError) == 0) {
        $games->title = $title;
        $games->image = $image;
        $games->updateImage();
        if ($games->updateImage()) {
            $isSuccess = TRUE;
        } else {
            $isError = TRUE;
        }
    }
}