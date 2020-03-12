<?php
    session_start();
    require_once ROOT . '/Views/header.php';
    require_once ROOT . '/Views/nav.php';

if(isset($success)){
?>
<p class="alert alert-success">Le profil du patient a été modifié avec succès!</p>
<?php } ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 card">
            <div class="card-header .z-depth-4 info-color">
                <h2 class="text-center font-weight-bold text-white">Inscription</h2>
            </div>
            <form class="card-body bg-softGreen" method="POST" action="" novalidate="">
                <div class="form-group md-form">
                    <label for="firstname">Prénom : </label>
                    <input  autocomplete="false" name="firstname" type="text" class="form-control <?= (isset($isSubmit) && !isset($errors['firstname'])) ? 'is-valid' : '' ?> <?= (isset($isSubmit) && isset($errors['firstname'])) ? 'is-invalid' : '' ?>" id="firstname" value="<?= $patient->firsname ?>">
                    <div class="invalid-feedback">
                    <?= $errors['firstname'] ?? '' ?> !
                    </div>
                </div>  
                <div class="form-group md-form">
                    <label for="lastname">Nom : </label>
                    <input  autocomplete="false" name="lastname" type="text" class="form-control <?= (isset($isSubmit) && !isset($errors['lastname'])) ? 'is-valid' : '' ?> <?= (isset($isSubmit) && isset($errors['lastname'])) ? 'is-invalid' : '' ?>" id="lastname" value="<?= $patient->lastname ?>">
                    <div class="invalid-feedback">
                    <?= $errors['lastname'] ?? '' ?> !
                    </div>
                </div>
                <div class="form-group md-form">
                    <label for="age">Date de naissance : </label>
                    <input  autocomplete="false" name="age" type="text" class="form-control <?= (isset($isSubmit) && !isset($errors['age'])) ? 'is-valid' : '' ?> <?= (isset($isSubmit) && isset($errors['age'])) ? 'is-invalid' : '' ?>" id="age" value="<?= $patient->birthdate ?>">
                    <div class="invalid-feedback">
                    <?= $errors['age'] ?? '' ?> !
                    </div>
                </div>
                <div class="form-group md-form">
                    <label for="phone">Télephone : </label>
                    <input  autocomplete="false" name="phone" type="text" class="form-control <?= (isset($isSubmit) && !isset($errors['phone'])) ? 'is-valid' : '' ?> <?= (isset($isSubmit) && isset($errors['phone'])) ? 'is-invalid' : '' ?>" id="phone" value="0<?= $patient->phone ?>">
                    <div class="invalid-feedback">
                    <?= $errors['phone'] ?? '' ?> !
                    </div>
                </div>
                <div class="form-group md-form">
                    <label for="emailRegister">Email : </label>
                    <input  autocomplete="false" name="email" type="text" class="form-control <?= (isset($isSubmit) && !isset($errors['email'])) ? 'is-valid' : '' ?> <?= (isset($isSubmit) && isset($errors['email'])) ? 'is-invalid' : '' ?>" id="emailRegister" value="<?= $patient->email ?>">
                    <div class="invalid-feedback">
                    <?= $errors['email'] ?? '' ?> !
                    </div>
                </div>
               <div class="form-group md-form">
                    <label for="appointmentChance">Choix du rendez-vous : </label>
                    <input  autocomplete="false" name="appointmentChance" type="text" class="form-control" id="appointmentChance">
                    <div class="invalid-feedback">
                    <?= $errors['appointmentChance'] ?? '' ?> !
                    </div>
                </div>
                <div class="form-group md-form">
                    <label for="message">Qu'avez-vous mangez au cours des 24 dernières heures ?</label>
                    <textarea  autocomplete="false" name="message" class="form-control" rows="5" id="message"></textarea>
                    <div class="invalid-feedback">
                    <?= $errors['message'] ?? '' ?> !
                    </div>
                </div>
                <button class="btn btn-info btn-rounded" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>


<?php
require_once ROOT . '/Views/footer.php';