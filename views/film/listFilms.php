<?php

ob_start();

?>
<div style="text-align: center;">
  <h2>Voici mes films préférés ! </h2>
  <p>Il y a <?= $films->rowCount(); ?> films dans ce tableau. <br>
    N'hésitez pas à cliquer sur les titres des films ou
    sur les noms des réalisateurs pour avoir plus d'informations... </p>
</div>

<table class="table table-dark table-hover" id="tableListeFilms">
  <thead>
    <tr>
      <th>Titre du film</th>
      <th>Date de sortie</th>
      <th>Durée</th>
      <th>Nom du réalisateur</th>
      <th>Genre</th>
    </tr>
  </thead>
  <tbody>
    <?php
    while ($film = $films->fetch()) {
      echo "<tr><td><a style='color:white' href='index.php?action=detailFilm&id=" . $film['id_film'] . "'>" . $film['titre'] . "</a></td>";
      echo "<td>" . $film["dateSortie"] . "</td>";
      echo "<td>" . $film["duree"] . "</td>";
      echo "<td><a style='color:white' href='index.php?action=detailReal&id=" . $film['id_realisateur'] . "'>" . $film['nom'] . "</a></td>";
      echo "<td><a style='color:white' href='index.php?action=detailGenre&id=" . $film['genre'] . "'>" . ucfirst($film['genre']) . "</a></td>";
      echo "<td><a class='badge badge-light' href='index.php?action=modifierFilmForm&id=" . $film['id_film'] . "'><i class='fas fa-pen'></i></a></td>";
      echo "<td><a class='badge badge-danger' href='index.php?action=effacerFilm&id=" . $film['id_film'] . "'><i class='fas fa-times'></i></a></td></tr>";
    }
    ?>
  </tbody>
</table>
<a class="btn btn-primary" href="index.php?action=ajouterFilmFormulaire">Ajouter un film</a>
<?php

// On utilise closeCursor() pour éviter les erreurs s'il y a de multiples requêtes sur une même page
$films->closeCursor();
$titreOnglet = "liste des films";
$contenu = ob_get_clean();
require "views/template.php";
