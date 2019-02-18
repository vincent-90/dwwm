<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'disconnect') {
        session_destroy();
        header('Location:index.php');
        exit();
    }
}