<?php

class consoles {

    public $id = 0;
    public $name = '';
    public $image = '';
    public $summary = '';
    public $date = '00/00/0000';
    public $id_dwwm_status = 0;
    public $id_dwwm_users = 0;
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=dwwm;dbname=dwwm;charset=utf8', 'vincent', 'Pingouin02');
        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }

    //méthode permettant d'ajouter une console dans la base de données.
    public function addConsoles() {
        $query = 'INSERT INTO `dwwm_consoles` (`name`, `image`, `summary`, `date`, `id_dwwm_status`, `id_dwwm_users`) VALUES (:name, :image, :summary, :date, 1, :id_dwwm_users)';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':name', $this->name, PDO::PARAM_STR);
        $queryResult->bindValue(':image', $this->image, PDO::PARAM_STR);
        $queryResult->bindValue(':summary', $this->summary, PDO::PARAM_STR);
        $queryResult->bindValue(':date', $this->date, PDO::PARAM_STR);
        $queryResult->bindValue(':id_dwwm_users', $this->id_dwwm_users, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    //méthode permettant de vérifier si une console n'est pas déjà enregistrer.
    public function checkFreeConsole() {
        $result = FALSE;
        $query = 'SELECT COUNT(`id`) AS `takenConsole` FROM `dwwm_consoles` WHERE `name`=:name';
        $freeConsole = $this->db->prepare($query);
        $freeConsole->bindValue(':name', $this->name, PDO::PARAM_STR);
        if ($freeConsole->execute()) {
            $resultObject = $freeConsole->fetch(PDO::FETCH_OBJ);
            $result = $resultObject->takenConsole;
        }
        return $result;
    }

    //méthode permettant de récuperer la liste des consoles.
    public function getConsolesList() {
        $result = array();
        $query = 'SELECT `id`, `image`, `name`, `summary`, DATE_FORMAT(`date`, "%d/%m/%Y") AS `date` FROM `dwwm_consoles` ORDER BY `name`';
        $queryResult = $this->db->query($query);
        if (is_object($queryResult)) {
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

    //méthode permettant de récuperer le détail d'une console d'après son id.
    public function consoleDetail() {
        $return = FALSE;
        $isOk = FALSE;
        $query = 'SELECT `image`, `name`, `summary`, DATE_FORMAT(`date`, "%d/%m/%Y") AS `date`, DATE_FORMAT(`date`, "%Y-%m-%d") AS `dateUS` FROM `dwwm_consoles` WHERE `id`= :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        //si la requête est bien executé, on rempli $return (array) avec un objet
        if ($queryResult->execute()) {
            $return = $queryResult->fetch(PDO::FETCH_OBJ);
        }
        //si $return est un objet alors on hydrate
        if (is_object($return)) {
            $this->image = $return->image;
            $this->name = $return->name;
            $this->summary = $return->summary;
            $this->date = $return->date;
            $this->dateUS = $return->dateUS;
            $isOk = TRUE;
        }
        return $isOk;
    }

    //méthode permettant de modifier les informations d'une console.
    public function updateConsole() {
        $query = 'UPDATE `dwwm_consoles` SET `image`= :image, `name`= :name, `summary`= :summary, `date`= :date WHERE `id`= :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':image', $this->image, PDO::PARAM_STR);
        $queryResult->bindValue(':name', $this->name, PDO::PARAM_STR);
        $queryResult->bindValue(':summary', $this->summary, PDO::PARAM_STR);
        $queryResult->bindValue(':date', $this->date, PDO::PARAM_STR);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    //méthode permettant la suppression d'une console.
    public function deleteConsole() {
        $query = 'DELETE FROM `dwwm_consoles` WHERE `id` = :id LIMIT 1';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $result = $queryResult->execute();
        return $result;
    }

}
