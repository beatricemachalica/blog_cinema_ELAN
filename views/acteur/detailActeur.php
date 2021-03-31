<?php

ob_start();

$detailActeur = $acteur->fetch();
// SELECT id_acteur, concat(prenom, ' ', nom) as nomActeur, sexe, dateNaissance
?>

<div class="row">

  <div class="col-8 text-justify">
    <h1><?= $detailActeur["nomActeur"]; ?></h1>
    <p>
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
  <figure class=" col-4"><img style="width: 100%;" src="<?= $detailActeur['imgPath']; ?>" alt="photo de l'acteur"></figure>
</div>
<img src="./img/acteurs/" alt="">

<?php

// On utilise closeCursor() pour éviter les erreurs s'il y a de multiples requêtes sur une même page
$acteur->closeCursor();
$titreOnglet = "Détails de l'acteur";
$contenu = ob_get_clean();
require "views/template.php";
