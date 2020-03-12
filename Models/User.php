<?php

class User {

    public $id_user;
    public $firsname;
    public $lastname;
    public $birthdate;
    public $phone;
    public $email;
    public $password;
    public $id_role;
    public $register_at;
    public $role_id = 2;
    public $db;

    public function __construct($id_user = '', $_password = '', $_lastname = '', $_firstname = '',$birth_date ='', $phone = '', $_email = '', $id_role = '') {
        $this->id_user = $id_user;
        $this->password = $_password;
        $this->firsname = $_firstname;
        $this->lastname = $_lastname;
        $this->birthdate= $birth_date;
        $this->phone = $phone;
        $this->email = $_email;
        $this->role_id = $id_role;
        $this->db = Database::getInstance();
    }

    public function create() {
        //$sql = 'INSERT INTO `users`(`firstname`,`lastname`, `age`,`email`, `phone`,`password`,`role_id`) VALUES (:firstname,:lastname, :email, :password, :role_id)';
        $sql = 'INSERT INTO `users`(`psw`,`lastname`,`firstname`,`age`,`email`,`phone`,`id_role`) VALUES (:password, :lastname, :firstname, :age, :email, :phone, :role_id)';
        $req = $this->db->prepare($sql);
        $req->bindValue(':password', $this->password, PDO::PARAM_STR);
        $req->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $req->bindValue(':firstname', $this->firsname, PDO::PARAM_STR);
        $req->bindValue(':age', $this->birthdate, PDO::PARAM_STR);        
        $req->bindValue(':email', $this->email, PDO::PARAM_STR);
        $req->bindValue(':phone', $this->phone, PDO::PARAM_INT);
        
        $req->bindValue(':role_id', $this->role_id, PDO::PARAM_INT);
        $req->execute();
         var_dump($req);
    }

    /**
     * cette méthode permet de récupérer la liste de tous les patients de l'hospital.
     * @return type array
     */
    public function getAll() {
        //Le code sélectionnant tous les patients
        $sql = 'SELECT `id_user`, `lastname`, `firstname` FROM `users`';
        $patientsList = [];
        $req = $this->db->query($sql);
         if ($req->execute()) {
            $patientsList = $req->fetchAll(PDO::FETCH_ASSOC);
        }
       
        return $patientsList;
    }
    
    public function findPatient($search) {
        $sql = 'SELECT `id_user`, `lastname`, `firstname` FROM `patients` WHERE `firstname` LIKE :search OR `lastname` LIKE :search';
        $req = $this->db->prepare($sql);
        $req->bindValue(':search', $search . '%', PDO::PARAM_STR);
        $userList = [];
        if ($req->execute()) {
            if ($req instanceOf PDOStatement) {
                // Collection des données dans un tableau associatif (FETCH_ASSOC)
                $usersList = $req->fetchAll(PDO::FETCH_ASSOC);
            }
            return $usersList;
        }
    }
    
    public function totalPatients() {
        $sql = 'SELECT COUNT(`id_user`) AS numberOfPatients FROM `users`';
        $req = $this->db->query($sql);
        return $req->fetchColumn(0);
    }

    public function patientsPerPage($limit, $begin) {
        $sql = 'SELECT `id_user`, `lastname`, `firstname` FROM `users` ORDER BY `lastname` ASC LIMIT :limit OFFSET :begin';
        $req = $this->db->prepare($sql);
        $req->bindValue(':limit', $limit, PDO::PARAM_INT);
        $req->bindValue(':begin', $begin, PDO::PARAM_INT);
        $usersList = [];
        if ($req->execute()) {
            if ($req instanceOf PDOStatement) {
                // Collection des données dans un tableau associatif (FETCH_ASSOC)
                $usersList = $req->fetchAll(PDO::FETCH_ASSOC);
            }
            return $usersList;
        }
    }
    
    public function update() {
       $sql = 'UPDATE `users` SET `lastname`= :lastname, `firstname`= :firstname, `age`= :birthdate, `phone`= :phone, `email`= :email WHERE `id_user` = :id';
        $req = $this->db->prepare($sql);
        $req->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $req->bindValue(':firstname', $this->firsname, PDO::PARAM_STR);
        $req->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $req->bindValue(':phone', $this->phone, PDO::PARAM_INT);
        $req->bindValue(':email', $this->email, PDO::PARAM_STR);
        $req->bindValue(':id', $this->id_user, PDO::PARAM_INT);
       
        return $req->execute();
        
    }
    
    public function getOne() {
        //$sql = 'SELECT `id`,`firstname`,`lastname`,`email`,`password`,`role_id` FROM `users` WHERE `id` = :id OR `email` = :email';
        $sql = 'SELECT `id_user`,`psw`,`lastname`,`firstname`,`age`,`phone`,`email`,`id_role` FROM `users` WHERE `id_user` = :id OR `email` = :email';
        $req = $this->db->prepare($sql);
        $req->bindValue(':id', $this->id_user, PDO::PARAM_INT);
        $req->bindValue(':email', $this->email, PDO::PARAM_STR);

        if ($req->execute()) {
            $user = $req->fetch(PDO::FETCH_OBJ);
            $this->id_user = $user->id_user;
            $this->firsname = $user->firstname;
            $this->lastname = $user->lastname;
            $this->birthdate = $user->age;
            $this->phone = $user->phone;
            $this->email = $user->email;
            $this->password = $user->psw;
            $this->role_id = $user->id_role;
           
           return $this;
           
        } 
       
    }
    
//    public function getOneById() {
//        //Le code sélectionnant un patient
//        $sql = 'SELECT `id_user`, `lastname`, `firstname`, `birthdate`, `phone`, `email` FROM `users` WHERE `id_user` = :id';
//        $sth = $this->db->prepare($sql);
//        $sth->bindValue(':id', $this->id, PDO::PARAM_INT);
//        if ($sth->execute()) {
//            $patient = $sth->fetch(PDO::FETCH_OBJ);
//            if ($patient) {
//                $this->firstname = $patient->firstname;
//                $this->lastname = $patient->lastname;
//                $this->birthdate = $patient->birthdate;
//                $this->phone = $patient->phone;
//                $this->email = $patient->email;
//                return $this;
//            }
//        }
//        return false;
//    }
    
    public function checkEmail() {
        $sql = 'SELECT COUNT(`id_user`) AS number_user FROM `users` WHERE `email` = :email';
        $req = $this->db->prepare($sql);
        $req->bindValue(':email', $this->email, PDO::PARAM_STR);
        $exist_user = false;
        if($req->execute()){
            $result = $req->fetchColumn(0);
            if(is_numeric($result) && $result > 0){
                $exist_user = true;
            }
        }
        return $exist_user;
    }

}
