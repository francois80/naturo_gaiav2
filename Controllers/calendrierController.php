<?php
require_once ROOT . '/Utils/Database.php';
require_once ROOT . '/Models/Appointment.php';
require_once ROOT . '/Models/Unavailable.php';

$day =  strtotime(date('Y-m-d'));//timmestamp de la date du jour :  1583794800 (pour 2020-03-10)
echo ' strtotim = '.$day;
$reloadMonths = false; //variable qui indique si on a posté un mois inférieur au mois actuel
//tableau des jours
//$weekDays = ['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'];
$weekDays = ['L','M','M','J','V','S','D'] ;
//tableau des mois
$yearMonths = ['Janvier','février','mars','avril','mai','juin','juillet','aôut','septembre','octobre','novembre','décembre'] ;
//mois en chiffre dans l'année en cours
$numMonth = date('n');
$numDay = date('d'); //numéro du jour du mois

//si après le $_POST on a choisi un mois inférieur au mois de l'année en cours, on réaffiche la liste à partir du mois de l'année en cours
if(!empty($_POST['month']) && !empty($_POST['year'])){
  //timestamp du mois et de l'année choisi dans les listes mois et années
  $timePost = mktime(0, 0, 0, date($_POST['month'])  , 0, date($_POST['year']));
  //timestamp du mois de l'année en cours
  $timeNow = mktime(0, 0, 0, date('m')  , 0, date('Y'));
  //si le mois choisi est inférieur au mois en cours, la varialble qui recharge la liste des mois est vrai
  if($timePost <= $timeNow){
    $reloadMonths = true;
  }
}

$tab = [];//tableau commençant au mois en cours de l'année en cours
//boucle pour mettre dans $tab tous les mois de l'année à partir du mois actuel
for($count = $numMonth ; $count <= count($yearMonths) ; $count ++){
  $tab[$count -1] = $yearMonths[$count -1];
}

//si on n'a pas choisi de date, on écrase le tableau des mois d'une année entière par celui de l'année en cours
//idem si la variable qui recharge la liste des mois est vrai
if(empty($_POST['month']) && !$reloadMonths){
  $yearMonths = $tab;
}
//si on choisi une année supérieur à l'année en cours, la liste des mois s'est affichée au complet,
// mais si on rechoisi une date et un mois inférieur à l'année en cours,
//on repositionne le select du mois sur le mois actuel
if(!empty($_POST['month']) && $_POST['year'] == date('Y')){
  $yearMonths = $tab;
}

$currentMonth =  !empty ($_POST['month'])? $_POST['month']: date('m') ; //mois choisi sinon mois courant
//si on a choisi une date mais...
if(!empty ($_POST['month']) && $reloadMonths){
  //si le mois choisi est inférieur au mois en cours, on remet le mois en cours dans la variable qui sert de calcul
  //pour les nombrs de jours du calendrier...
    if($currentMonth <= $numMonth){
      $currentMonth = $numMonth;
    }
    //sinon on rajoute le nombre de mois au mois en cours pour le bon affichage du calendrier
    //(parce qu'ici le mois est le mois actuel, et le tableau n'a pas 12 mois, d'est celui de l'année en encours
    //et non celui d'une année pleine)
    else{
      $currentMonth += $currentMonth;
    }
}

$selectedYear = !empty ($_POST['year'])? $_POST['year']: date('Y') ; //année choisie sinon année courante
$daysinMont = date('t', mktime(0,0,0,$currentMonth,1,$selectedYear));// nombre de jour dans le mois
$firstDayinMonthinWeek = date('N', mktime(0,0,0,$currentMonth,1,$selectedYear));//position du jour dans la semaine
$currentYear = date('Y');//année encours sur 4
$NextYear = date('Y') +1;//année suivante sur 4

//calcul sur les heures pour l'affichage des rendes-vous dans le planning
$hmorningBegin = strtotime("09:00:00"); //horaire d'ouverture matin
$hmorningEnd = strtotime("13:00:00");//horaire fermeture matin au plus tot
$hmorningEndBis = strtotime("13:30:00");//horaire fermeture matin au plus tard
$hafternoonBegin = strtotime("14:00:00"); //horaire d'ouverture après-midi
$hafternoonEnd = strtotime("19:00:00");//horaire fermeture après-midi

echo 'crénaux horaires dispo le matin : de '. gmdate('H:i',$hmorningBegin). ' à '. gmdate('H:i',$hmorningEnd). ' soit '. gmdate('H:i',$hmorningEnd-$hmorningBegin). ' h <br>';
echo 'crénaux horaires dispo l\'après-midi : de '. gmdate('H:i',$hafternoonBegin). ' à '. gmdate('H:i',$hafternoonEnd). ' soit '. gmdate('H:i',$hafternoonEnd-$hafternoonBegin). ' h<br><br>';

$appointment = new Appointments();
$unavailable = new Unavailable();

$appointmentsList = $appointment->getAll();

$unavalaibleList = $unavailable->getNotOpen();
 //var_dump($unavalaibleList);
if (count($appointmentsList) > 0) {
   foreach ($appointmentsList AS $key => $appointment_info){
    echo $appointment_info['JourRDV']. ' '. $appointment_info['heure_debut']. ' '. $appointment_info['heure_fin']. '<br>';
   }
}       

if (count($unavalaibleList) > 0) {
   foreach ($unavalaibleList AS $key => $unavalaible_info){
    echo $unavalaible_info['day_close']. ' '. $unavalaible_info['day_close_begin']. ' '. $unavalaible_info['day_close_end']. '<br>';
   }
}  
require_once ROOT . '/Views/calendrier.php';