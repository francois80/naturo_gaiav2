<?php

class User {

    public $id;
    public $firsname;
    public $lastname;
    public $email;
    public $password;
    public $register_at;
    public $role_id = 1;
    public $db;

    public function __construct($_firstname = '', $_lastname = '', $_email = '', $_password = '') {
        $this->firsname = $_firstname;
        $this->lastname = $_lastname;
        $this->email = $_email;
        $this->password = $_password;
        $this->db = Database::getInstance();
    }

    public function create() {
        //$sql = 'INSERT INTO `users`(`firstname`,`lastname`,`email`,`password`,`role_id`) VALUES (:firstname,:lastname, :email, :password, :role_id)';
        $sql = 'INSERT INTO `users`(`psw`,`lastname`,`firstname`,`email`,`id_role`) VALUES (:password, :lastname, :firstname, :email, :role_id)';
        $req = $this->db->prepare($sql);
        $req->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $req->bindValue(':firstname', $this->firsname, PDO::PARAM_STR);
        $req->bindValue(':email', $this->email, PDO::PARAM_STR);
        $req->bindValue(':password', $this->password, PDO::PARAM_STR);
        $req->bindValue(':role_id', $this->id_role, PDO::PARAM_INT);

        $req->execute();
    }

    public function getOne() {
        //$sql = 'SELECT `id`,`firstname`,`lastname`,`email`,`password`,`role_id` FROM `users` WHERE `id` = :id OR `email` = :email';
        $sql = 'SELECT `id_user`,`psw`,`lastname`,`firstname`,`email`,`id_role` FROM `users` WHERE `id_user` = :id OR `email` = :email';
        $req = $this->db->prepare($sql);
        $req->bindValue(':id', $this->id, PDO::PARAM_INT);
        $req->bindValue(':email', $this->email, PDO::PARAM_STR);

        if ($req->execute()) {
            $user = $req->fetch(PDO::FETCH_OBJ);
            $this->firsname = $user->firstname;
            $this->lastname = $user->lastname;
            $this->email = $user->email;
            $this->password = $user->psw;
            $this->role_id = $user->id_role;
            return $this;
        }
    }
    
    public function checkEmail() {
        $sql = 'SELECT COUNT(`id`) AS number_user FROM `users` WHERE `email` = :email';
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
