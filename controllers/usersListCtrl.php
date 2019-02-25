<?php
$users = new users();

$isDelete = FALSE;
if (!empty($_GET['idDelete'])) {
    $users->id = htmlspecialchars($_GET['idDelete']);
    if ($users->deleteUser()) {
        $isDelete = TRUE;
    }
}

$usersList = $users->getUsersList();