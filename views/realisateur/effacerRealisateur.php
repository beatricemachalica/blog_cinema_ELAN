<?php

ob_start();

?>


<div class="content text-center">
  <h2>Effacer un réalisateur</h2>
  <p>Votre réalisateur a bien été effacé !</p>
  <a href="index.php?action=listRealisateurs" class="btn btn-secondary">Retourner à la liste des réalisateurs</a>
</div>

<?php
$titreOnglet = "Effacer un réalisateur";
$contenu = ob_get_clean();
require "views/template.php";
