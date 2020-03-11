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
    
}