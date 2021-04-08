<?php

ob_start();

?>

<div class="content text-center">
  <h2>Suppresion d'un film</h2>
  <p>Le film <?php echo $titleDeletedMovie; ?> a bien été supprimé avec succès !</p>
  <a href="index.php?action=listFilms" class="btn btn-secondary">Retourner à la liste des films</a>
</div>

<?php
$titreOnglet = "Supprimer un film";
$contenu = ob_get_clean();
require "views/template.php";
