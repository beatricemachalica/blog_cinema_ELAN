<?php
ob_start();
?>

<div style="text-align: center;">
  <h2>Voici les acteurs de mes films préférés ! </h2>
  <p>Il y a <?= $acteurs->rowCount(); ?> acteurs dans ce tableau. <br>
    N'hésitez pas à cliquer sur les noms pour avoir plus d'informations. </p>
</div>

<table class="table table-dark table-hover" id="tableListeFilms">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Sexe</th>
      <th>Age</th>
      <th>Date de naissance</th>
    </tr>
  </thead>
  <tbody>
    <?php
    while ($acteur = $acteurs->fetch()) {
      echo "<tr><td><a style='color:white' href='index.php?action=detailActeur&id=" . $acteur['id_acteur'] . "'>" . $acteur['nomActeur'] . "</a></td>";
      echo "<td>" . $acteur["sexe"] . "</td>";
      echo "<td>" . $acteur["age"] . " ans </td>";
      echo "<td>" . $acteur["dateNaissance"] . "</td>";
      echo "<td><a class='badge badge-light' href='index.php?action=modifierActeurForm&id=" . $acteur['id_acteur'] . "'><i class='fas fa-pen'></i></a></td>";
      echo "<td><a class='badge badge-danger' href='index.php?action=effacerActeur&id=" . $acteur['id_acteur'] . "'><i class='fas fa-times'></i></a></td></tr>";
    }
    ?>
  </tbody>
</table>
<a class="btn btn-primary" href="index.php?action=ajouterActeurFormulaire">Ajouter un acteur</a>
<?php

$acteurs->closeCursor();
$titreOnglet = "liste des acteurs";
$contenu = ob_get_clean();
require "views/template.php";
