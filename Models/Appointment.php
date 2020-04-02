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
    
     /**
     * retourne toutes les dates de rendez-vous
     */
    public function getAll() {
        $sql ='SELECT `daterdv` AS JourRDV, `hour_begin` AS heure_debut, `hour_end` AS heure_fin FROM `appointments`';
        $appointmentList = [];
        $req = $this->db->query($sql);
        if ($req->execute()) {
            $appointmentList = $req->fetchAll(PDO::FETCH_ASSOC);
        }
        return $appointmentList;
    }  
    
    /**
     * retourne toutes les dates de rendez-vous d'un utilisateur
     */
    public function getAllByUser() {
        $sql ='SELECT `daterdv` AS JourRDV, `hour_begin` AS heure_debut, `hour_end` AS heure_fin, `id_speciality` FROM `appointments` WHERE `id_user` = :id';
        $appointmentList = [];
        $req = $this->db->prepare($sql);
        $req->bindValue(':id', $this->idUser, PDO::PARAM_INT);
        if ($req->execute()) {
                if ($req instanceOf PDOStatement) {
                    // Collection des données dans un tableau associatif (FETCH_ASSOC)
                    $appointmentList = $req->fetchAll(PDO::FETCH_ASSOC);
                }
                return $appointmentList;
            }
    }
    
    /**
     * efface 1 rendez-vous (par rapport à l'heure de début du rendez-vous) pour un utilisateur
     */
    public function delete() {
      $sql = 'DELETE FROM `appointments` WHERE `id_user` = :idPatient AND `hour_begin` = :hourbegin';
      $req = $this->db->prepare($sql);
      $req->bindValue(':idPatient', $this->idUser, PDO::PARAM_INT);
      $req->bindValue(':hourbegin', $this->hourBegin, PDO::PARAM_STR);
      $req->execute();
    }

    /**
     * efface tous les rendez-vous (par rapport à l'id de l'utilisateur
     */
     public function deleteAllAppointment() {
      $sql = 'DELETE FROM `appointments` WHERE `id_user` = :idPatient';
      $req = $this->db->prepare($sql);
      $req->bindValue(':idPatient', $this->idUser, PDO::PARAM_INT);
      $req->execute();
    }
    
    /**
     * supprime l'utilisateur de la table users
     * penser à supprimer les rendez-vous de l'utilisateur dans la table appointments
     */
    public function deletePatientAppointment(){
      $sql = 'DELETE FROM `users` WHERE `id_user` = :id';
      $req = $this->db->prepare($sql);
      $req->bindValue(':id', $this->idUser, PDO::PARAM_INT);
      if ($req->execute() && $req->rowCount() > 0) {
        return $this;
      }
      return false;
    }
    
    
}