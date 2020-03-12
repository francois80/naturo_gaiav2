
<?php
//session_start();
require_once '../Config/database.php';
require_once  '../Utils/Database.php';
require_once  '../Models/User.php';

$user = new User();
$user->id_user = 8;
$user->firsname = 'BABABABA';
$user->lastname = 'Ali';
$user->birthdate = '1978-12-15';
$user->phone = 0322445566;
$user->email = 'ali.baba@orange.fr';

$user->update();

//UPDATE `users` SET `lastname`= 'BABABABA', `firstname`= 'Ali', `age`= '1978-12-15', `phone`= 0322445566, `email`= 'ali.baba@orange.fr' WHERE `id_user` = 8
//$req = $this->db->prepare($sql);
//$req->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
//$req->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
//$req->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
//$req->bindValue(':phone', $this->phone, PDO::PARAM_INT);
//$req->bindValue(':email', $this->email, PDO::PARAM_STR);
//$req->bindValue(':id', $this->id_user, PDO::PARAM_INT);