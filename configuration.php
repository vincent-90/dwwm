<?php
session_start();
// Base de données
define('HOST','dwwm');
define('DBNAME','dwwm');
define('LOGIN','vincent');
define('PASSWORD','Pingouin02');
include_once 'models/database.php';
include_once 'models/users.php';
include_once 'models/consoles.php';
include_once 'models/games.php';