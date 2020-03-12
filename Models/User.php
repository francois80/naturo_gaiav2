<?php

class User {

    public $id_user;//id
    public $firsname;// Nom
    public $lastname; // Prénom
    public $birthdate; //date de naissance format anglais 1987-12-26
    public $phone; // téléphone
    public $email; //email
    public $password; // mot de passe
    public $id_role; //rôle de l'utilisateur
    public $register_at;
    public $role_id = 2; // rôle par défaut
    public $date_rdv; // date du rendez-vous format anglais
    public $hour_begin;// heure début rendez-vous
    public $hour_end; //heur fin rendez-vous
    public $db;// connexion base

    /**
     * constructeur
     * 
     */
    public function __construct($id_user = '', $_password = '', $_lastname = '', $_firstname = '', $birth_date = '', $_phone = '', $_email = '', $id_role = '') {
        $this->id_user = $id_user;
        $this->password = $_password;
        $this->firsname = $_firstname;
        $this->lastname = $_lastname;
        $this->birthdate = $birth_date;
        $this->phone = $_phone;
        $this->email = $_email;
        $this->role_id = $id_role;
        $this->db = Database::getInstance();
    }

    /**
     * cette méthode permet de créer un utilisateur dans users
     * 
     */
   public function create() {
        $sql = 'INSERT INTO `users`(`psw`,`lastname`,`firstname`,`age`,`email`,`phone`,`id_role`) VALUES (:password, :lastname, :firstname, :age, :email, :phone, :role_id)';
        $req = $this->db->prepare($sql);
        $req->bindValue(':password', $this->password, PDO::PARAM_STR);
        $req->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $req->bindValue(':firstname', $this->firsname, PDO::PARAM_STR);
        $req->bindValue(':age', $this->birthdate, PDO::PARAM_STR);
        $req->bindValue(':email', $this->email, PDO::PARAM_STR);
        $req->bindValue(':phone', $this->phone, PDO::PARAM_INT);
        $req->bindValue(':role_id', $this->role_id, PDO::PARAM_INT);
        if($req->execute()){
            return $this;
        }
        
    }

    /**
     * cette méthode permet de récupérer la liste de tous les clients dans users.
     * @return type array
     */
    public function getAll() {
        $sql = 'SELECT `id_user`, `lastname`, `firstname` FROM `users`';
        $patientsList = [];
        $req = $this->db->query($sql);
        if ($req->execute()) {
            $patientsList = $req->fetchAll(PDO::FETCH_ASSOC);
        }

        return $patientsList;
    }

     /**
     * cette méthode permet de récupérer la liste de tous les clients commencant par la même début dans users.
     * @return type array
     */
    public function findPatient($search) {
        $sql = 'SELECT `id_user`, `lastname`, `firstname` FROM `users` WHERE `firstname` LIKE :search OR `lastname` LIKE :search';
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

   /**
     * cette méthode compte le nombre total de clients dans users
     * @return type array
     */
    public function totalPatients() {
        $sql = 'SELECT COUNT(`id_user`) AS numberOfPatients FROM `users`';
        $req = $this->db->query($sql);
        return $req->fetchColumn(0);
    }

    /**
     * cette méthode affiche un certain nombre de clients par page
     * @return type array
     */
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
    
    /**
     * modification du client dans la table users
     * 
     */
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

    /**
     * cette méthode donne les infos pour une personne
     * 
     */
    public function getOne() {
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

    public function getOneForDelete() {
        $sql = 'SELECT `users`.`id_user`, `lastname`, `firstname`, `age`, `city`, `email`, `phone`, `daterdv`, `hour_begin`, `hour_end`, `speciality` FROM `users` JOIN `appointments` ON `appointments`.`id_user` = `users`.`id_user` JOIN `specialities` ON `appointments`.`id_speciality` = `specialities`. `id_speciality` AND `users`.`id_user` = :id';

        $req = $this->db->prepare($sql);
        $req->bindValue(':id', $this->id_user, PDO::PARAM_INT);
        //$req->bindValue(':email', $this->email, PDO::PARAM_STR);

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
            $this->date_rdv = $user->date_rdv;
            $this->hour_begin = $user->hour_begin;
            $this->hour_end = $user->hour_end;

            return $this;
        }
    }

    public function delete() {
        //Le code pour supprimer un client
        $sql = 'DELETE FROM `users` WHERE `id_user` = :id';
        $req = $this->db->prepare($sql);
        $req->bindValue(':id', $this->id_user, PDO::PARAM_INT);
        $req->execute();
    }

    /**
     * cette méthode permet sélectionner un client par son id
     * 
     */
    public function getOneById() {
        $sql = 'SELECT `id_user`, `lastname`, `firstname`, `age`, `phone`, `email` FROM `users` WHERE `id_user` = :id';
        $req = $this->db->prepare($sql);
        $req->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($req->execute()) {
            $user = $req->fetch(PDO::FETCH_OBJ);
            if ($user) {
                $this->firsname = $user->firstname;
                $this->lastname = $user->lastname;
                $this->birthdate = $user->age;
                $this->phone = $user->phone;
                $this->email = $user->email;
                return $this;
            }
        }
        return false;
    }
    
    /**
     * cette méthode permet de vérifier si l'email n'existe pas dans la base
     */
    public function checkEmail() {
        $sql = 'SELECT COUNT(`id_user`) AS number_user FROM `users` WHERE `email` = :email';
        $req = $this->db->prepare($sql);
        $req->bindValue(':email', $this->email, PDO::PARAM_STR);
        $exist_user = false;
        if ($req->execute()) {
            $result = $req->fetchColumn(0);
            if (is_numeric($result) && $result > 0) {
                $exist_user = true;
            }
        }
        return $exist_user;
    }

}
