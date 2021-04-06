<?php
ob_start();
?>

<h2 class="text-center">Ajouter un film</h2>

<div class="content">
  <h4 class="text-center">Informations générales sur le film</h4>
  <form action="./index.php?action=#" method="POST">

    <div class="form-group">
      <label for="titre">Titre du film <span style="color: red;">*</span></label>
      <input type="text" class="form-control" id="titre" name="titre_film" placeholder="Life is Strange" required>
    </div>

    <div class="form-group">
      <label for="dateSortie">Date de sortie</label>
      <input type="text" class="form-control" id="dateSortie" name="dateSortie_film" placeholder="2018-01-31">
      <small id="dateSortieHelp" class="form-text text-muted">Ajoutez la date de sortie du film au format AAAA-MM-JJ.</small>
    </div>

    <div class="form-group">
      <label for="duree">Durée du film</label>
      <input type="text" class="form-control" id="duree" name="duree_film" placeholder="155">
      <small id="dureeHelp" class="form-text text-muted">Ajoutez la durée du film en minutes.</small>
    </div>

    <div class="form-group">
      <label for="resume">Résumé du film</label>
      <textarea class="form-control" id="resumeFilm" rows="3" name="resume_film"></textarea>
      <small id="resumeHelp" class="form-text text-muted">Ajoutez le résumé du film ci-dessus.</small>
    </div>

    <div class="form-group">
      <label for="note">Note du film sur 5 <i class="fas fa-star" style="color:tomato;"></i></label>
      <select class="form-control" id="note" name="note_film">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
      </select>
    </div>

    <div class="form-group">
      <label for="photo film">Affiche du film</label>
      <input type="text" class="form-control" id="affiche" name="affiche_film" placeholder="https://image.jeuxvideo.com/medias-md/146965/1469647081-8887-card.jpg">
      <small id="imgHelp" class="form-text text-muted">Ajoutez le lien (relatif ou absolu) de l'affiche du film ci-dessus.</small>
    </div>

    <div class="form-group">
      <h4 class="text-center">Le réalisateur</h4>
      <p><i class="fas fa-info-circle" style="color:cornflowerblue;"></i> Sélectionnez un réalisateur déjà existants <strong>ou</strong> ajoutez un réalisateur.</p>
      <select class="form-control" name="realisateur_film" id="selectReal">
        <?php
        while ($realisateur = $realisateurs->fetch()) {
          echo "<option value = '" . $realisateur['id_realisateur'] . "' >"
            . $realisateur["identiteRealisateur"] . "</option>";
        }
        // vérifier si data c'est en JS ou PHP ?
        ?>
      </select>

      <div class="text-center">
        <p>Ajouter un réalisateur ci-dessous</p>
        <a href="#" id="loadMore"><button type="button" class="btn btn-secondary">Formulaire d'inscription <i class="fas fa-arrow-down"></i></button></a>
      </div>
    </div>

    <div class="form-group">
      <h4 class="text-center">Le casting</h4>
      <p><i class="fas fa-info-circle" style="color:cornflowerblue;"></i> Sélectionnez les acteurs déjà existants du casting <strong>ou</strong> ajoutez des nouveaux acteurs ainsi que leurs rôles.</p>
      <select class="form-control" name="acteurs_film" id="selectActeurs">
        <?php //ajouter la sélection des acteurs ici avec un while $acteur = $acteurs->fetch()
        // echo "<option data-idActeur="$acteur[]"> nom de l'acteur . </option>"
        ?>
      </select>

      <div class="text-center">
        <p>Ajouter les acteurs ci-dessous</p>
        <a href="#" id="loadMore"><button type="button" class="btn btn-secondary">Formulaire d'inscription <i class="fas fa-arrow-down"></i></button></a>
      </div>
    </div>

    <div>
      <button type="submit" class="btn btn-primary">Ajouter le film</button>
    </div>

  </form>
</div>

<?php
$titreOnglet = "Ajouter un film";
$contenu = ob_get_clean();
require "views/template.php";
