<?php
ob_start();
?>

<h2 class="text-center">Ajouter un genre de film</h2>

<div class="content">
  <form action="./index.php?action=ajouterGenre" method="POST">
    <div class="form-group">
      <label for="Libelle du genre">Libelle du genre</label>
      <input type="text" class="form-control" id="libelle_genre" name="libelle_genre" placeholder="Comédie" required>
    </div>

    <div>
      <button type="submit" class="btn btn-primary">Ajouter le genre</button>
    </div>

  </form>
</div>

<?php
$titreOnglet = "Ajouter un genre de film";
$contenu = ob_get_clean();
require "views/template.php";
