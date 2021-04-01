<?php

ob_start();
$director = $realisateur->fetch();

?>

<h2>Modifier un réalisateur</h2>

<div class="content">
  <form action="./index.php?action=modifierRealisateur&id=<?= $director['id_realisateur']; ?>" method="POST">
    <div class="form-group">
      <label for="nom réalisateur">Nom du réalisateur</label>
      <input type="text" class="form-control" id="nom_realisateur" name="nom_realisateur" value="<?= $director['nom']; ?>">
    </div>
    <div class="form-group">
      <label for="prenom réalisateur">Prénom du réalisateur</label>
      <input type="text" class="form-control" id="prenom_realisateur" name="prenom_realisateur" value="<?= $director['prenom']; ?>">
    </div>
    <div class="form-group">
      <label for="sexe réalisateur">Sexe</label>
      <input type="text" class="form-control" id="sexe" name="sexe_realisateur" value="<?= $director['sexe']; ?>">
    </div>
    <div class="form-group">
      <label for="dateNaissance réalisateur">Date de naissance</label>
      <input type="text" class="form-control" id="dateNaissance" name="dateNaissance_realisateur" value="<?= $director['dateNaissance']; ?>">
      <small id="dateNaissanceHelp" class="form-text text-muted">Ajoutez la date de naissance au format AAAA-MM-JJ.</small>
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
$titreOnglet = "Modifier un réalisateur";
$contenu = ob_get_clean();
require "views/template.php";
