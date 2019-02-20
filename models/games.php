<?php

class games {

    public $id = 0;
    public $image = '';
    public $title = '';
    public $summary = '';
    public $date = '00/00/0000';
    public $id_dwwm_users = 0;
    public $id_dwwm_consoles = 0;
    public $id_dwwm_status = 0;
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=dwwm;dbname=dwwm;charset=utf8', 'vincent', 'Pingouin02');
        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }

    //méthode permettant d'ajouter un jeu dans la base de données.
    public function addGames() {
        $query = 'INSERT INTO `dwwm_games` (`image`, `title`, `summary`, `date`, `id_dwwm_users`, `id_dwwm_consoles`, `id_dwwm_status`) '
                . 'VALUES (:image, :title, :summary, :date, :id_dwwm_users, :id_dwwm_consoles, 1)';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':image', $this->image, PDO::PARAM_STR);
        $queryResult->bindValue(':title', $this->title, PDO::PARAM_STR);
        $queryResult->bindValue(':summary', $this->summary, PDO::PARAM_STR);
        $queryResult->bindValue(':date', $this->date, PDO::PARAM_STR);
        $queryResult->bindValue(':id_dwwm_users', $this->id_dwwm_users, PDO::PARAM_INT);
        $queryResult->bindValue(':id_dwwm_consoles', $this->id_dwwm_consoles, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    //méthode permettant de vérifier si un jeu n'est pas déjà enregistrer.
    public function checkFreeGame() {
        $result = FALSE;
        $query = 'SELECT COUNT(`id`) AS `takenGame` FROM `dwwm_games` WHERE `title`=:title AND `id_dwwm_consoles`=:id_dwwm_consoles';
        $freeGame = $this->db->prepare($query);
        $freeGame->bindValue(':title', $this->title, PDO::PARAM_STR);
        $freeGame->bindValue(':id_dwwm_consoles', $this->id_dwwm_consoles, PDO::PARAM_STR);
        if ($freeGame->execute()) {
            $resultObject = $freeGame->fetch(PDO::FETCH_OBJ);
            $result = $resultObject->takenGame;
        }
        return $result;
    }

    //méthode permettant de récuperer la liste des jeux.
//    public function getGamesList() {
//        $result = array();
//        $query = 'SELECT `id`, `image`, `title`, `summary`, `date` FROM `dwwm_games` ORDER BY `title`';
//        $queryResult = $this->db->query($query);
//        if (is_object($queryResult)) {
//            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
//        }
//        return $result;
//    }
    
        //exercice 6
    //méthode permettant de récuperer la liste des rendez-vous.
    public function getGamesList() {
        $result = array();
        $query = 'SELECT DATE_FORMAT(`dwwm_games`.`date`, "%d/%b/%Y") AS `date`, '
                . '`dwwm_games`.`id`, `dwwm_games`.`id_dwwm_consoles`, '
                . '`dwwm_games`.`image`, `dwwm_games`.`title`, `dwwm_games`.`summary` '
                . '`dwwm_consoles`.`name` '
                . 'FROM `dwwm_games` LEFT JOIN `dwwm_consoles` ON `dwwm_games`.`id_dwwm_consoles` = `dwwm_consoles`.`id` '
                . 'ORDER BY `dwwm_games`.`title`';
        $queryResult = $this->db->query($query);
        if (is_object($queryResult)) {
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

}
