<?php
$comments = new comments();

$isDelete = FALSE;
if (!empty($_GET['idDelete'])) {
    $comments->id = htmlspecialchars($_GET['idDelete']);
    if ($comments->deleteComment()) {
        $isDelete = TRUE;
        header('Location:consolesList.php');
        exit();
    }
}

if (!empty($_GET['id'])) {
    $comments->id = htmlspecialchars($_GET['id']);
    $commentDetail = $comments->getCommentById();
}

$formError = array();
$isSuccess = FALSE;
$isError = FALSE;

$dateHour = date('Y-m-d H:i:s');

if (isset($_POST['submitUpdateComment'])) {
    if (isset($_POST['updateText'])) {
        if (!empty($_POST['updateText'])) {
            $updateText = htmlspecialchars($_POST['updateText']);
            $updateCommentMessage = 'Félicitations, le commentaire a bien été modifié.';
        } else {
            $formError['updateText'] = 'Erreur, veuillez remplir le champ.';
        }
    }    
    
    if (count($formError) == 0) {
        $comments->text = $updateText;
        $comments->dateHour = $dateHour;
        if ($comments->updateComment()) {
            $isSuccess = TRUE;
        } else {
            $isError = TRUE;
        }
    }
}