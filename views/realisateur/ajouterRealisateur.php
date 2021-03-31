<?php

ob_start();

?>


<div class="content text-center">
  <h2>Ajouter un réalisateur</h2>
  <p>Votre réalisateur a été ajouté avec succès !</p>
  <a href="index.php?action=listRealisateurs" class="btn btn-secondary">Retourner à la liste des réalisateurs</a>
</div>

<?php
$titreOnglet = "Un nouveau réalisateur a été ajouté";
$contenu = ob_get_clean();
require "views/template.php";
