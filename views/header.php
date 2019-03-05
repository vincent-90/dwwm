<?php
include '../controllers/headerCtrl.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <link href="../assets/css/style.css" rel="stylesheet"/>
        <link href="../assets/MDB-Free_4.6.1/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="../assets/MDB-Free_4.6.1/css/mdb.min.css" rel="stylesheet"/>
        <link rel="icon" type="image/ico" href="../assets/img/icon.png"/>
        <title>L'amour est dans le Play</title>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark elegant-color">
                <a class="navbar-brand" href="index.php"><img src="../assets/img/Logo1.png" width="150" alt="logo"/></a>
                <button class="navbar-toggler special-color-dark hoverable" type="button" data-toggle="collapse" data-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link hoverable" href="index.php">Accueil</a>
                        </li>
                        <?php if (isset($_SESSION['isConnect'])) { ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown"><?= $_SESSION['username']; ?></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="profile.php?id=<?= $_SESSION['id']; ?>">Afficher profil</a>
                                    <a class="dropdown-item" href="?action=disconnect">Deconnexion</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown">Participer</a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="addConsoles.php">Ajouter une console</a>
                                    <a class="dropdown-item" href="addGames.php">Ajouter un jeu</a>
                                </div>
                            </li>
                            <?php if ($_SESSION['id_dwwm_grades'] == 57) { ?>
                                <li class="nav-item">
                                    <a class="nav-link hoverable" href="usersList.php">Liste des membres</a>
                                </li>
                            <?php }
                        } else {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link hoverable" href="register.php">Inscription</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link hoverable" href="login.php">Connexion</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link hoverable" href="consolesList.php">Liste des consoles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link hoverable" href="gamesList.php">Liste des jeux</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>


