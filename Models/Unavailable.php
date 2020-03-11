<?php

class Unavailable {
    
   public $dayClosed;
   public $dayClosedBegin;
   public $dayClosedEnd;
   public $id_Closed;
   public $db;
    
   
    /**
     * constructeur de la classe Unavailable
     */
    public function __construct($day_Closed = '', $day_ClosedBegin = '', $day_ClosedEnd = '') {
        $this->db = DataBase::getInstance();
        $this->dayClosed = $day_Closed;
        $this->dayClosedBegin = $day_ClosedBegin;
        $this->dayClosedEnd = $day_ClosedEnd;
        $this->idUser = $id_Closed;
       
        
    } 
    
    public function getNotOpen() {
        //Le code de tous les jours de fermetures
        $sql ='SELECT `day_close`, `day_close_begin`, `day_close_end` FROM `unavailable`';
        $unavailableList = [];
        $req = $this->db->query($sql);
        if ($req->execute()) {
            $unavailableList = $req->fetchAll(PDO::FETCH_ASSOC);
            //var_dump($unavailableList);
        }
        else
        {
            echo ' cohioihhhmhm';
        }
        //var_dump($unavailableList);
        return $unavailableList;
    }  

}