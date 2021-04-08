<?php
ob_start();
// cette fonction permet de stocker (bufférisation) en mémoire tampon
?>

<h2 class="text-center">Ajouter un film</h2>

<div class="content">

  <form action="./index.php?action=ajouterFilm" method="POST">

    <div class="form-group">
      <h4 class="text-center">Le réalisateur</h4>
      <p><i class="fas fa-info-circle" style="color:cornflowerblue;"></i> Sélectionnez un réalisateur déjà existants <strong>ou</strong> ajoutez un réalisateur.</p>
      <select class="form-control" name="realisateur_film" id="selectReal">
        <?php
        while ($realisateur = $realisateurs->fetch()) {
          echo "<option value = " . $realisateur['id_realisateur'] . " >"
            . $realisateur["identiteRealisateur"] . "</option>";
        }
        ?>
      </select>

      <div class="text-center">
        <p> <a href="index.php?action=ajouterRealForm" id="addReal"><button type="button" class="btn btn-secondary">Inscrire un nouveau réalisateur <i class="fas fa-arrow-down"></i></button></a>
        </p>
      </div>
    </div>

    <div class="form-group">
      <h4 class="text-center">Le genre du film</h4>
      <p>
        <i class="fas fa-info-circle" style="color:cornflowerblue;"></i> Sélectionnez les genres déjà existants
        <strong>ou</strong> ajoutez des nouveaux genres de films.
      </p>
      <!-- les crochets de genref sont importants car on attend un tableau avec éventuellement plusieurs genres -->
      <select class="form-control" name="genref[]" id="genre_film" multiple>
        <?php
        while ($genre = $genres->fetch()) {
          echo "<option value = " . $genre['idGenre'] . ">" . ucfirst($genre['libelle']) . "</option>";
        }
        ?>
      </select>

      <div class="text-center">
        <p> <a href="index.php?action=ajouterGenreFormulaire" id="loadMore"><button type="button" class="btn btn-secondary">Ajouter un nouveau genre <i class="fas fa-arrow-down"></i></button></a>
        </p>
      </div>
    </div>

    <h4 class="text-center">Informations générales sur le film</h4>

    <div class="form-group">
      <label for="titre">Titre du film <span style="color: red;">*</span></label>
      <input type="text" class="form-control" id="titre_film" name="titre_film" placeholder="Life is Strange" required>
    </div>

    <div class="form-group">
      <label for="dateSortie">Date de sortie</label>
      <input type="date" class="form-control" id="dateSortie" name="dateSortie_film" placeholder="2018-01-31">
      <small id="dateSortieHelp" class="form-text text-muted">Ajoutez la date de sortie du film au format AAAA-MM-JJ.</small>
    </div>

    <div class="form-group">
      <label for="duree">Durée du film</label>
      <input type="number" class="form-control" id="duree" name="duree_film" min="0" max="600" placeholder="155">
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

    <div class="text-center">
      <button type="submit" class="btn btn-primary">Ajouter le film</button>
    </div>

  </form>
</div>

<?php
$titreOnglet = "Ajouter un film";
$contenu = ob_get_clean();
require "views/template.php";
