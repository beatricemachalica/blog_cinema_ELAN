<?php

ob_start();
$infoActeur = $acteur->fetch();

?>

<h2>Modifier un acteur</h2>

<div class="content">
  <form action="./index.php?action=modifierActeur&id=<?= $infoActeur['idActeur']; ?>" method="POST">
    <div class="form-group">
      <label for="nom acteur">Nom de l'acteur</label>
      <input type="text" class="form-control" id="nom_acteur" name="nom_acteur" value="<?= $infoActeur['nom']; ?>">
    </div>
    <div class="form-group">
      <label for="prenom acteur">Prénom de l'acteur</label>
      <input type="text" class="form-control" id="prenom_acteur" name="prenom_acteur" value="<?= $infoActeur['prenom']; ?>">
    </div>
    <div class="form-group">
      <label for="sexe acteur">Sexe</label>
      <input type="text" class="form-control" id="sexe" name="sexe_acteur" value="<?= $infoActeur['sexe']; ?>">
    </div>
    <div class="form-group">
      <label for="dateNaissance acteur">Date de naissance</label>
      <input type="text" class="form-control" id="dateNaissance" name="dateNaissance_acteur" value="<?= $infoActeur['dateNaissance']; ?>">
      <small id="dateNaissanceHelp" class="form-text text-muted">Ajoutez la date de naissance au format AAAA-MM-JJ.</small>
    </div>
    <div class="form-group">
      <label for="photo acteur">Photo de l'acteur</label>
      <input type="text" class="form-control" id="photo" name="photo_acteur" value="<?= $infoActeur['imgPath']; ?>">
      <small id="imgHelp" class="form-text text-muted">Ajoutez le lien (relatif ou absolu) de l'image de l'acteur.</small>
    </div>
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Ces informations sont correctes</label>
    </div>
    <div>
      <button type="submit" class="btn btn-primary">Modifier</button>
    </div>
  </form>
</div>

<?php
$titreOnglet = "Modifier un acteur";
$contenu = ob_get_clean();
require "views/template.php";
