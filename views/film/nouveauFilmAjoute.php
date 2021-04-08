<?php

ob_start();

?>

<div class="content text-center">
  <h2>Ajouter un film</h2>
  <p>Le film a bien été ajouté avec succès !</p>
  <a href="index.php?action=listFilms" class="btn btn-secondary">Retourner à la liste des films</a>
</div>

<?php
$titreOnglet = "Ajouter un film";
$contenu = ob_get_clean();
require "views/template.php";
