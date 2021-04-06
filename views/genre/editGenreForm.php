<?php
ob_start();
$infoGenre = $genre->fetch();
// libelle, id_genre AS idGenre
?>

<h2>Modifier un genre</h2>

<div class="content">
  <form action="./index.php?action=modifierGenre&id=<?= $infoGenre['idGenre']; ?>" method="POST">

    <div class="form-group">
      <label for="libelle genre">Libellé du Genre</label>
      <input type="text" class="form-control" id="libelle_genre" name="libelle_genre" value="<?= $infoGenre['libelle']; ?>">
    </div>

    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Ces informations sont correctes</label>
    </div>

    <div>
      <button type="submit" class="btn btn-primary">Modifier le genre</button>
    </div>
  </form>
</div>

<?php
$titreOnglet = "Modifier un genre de film";
$contenu = ob_get_clean();
require "views/template.php";
