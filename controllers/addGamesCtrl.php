<?php
//instanciation de l'objet consoles. 
//$consoles devient une instance de la classe consoles.
//la méthode magique construct est appelée automatiquement grâce au mot clé new.
$consoles = new consoles();
$consolesList = $consoles->getConsolesList();

//instanciation de l'objet games. 
//$games devient une instance de la classe games.
//la méthode magique construct est appelée automatiquement grâce au mot clé new.
$games = new games();

//déclaration des regex :
$dateRegex = '/[0-9]{4}-[0-9]{2}-[0-9]{2}/';
//création d'un tableau où l'on vient stocker les erreurs :
$formError = array();
$isSuccess = FALSE;
$isError = FALSE;

//si le submit existe
if (isset($_POST['submitGame'])) {
    //si $_POST['title'] existe
    if (isset($_POST['title'])) {
        //si $_POST['title'] n'est pas vide
        if (!empty($_POST['title'])) {
            //htmlspecialchars convertit les caractères spéciaux
            $title = htmlspecialchars($_POST['title']);
        } else {
            //sinon on stock un message dans le tableau formError
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
            //on vérifie si $_POST['date'] respecte la regex
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
                    $way = "../uploads/games/" . $title . "." . $uploadExt;
                    //move_uploaded_file permet de rediriger le fichier
                    $result = move_uploaded_file($_FILES['image']['tmp_name'], $way);
                    if ($result) {
                        $image = $title . "." . $uploadExt;
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

    if (isset($_POST['idConsole'])) {
        if (!empty($_POST['idConsole'])) {
            $idConsole = htmlspecialchars($_POST['idConsole']);
        } else {
            $formError['idConsole'] = 'Erreur, veuillez sélectionnez une console.';
        }
    }

    //si aucune erreur n'a été comptabilisé
    if (count($formError) == 0) {
        $games->title = $title;
        $games->summary = $summary;
        $games->date = $date;
        $games->image = $image;
        $games->id_dwwm_consoles = $idConsole;
        $games->id_dwwm_users = $_SESSION['id'];
        //on vérifie que le jeu n'est pas déjà présent dans la db
        $checkGame = $games->checkFreeGame();
        if ($checkGame === '1') {
            $formError['checkGame'] = 'Ce jeu est déjà enregistré.';
        } else if ($checkGame === '0') {
            $isSuccess = $games->addGames();
        } else {
            $formError['checkGame'] = 'Echec.';
        }
    }
}