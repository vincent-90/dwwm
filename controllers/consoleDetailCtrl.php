<?php
$isConsole = FALSE;
$consoles = new consoles();
if (!empty($_GET['id'])){
    $consoles->id = htmlspecialchars($_GET['id']);
    $isConsole = $consoles->consoleDetail();
}

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
    
        //on vérifie que file avatar existe et qu'il possede bien un nom
    if (isset($_FILES['image'])){ 
        if (!empty($_FILES['image']['name'])) {
        $tailleMax = 5097152; //environ 5Mo
        $extValides = array ('jpg', 'jpeg', 'gif', 'png');
        //on verifie la taille du fichier importé
        if ($_FILES['image']['size'] <= $tailleMax) {
            //strtolower convertie une chaîne en minuscule
            //substr permet d'ignore un caractère (ici le point)
            //strrchr récupére l'ext du fichier
            $extUpload = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
            //on verifie l'ext du fichier envoyé
            if (in_array($extUpload, $extValides)) {
                //session_start();
                $chemin = "../uploads/consoles/".$name.".".$extUpload;
                //move_uploaded_file permet de rediriger le fichier
                $resultat = move_uploaded_file($_FILES['image']['tmp_name'], $chemin);
                if ($resultat) {
                    $accountMessage = 'Félicitations, l\'avatar a bien été modifié.';
                 //   $updateAvatar = $users->updateAvatar();
//                    if($updateAvatar){
//                    $users->avatar = $resultat;
//                    }
                } else {
                    $formError['image'] = "echec de l'upload";
                }
            } else {
                $formError['image']= "mauvais format";
            }
        } else {
            $formError['image'] = "votre fichier ne doit pas dépasser 2 Mo.";
        }
        } else {
            $formError['image']= "veuillez sélectionner un fichier";
        }
    }
    

    if (count($formError) == 0) {
        //session_start();
        $consoles->name = $name;
        $consoles->summary = $summary;
        $consoles->date = $date;
        $consoles->image = $chemin;
        //$consoles->id_dwwm_users = $_SESSION['id'];
        //$checkConsole = $consoles->checkFreeConsole();
        $consoles->updateConsole();
        
       if ($consoles->updateConsole()){
            $isSuccess = TRUE;
        } else {
            $isError = TRUE;
        }
    }
}