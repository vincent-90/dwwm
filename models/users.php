<?php
class users {

    public $id = 0;
    public $username = '';
    public $mail = '';
    public $password = '';
    public $avatar = '';
    public $id_dwwm_grades = 0;
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=dwwm;dbname=dwwm;charset=utf8', 'vincent', 'Pingouin02');
        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }

    //méthode permettant d'enregistrer un utilisateur dans la base de données.
    public function addUser() {
        $query = 'INSERT INTO `dwwm_users` (`username`, `mail`, `password`, `avatar`, `id_dwwm_grades`)'
                . ' VALUES (:username, :mail, :password, "../assets/img/gameboy.jpg", 2)';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':username', $this->username, PDO::PARAM_STR);
        $queryResult->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $queryResult->bindValue(':password', $this->password, PDO::PARAM_STR);
        //$queryResult->bindValue(':avatar', $this->avatar, PDO::PARAM_STR);
        //$queryResult->bindValue(':id_dwwm_grades', $this->id_dwwm_grades, PDO::PARAM_INT);
        return $queryResult->execute();
    }
    
    //méthode permettant de vérifier si un utilisateur n'existe pas déjà.
    public function checkFreeUser() {
        $result = FALSE;
        $query = 'SELECT COUNT(`id`) AS `takenUser` FROM `dwwm_users` WHERE `username`=:username OR `mail`=:mail';
        $freeUser = $this->db->prepare($query);
        $freeUser->bindValue(':username', $this->username, PDO::PARAM_STR);
        $freeUser->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        if ($freeUser->execute()) {
            $resultObject = $freeUser->fetch(PDO::FETCH_OBJ);
            $result = $resultObject->takenUser;
        }
        return $result;
    }
    
    //méthode permettant à un utilisateur de se connecter.
    public function userLogin() {
        $return = FALSE;
        $isOk = FALSE;
        $query = 'SELECT * FROM `dwwm_users` WHERE `mail` = :mail AND `password` = :password';
        $queryUser = $this->db->prepare($query);
        $queryUser->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $queryUser->bindValue(':password', $this->password, PDO::PARAM_STR);
        //si la requête est bien executé, on rempli $return (array) avec un objet
        if ($queryUser->execute()) {
            $return = $queryUser->fetch(PDO::FETCH_OBJ);
        }
        //si $return est un objet alors on hydrate
        if (is_object($return)) {
            $this->username = $return->username;
            $this->avatar = $return->avatar;
            $this->id = $return->id;
            $this->id_dwwm_grades = $return->id_dwwm_grades;
            $isOk = TRUE;
        }
        return $isOk;
    }
    
}