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
                . ' VALUES (:username, :mail, :password, :avatar, 2)';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':username', $this->username, PDO::PARAM_STR);
        $queryResult->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $queryResult->bindValue(':password', $this->password, PDO::PARAM_STR);
        $queryResult->bindValue(':avatar', $this->avatar, PDO::PARAM_STR);
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

    //méthode qui retourne le hashage du mot de passer d'un compte.
    function getUserHash() {
        $query = 'SELECT `password` FROM `dwwm_users` WHERE `mail` = :mail';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $queryResult->execute();
        return $queryResult->fetch(PDO::FETCH_OBJ);
    }

    //méthode permettant de récupèrer les informations de l'utilisateur une fois connecté.
    function getUserInfo() {
        $query = 'SELECT * FROM `dwwm_users` WHERE `mail` = :mail';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $queryResult->execute();
        return $queryResult->fetch(PDO::FETCH_OBJ);
    }

    //méthode permettant de modifier le profil d'un utilisateur.
    public function updateProfile() {
        $query = 'UPDATE `dwwm_users` SET `username`= :username, `mail`= :mail, `password`= :password WHERE `id`= :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':username', $this->username, PDO::PARAM_STR);
        $queryResult->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $queryResult->bindValue(':password', $this->password, PDO::PARAM_STR);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    //méthode permettant de modifier un avatar.
    public function updateAvatar() {
        $query = 'UPDATE `dwwm_users` SET `avatar`= :avatar WHERE `id`= :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':avatar', $this->avatar, PDO::PARAM_STR);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    //méthode permettant la suppression d'un compte.
    public function deleteUser() {
        $query = 'DELETE FROM `dwwm_users` WHERE `id` = :id LIMIT 1';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $result = $queryResult->execute();
        return $result;
    }

    //méthode permettant de récuperer la liste des membres.
    public function getUsersList() {
        $result = array();
        $query = 'SELECT `id`, `username`, `mail` FROM `dwwm_users` ORDER BY `username`';
        $queryResult = $this->db->query($query);
        if (is_object($queryResult)) {
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

}
