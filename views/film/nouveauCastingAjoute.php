<?php

ob_start();

?>

<div class="content text-center">
  <h2>Ajouter un casting</h2>
  <p>Le casting a bien été ajouté avec succès !</p>
  <a href="index.php?action=listFilms" class="btn btn-secondary">Retourner à la liste des films</a>
</div>


<?php
var_dump($_POST);
$titreOnglet = "Ajouter un casting";
$contenu = ob_get_clean();
require "views/template.php";
