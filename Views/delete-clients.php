<?php
    session_start();
    require_once ROOT . '/Views/header.php';
    require_once ROOT . '/Views/nav.php';
 
    ?>
<div class="row justify-content-center">
    <?php if (count($user) == 0) { ?>
        <p>Pas de patients</p>
    <?php } else {
        ?>
        
       
       
         <table class="table table-striped table-bordered col-md-8">
             <thead>
                <tr>
                    <th scope="col"><?= $user->lastname ?></th>
                    <th scope="col"><?= $user->firsname ?></th>
                    <th scope="col">0<?= $user->phone ?></th>
                    <th scope="col"><?= $user->email ?></th>
                    <td><a href="delete-clients.php?idPatient=<?= $user->id_user ?>&hourBegin=<?= $userAppointment_info['heure_debut'] ?>&allInfo=1">Supprimer</a></td>
                    
                </tr>
            </thead>
             
         </table>
        <table class="table table-striped table-bordered col-md-8">
            
            <thead class="thead-dark">
                <tr>
                 
                    <th scope="col">Jour</th>
                    <th scope="col">H deb</th>
                    <th scope="col">H fin</th>
                    <th scope="col">Spécialité</th>
                    <th scope="col">Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($userAppointment) > 0) {
                   foreach ($userAppointment as $userAppointmentID => $userAppointment_info):
                        ?>
                       
                        <tr>
                            <td><?= $userAppointment_info['JourRDV'] ?></td>
                            <td><?= $userAppointment_info['heure_debut'] ?></td>
                            <td><?= $userAppointment_info['heure_fin'] ?></td>
                            <td><?= $userAppointment_info['id_speciality'] ?></td>
                            <td><a href="delete-clients.php?idPatient=<?= $user->id_user ?>&hourBegin=<?= $userAppointment_info['heure_debut'] ?>">Supprimer</a></td>
                        </tr>
                        <?php
                 endforeach;
                }
                ?>
            </tbody>
        </table>
      
    <?php } ?>
</div>


<?php
require_once ROOT . '/Views/footer.php';