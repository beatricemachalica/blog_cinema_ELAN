<?php

ob_start();

?>
<div style="text-align: center;">
  <h2>Les réalisateurs de mes films préférés ! </h2>
  <p>Il y a <?= $realisateurs->rowCount(); ?> réalisateurs dans ce tableau. <br>
    N'hésitez pas à cliquer sur les noms pour avoir plus d'informations. </p>
</div>
<table class="table table-dark table-hover" id="tableListeFilms">
  <thead>
    <tr>
      <th>Les réalisateurs</th>
      <th>Sexe</th>
      <th>Age</th>
      <th>Date de naissance</th>
    </tr>
  </thead>
  <tbody>
    <?php
    while ($realisateur = $realisateurs->fetch()) {
      echo "<tr><td><a style='color:white' href='index.php?action=detailReal&id=" .
        $realisateur['id_realisateur'] . "'>" . $realisateur['identiteRealisateur'] . "</a></td>";
      echo "<td>" . $realisateur["sexe"] . "</td>";
      echo "<td>" . $realisateur["age"] . " ans </td>";
      echo "<td>" . $realisateur["dateNaissance"] . "</td>";
      echo "<td><a class='badge badge-light' href='index.php?action=modifierRealForm&id=" . $realisateur['id_realisateur'] . "'><i class='fas fa-pen'></i></a></td>";
      echo "<td><a class='badge badge-danger' href='index.php?action=effacerRealisateur&id=" . $realisateur['id_realisateur'] . "'><i class='fas fa-times'></i></a></td></tr>";
    }
    ?>
  </tbody>
</table>
<a class="btn btn-primary" href="index.php?action=ajouterRealForm">Ajouter un réalisateur</a>
<?php

$realisateurs->closeCursor();
$titreOnglet = "liste des réalisateurs";
$contenu = ob_get_clean();
require "views/template.php";
