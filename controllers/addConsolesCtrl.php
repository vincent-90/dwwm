<?php

$consoles = new consoles();

//déclaration des regex :
$dateRegex = '/[0-9]{4}-[0-9]{2}-[0-9]{2}/';
$nameRegex = '/^[a-zA-Z0-9- ]+$/'; //à modifier

//création d'un tableau où l'on vient stocker les erreurs :
$formError = array();
$isSuccess = FALSE;
$isError = FALSE;

//si le submit existe
if (isset($_POST['submit'])) {

    if (isset($_POST['name'])) {
        if (!empty($_POST['name'])) {
            //on vérifie si $_POST['name'] respecte la regex
            if (preg_match($nameRegex, $_POST['name'])) {
                $name = htmlspecialchars($_POST['name']);
                //sinon on stock un message dans le tableau formError    
            } else {
                $formError['name'] = 'Erreur, le pseudo ne peut avoir que des lettres et/ou des chiffres.';
            }
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

    if (count($formError) == 0) {
        session_start();
        $consoles->name = $name;
        $consoles->summary = $summary;
        $consoles->date = $date;
        $consoles->id_dwwm_users = $_SESSION['id'];
        $checkConsole = $consoles->checkFreeConsole();

        if ($checkConsole === '1') {
            $formError['checkConsole'] = 'Cette console est déjà enregistrée.';
        } else if ($checkConsole === '0') {
            $isSuccess = $consoles->addConsoles();
        } else {
            $formError['checkConsole'] = 'Le développeur est en pause';
        }
    }
}