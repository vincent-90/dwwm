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
        //$queryResult->bindValue(':id_dwwm_status', $this->id_dwwm_status, PDO::PARAM_INT);
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
    
}