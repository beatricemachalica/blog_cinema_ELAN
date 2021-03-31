<?php

ob_start();

$detailActeur = $acteur->fetch();
// SELECT id_acteur, concat(prenom, ' ', nom) as nomActeur, sexe, dateNaissance
?>

<h1><?= $detailActeur["nomActeur"]; ?></h1>
<h2>Informations sur l'acteur :</h2>
<div class="col-7 text-justify">
  <p class="row">
    Sexe : <?= $detailActeur["sexe"]; ?> <br>
    Date de naissance : <?= $detailActeur["dateNaissance"]; ?> <br>
  </p>
  <ul style="list-style-type:none;">
    <li>
      <h2>Filmographie : </h2>
    </li>
    <li><?= $detailActeur["titre"]; ?></li>
  </ul>
</div>

<?php

// On utilise closeCursor() pour éviter les erreurs s'il y a de multiples requêtes sur une même page
$acteur->closeCursor();
$titreOnglet = "Détails de l'acteur";
$contenu = ob_get_clean();
require "views/template.php";
