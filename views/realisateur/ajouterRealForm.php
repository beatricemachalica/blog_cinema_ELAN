<?php

ob_start();

?>

<h2>Ajouter un réalisateur</h2>

<div class="content">
  <form action="./index.php?action=ajouterRealisateur" method="POST">
    <div class="form-group">
      <label for="nom réalisateur">Nom du réalisateur</label>
      <input type="text" class="form-control" id="nom_realisateur" name="nom_realisateur" placeholder="Nom" required>
    </div>
    <div class="form-group">
      <label for="prenom réalisateur">Prénom du réalisateur</label>
      <input type="text" class="form-control" id="prenom_realisateur" name="prenom_realisateur" placeholder="Prenom" required>
    </div>
    <div class="form-group">
      <label for="sexe réalisateur">Sexe</label>
      <input type="text" class="form-control" id="sexe" name="sexe" placeholder="Homme ou Femme">
    </div>
    <div class="form-group">
      <label for="dateNaissance réalisateur">Date de naissance</label>
      <input type="text" class="form-control" id="dateNaissance" name="dateNaissance" placeholder="1998-01-31">
      <small id="dateNaissanceHelp" class="form-text text-muted">Ajoutez la date de naissance au format AAAA-MM-JJ.</small>
    </div>
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Ces informations sont correctes</label>
    </div>
    <div>
      <button type="submit" class="btn btn-primary">Ajouter</button>
    </div>
  </form>
</div>

<?php
$titreOnglet = "Ajouter un réalisateur";
$contenu = ob_get_clean();
require "views/template.php";
