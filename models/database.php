<?php

class database {

    protected $db;

    function __construct() {
        try {
            //Connexion à MySQL
            $this->db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';charset=utf8', LOGIN, PASSWORD);
        } catch (Exception $ex) {
            //En cas d'erreur, on affiche un message
            die($ex->getMessage());
        }
    }

}