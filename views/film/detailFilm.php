<?php

ob_start();

$detailFilm = $film->fetch();

?>

<h1> <?= $detailFilm["titre"]; ?> </h1>
<div class="row">
  <p class="text-justify">
  <ul class="col-7 " style="list-style-type:none;">
    <li>Sortie le : <?= $detailFilm["dateSortie"]; ?></li>
    <li>Durée : <?= $detailFilm["duree"]; ?></li>
    <li>Note : <?= $detailFilm["note"]; ?> / 5 </li>
    <!-- lien réalisateur -->
    <li>Réalisateur : <?= "<a href='index.php?action=detailReal&id=" . $detailFilm['idReal'] . "'><strong>" . $detailFilm["nomReal"] ?></strong></a></li>
    <p class="text-justify">Résumé : <?= $detailFilm["resumeFilm"]; ?></p>
    <ul style="list-style-type:none;">
      <li>
        <h3>Casting pour ce film : </h3>
      </li>
      <?php
      while ($casting = $castingFilm->fetch()) {
        echo "<li><a href='index.php?action=detailActeur&id=" .
          $casting['idActeur'] . "'>" . "<strong>" .
          $casting['identiteActeur'] . "</strong> </a> dans le role de : " . $casting['roleActeur'] . "</li>";
      }
      ?>
    </ul>
  </ul>
  </p>
  <!-- affiche du film -->
  <figure class=" col-4"><img style="width: 100%;" src="<?= $detailFilm['imgPath']; ?>" alt="affiche du film"></figure>
</div>

<?php

// On utilise closeCursor() pour éviter les erreurs s'il y a de multiples requêtes sur une même page
$film->closeCursor();
$titreOnglet = "Détail du Film";
$contenu = ob_get_clean();
require "views/template.php";
