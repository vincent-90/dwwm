<?php

class comments extends database {

    public $id = 0;
    public $text = '';
    public $dateHour = '0000-00-00 00:00:00';
    public $id_dwwm_users = 0;
    public $id_dwwm_games = 0;
    public $id_dwwm_consoles = 0;
    public $id_dwwm_status = 0;

    public function __construct() {
        parent::__construct();
    }

    //méthode permettant d'ajouter un commentaire dans la base de données.
    public function addComments() {
        $query = 'INSERT INTO `dwwm_comments` (`text`, `dateHour`, '
                . '`id_dwwm_users`, `id_dwwm_games`, `id_dwwm_consoles`, `id_dwwm_status`) '
                . 'VALUES (:text, :dateHour, :id_dwwm_users, :id_dwwm_games, :id_dwwm_consoles, 1)';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':text', $this->text, PDO::PARAM_STR);
        $queryResult->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $queryResult->bindValue(':id_dwwm_users', $this->id_dwwm_users, PDO::PARAM_INT);
        $queryResult->bindValue(':id_dwwm_games', $this->id_dwwm_games, PDO::PARAM_INT);
        $queryResult->bindValue(':id_dwwm_consoles', $this->id_dwwm_consoles, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    //méthode permettant d'afficher les commentaires d'après l'id d'une console.
    public function getCommentsByConsole() {
        $result = array();
        $query = 'SELECT `dwwm_users`.`username`, `dwwm_users`.`avatar`, '
                . '`dwwm_comments`.`id_dwwm_users`, '
                . '`dwwm_comments`.`id`, `dwwm_comments`.`text`, `dwwm_comments`.`id_dwwm_consoles`, '
                . 'DATE_FORMAT(`dwwm_comments`.`dateHour`, "%d-%b-%Y") AS `date`, '
                . 'DATE_FORMAT(`dwwm_comments`.`dateHour`, "%H:%i") AS `hour` '
                . 'FROM `dwwm_comments` INNER JOIN `dwwm_users` '
                . 'ON `dwwm_comments`.`id_dwwm_users` = `dwwm_users`.`id` '
                . 'WHERE `dwwm_comments`.`id_dwwm_consoles` = :id_dwwm_consoles';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id_dwwm_consoles', $this->id_dwwm_consoles, PDO::PARAM_INT);
        if ($queryResult->execute()) {
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }
    
        //méthode permettant d'afficher les commentaires d'après l'id d'un jeu.
    public function getCommentsByGame() {
        $result = array();
        $query = 'SELECT `dwwm_users`.`username`, `dwwm_users`.`avatar`, '
                . '`dwwm_comments`.`id_dwwm_users`, '
                . '`dwwm_comments`.`id`, `dwwm_comments`.`text`, `dwwm_comments`.`id_dwwm_consoles`, '
                . 'DATE_FORMAT(`dwwm_comments`.`dateHour`, "%d-%b-%Y") AS `date`, '
                . 'DATE_FORMAT(`dwwm_comments`.`dateHour`, "%H:%i") AS `hour` '
                . 'FROM `dwwm_comments` INNER JOIN `dwwm_users` '
                . 'ON `dwwm_comments`.`id_dwwm_users` = `dwwm_users`.`id` '
                . 'WHERE `dwwm_comments`.`id_dwwm_games` = :id_dwwm_games';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id_dwwm_games', $this->id_dwwm_games, PDO::PARAM_INT);
        if ($queryResult->execute()) {
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

}
