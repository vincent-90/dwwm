<?php

$consoles = new consoles();

//déclaration des regex :
$dateRegex = '/[0-9]{4}-[0-9]{2}-[0-9]{2}/';
//création d'un tableau où l'on vient stocker les erreurs :
$formError = array();
$isSuccess = FALSE;
$isError = FALSE;
//initialisation de variables de stockage des informations pour éviter d'avoir des erreurs dans la vue.
$name = '';
$summary = '';

if (isset($_POST['submitConsole'])) {
    if (isset($_POST['name'])) {
        if (!empty($_POST['name'])) {
            $name = htmlspecialchars($_POST['name']);
        } else {
            $formError['name'] = 'Erreur, veuillez remplir le champ.';
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

    //on vérifie que $_FILES['image'] existe et qu'il possède bien un nom
    if (isset($_FILES['image'])) {
        if (!empty($_FILES['image']['name'])) {
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
                    $way = "../uploads/consoles/" . $name . "." . $uploadExt;
                    //move_uploaded_file permet de rediriger le fichier
                    $result = move_uploaded_file($_FILES['image']['tmp_name'], $way);
                    if ($result) {
                        $image = $name . "." . $uploadExt;
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
    }

    if (count($formError) == 0) {
        $consoles->name = $name;
        $consoles->summary = $summary;
        $consoles->date = $date;
        $consoles->image = $image;
        $consoles->id_dwwm_users = $_SESSION['id'];
        $checkConsole = $consoles->checkFreeConsole();
        if ($checkConsole === '1') {
            $formError['checkConsole'] = 'Cette console est déjà enregistrée.';
        } else if ($checkConsole === '0') {
            $isSuccess = $consoles->addConsoles();
        } else {
            $formError['checkConsole'] = 'Echec.';
        }
    }
}