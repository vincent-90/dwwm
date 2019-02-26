<?php
//session_start démarre une nouvelle session ou reprend une session existante
session_start();
//base de données
define('HOST','dwwm');
define('DBNAME','dwwm');
define('LOGIN','vincent');
define('PASSWORD','Pingouin02');
//la structure include_once permet d'inclure un fichier durant l'exécution
//si le code a déjà été inclus, il ne le sera pas une seconde fois
include_once 'models/database.php';
include_once 'models/users.php';
include_once 'models/consoles.php';
include_once 'models/games.php';
include_once 'models/comments.php';