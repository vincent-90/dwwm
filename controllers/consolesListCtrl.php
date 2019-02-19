<?php
$consoles = new consoles();

$isDelete = FALSE;
if (!empty($_GET['idDelete'])) {
    $consoles->id = htmlspecialchars($_GET['idDelete']);
    if ($consoles->deleteConsole()) {
        $isDelete = TRUE;
    }
}

$consolesList = $consoles->getConsolesList();

