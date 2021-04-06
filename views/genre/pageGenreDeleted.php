<?php

ob_start();

?>


<div class="content text-center">
  <h2>Effacer un genre</h2>
  <p>Le genre de film a bien été effacé !</p>
  <a href="index.php?action=listGenres" class="btn btn-secondary">Retourner à la liste des genres</a>
</div>

<?php
$titreOnglet = "Effacer un genre";
$contenu = ob_get_clean();
require "views/template.php";
