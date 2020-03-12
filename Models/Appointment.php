<?php
class Appointments {
    
   public $dateRDV;
   public $idUser;
   public $hourBegin;
   public $hourEnd;
   public $idSpeciality;
   
   public $db;
    
    
    /**
     * constructeur de la classe Appointments
     */
    public function __construct($date_Rdv = '', $id_User = '', $hour_Begin ='', $hour_End = '', $id_Speciality = '') {
        $this->db = DataBase::getInstance();
        $this->dateRDV = $date_Rdv;
        $this->idUser = $id_User;
        $this->hourBegin = $hour_Begin;
        $this->hourEnd = $hour_End;
        $this->idSpeciality = $id_Speciality;
     } 
    
    public function getAll() {
        //Le code toutes les dates de rendez-vous
        $sql ='SELECT `daterdv` AS JourRDV, `hour_begin` AS heure_debut, `hour_end` AS heure_fin FROM `appointments`';
        $appointmentList = [];
        $req = $this->db->query($sql);
        if ($req->execute()) {
            $appointmentList = $req->fetchAll(PDO::FETCH_ASSOC);
            //var_dump($appointmentList);
        }
        
        return $appointmentList;
    }  
    
    public function getAllByUser() {
        //Le code toutes les dates de rendez-vous
        $sql ='SELECT `daterdv` AS JourRDV, `hour_begin` AS heure_debut, `hour_end` AS heure_fin, `id_speciality` FROM `appointments` WHERE `id_user` = :id';
        $appointmentList = [];
        $req = $this->db->prepare($sql);
        $req->bindValue(':id', $this->idUser, PDO::PARAM_INT);
        echo $this->idUser;
        if ($req->execute()) {
                if ($req instanceOf PDOStatement) {
                    // Collection des données dans un tableau associatif (FETCH_ASSOC)
                    $appointmentList = $req->fetchAll(PDO::FETCH_ASSOC);
                }
                return $appointmentList;
            }
    }
    
    public function delete() {
        //Le code pour supprimer un client
      $sql = 'DELETE FROM `appointments` WHERE `id_user` = :idPatient AND `hour_begin` = :hourbegin';
      $req = $this->db->prepare($sql);
      $req->bindValue(':idPatient', $this->idUser, PDO::PARAM_INT);
      $req->bindValue(':hourbegin', $this->hourBegin, PDO::PARAM_STR);
      $req->execute();
            
    }

    public function deletePatientAppointment(){
      $sql = 'DELETE FROM `users` WHERE `id_user` = :i';
      $sth = $this->db->prepare($sql);
      $sth->bindValue(':id', $this->idUser, PDO::PARAM_INT);
      if ($sth->execute() && $sth->rowCount() > 0) {
        return $this;
      }
      return false;
    }
    
    
}