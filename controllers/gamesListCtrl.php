<?php
$games = new games();

$isDelete = FALSE;
if (!empty($_GET['idDelete'])) {
    $games->id = htmlspecialchars($_GET['idDelete']);
    if ($games->deleteGame()) {
        $isDelete = TRUE;
    }
}

$gamesList = $games->getGamesList();