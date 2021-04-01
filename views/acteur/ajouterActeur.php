<?php

ob_start();

?>


<div class="content text-center">
  <h2>Ajouter un acteur</h2>
  <p>L'acteur a été ajouté avec succès !</p>
  <a href="index.php?action=listActeurs" class="btn btn-secondary">Retourner à la liste des acteurs</a>
</div>

<?php
$titreOnglet = "Un nouveau acteur";
$contenu = ob_get_clean();
require "views/template.php";
