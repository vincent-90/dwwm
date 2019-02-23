<?php

class database {

    protected $db;

    function __construct() {
        try {
            $this->db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';charset=utf8', LOGIN, PASSWORD);
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

}