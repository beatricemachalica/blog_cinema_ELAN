<?php

ob_start();

$detailReal = $realisateur->fetch();

?>

<h1><?= $detailReal["nom"]; ?></h1>
<h2>Informations sur le réalisateur :</h2>
<div class="row">
  <p class="col-7 text-justify">
    Sexe : <?= $detailReal["sexe"]; ?> <br>
    Date de naissance : <?= $detailReal["dateNaissance"]; ?> <br>
    Filmographie : <?= $detailReal["titre"]; ?> <br>
  </p>
</div>

<?php

// On utilise closeCursor() pour éviter les erreurs s'il y a de multiples requêtes sur une même page
$realisateur->closeCursor();
$titreOnglet = "Détails du réalisateur";
$contenu = ob_get_clean();
require "views/template.php";
