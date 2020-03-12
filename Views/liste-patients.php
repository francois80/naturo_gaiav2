<?php
require_once ROOT . '/Views/header.php';
require_once ROOT . '/Views/nav.php';

?>

<h2 class="text-center my-4">Liste des patients</h2>
<div class="justify-content-center row">
    <form method="post" action="#">
        <div class="form-group row ">
            <input type="text" class="form-control col-7" placeholder="Sélectionnez un Nom" name="search">
            <input type="submit" value="Recherche" name="search-submit" class="btn btn-sm btn-outline-primary ml-2 col-4">
        </div> 
    </form>
</div>
<div class="row justify-content-center">
    <?php if (count($patientsList) == 0) { ?>
        <p>Pas de patients</p>
    <?php } else {
        ?>
        <table class="table table-striped table-bordered col-md-8">

            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Profil</th>
                    <th scope="col">Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($patientsList) > 0) {
                    foreach ($patientsList as $patientId => $patient):
                        ?>
                        <tr>
                            <td><?= $patientId + 1 ?></td>
                            <td><?= $patient['lastname'] ?></td>
                            <td><?= $patient['firstname'] ?></td>
                            <td><a href="update-clients.php?idPatient=<?= $patient['id_user'] ?>" class="btn btn-sm btn-primary" >**Modifier</a></td>
                            <td><a href="delete-clients.php?idPatient=<?= $patient['id_user'] ?>">Supprimer</a></td>
                        </tr>
                        <?php
                    endforeach;
                }
                ?>
            </tbody>
        </table>
        <?php if(!isset($hidePaginate)) { ?>
        <nav class="col-md-5" aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link <?= ($page <= 1 ? 'btn disabled' : ''); ?>" href="liste-patients.php?page=<?= $page - 1; ?>">Previous</a></li>
                <?php for ($pageItem = 1; $pageItem <= $numberOfPages; $pageItem++) { ?>
                    <li class="page-item"><a class="page-link" href="liste-patients.php?page=<?= $pageItem; ?>"><?= $pageItem; ?></a></li>
                <?php } ?>
                <li class="page-item"><a class="page-link <?= ($page >= $numberOfPages ? 'btn disabled' : '') ?>" href="liste-patients.php?page=<?= $page + 1; ?>">Next</a></li>
            </ul>
        </nav>
        <?php } ?>
    <?php } ?>
</div>
<?php
require_once 'footer.php';
