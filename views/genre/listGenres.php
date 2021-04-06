<?php
// $sql = "SELECT libelle, id_genre AS idGenre
// FROM genre";
// $genres = $dao->executerRequete($sql);

ob_start();

?>
<div style="text-align: center;">
  <h2>Voici les genres de films </h2>
  <p>Il y a <?= $genres->rowCount(); ?> genres de film dans ce tableau. Cliquez sur un genre pour avoir la liste des films.</p>
</div>

<table class="table table-dark table-hover" id="tableListeGenres">
  <thead>
    <tr>
      <th>Les Genres de Films</th>
    </tr>
  </thead>
  <tbody>
    <?php
    while ($genre = $genres->fetch()) {
      echo "<tr><td><a style='color:white' href='index.php?action=####&id=" .
        $genre['idGenre'] . "'>" . ucfirst($genre['libelle']) . "</a></td>";
      echo "<td><a class='badge badge-light' href='index.php?action=modifierGenreForm&id=" . $genre['idGenre'] . "'><i class='fas fa-pen'></i></a></td>";
      echo "<td><a class='badge badge-danger' href='index.php?action=effacerGenre&id=" . $genre['idGenre'] . "'><i class='fas fa-times'></i></a></td></tr>";
    }
    ?>
  </tbody>
</table>
<a class="btn btn-primary" href="index.php?action=ajouterGenreFormulaire">Ajouter un genre</a>
<?php

// On utilise closeCursor() pour éviter les erreurs s'il y a de multiples requêtes sur une même page
$genres->closeCursor();
$titreOnglet = "liste des genres";
$contenu = ob_get_clean();
require "views/template.php";
