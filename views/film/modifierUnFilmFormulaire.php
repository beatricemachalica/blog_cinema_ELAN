<?php
ob_start();
// permet de stocker (bufférisation) en mémoire tampon

$editInfo = $edit1->fetch();

?>

<h2 class="text-center">Modifier un film</h2>

<div class="content">

  <form action="./index.php?action=modifierFilm&id=<?= $editInfo['idFilm']; ?>" method="POST">

    <div class="form-group">
      <h4 class="text-center">Le réalisateur</h4>
      <p><i class="fas fa-info-circle" style="color:cornflowerblue;"></i> Sélectionnez un réalisateur déjà existants <strong>ou</strong> ajoutez un réalisateur.</p>
      <select class="form-control" name="realisateur_film" id="selectReal">

        <?php
        while ($nomRealisateur = $edit4->fetch()) {
          echo "<option value = " . $nomRealisateur['id_realisateur'];
          if ($nomRealisateur['id_realisateur'] == $editInfo['id_realisateur']) {
            echo " selected";
          }
          echo ">" . ucfirst($nomRealisateur['realNom']) . "</option>";
        }
        ?>

      </select>

      <div class="text-center">
        <p> <a href="index.php?action=ajouterRealForm" id="addReal"><button type="button" class="btn btn-secondary">Inscrire un nouveau réalisateur <i class="fas fa-arrow-down"></i></button></a>
        </p>
      </div>
    </div>

    <?php
    // on va créer un tableau vide
    $tableauGenres = array();
    // on va push dans ce tableau les genres du film trouvés grâce à "edit2"
    while ($findIdGenres = $edit2->fetch())
      array_push($tableauGenres, $findIdGenres['id_genre']);
    ?>

    <div class="form-group">
      <h4 class="text-center">Le genre du film</h4>
      <p>
        <i class="fas fa-info-circle" style="color:cornflowerblue;">
        </i> Sélectionnez les genres déjà existants
        <strong>ou</strong> ajoutez des nouveaux genres de films.
      </p>
      <!-- les crochets de genref sont importants car on attend un tableau avec éventuellement plusieurs genres -->
      <select class="form-control" name="genref[]" id="genre_film" multiple>
        <?php
        while ($nomGenre = $edit3->fetch()) {
          echo "<option value = " . $nomGenre['id_genre'];
          if (in_array($nomGenre['id_genre'], $tableauGenres)) {
            echo " selected ";
          }
          echo ">" . ucfirst($nomGenre['libelle']) . "</option>";
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
      <input type="text" class="form-control" name="titre_film" value="<?php echo $editInfo['titre']; ?>" required>
    </div>

    <div class="form-group">
      <label for="dateSortie">Date de sortie</label>
      <input type="date" class="form-control" id="dateSortie" name="dateSortie_film" value="<?php echo $editInfo['dateSortie']; ?>">
      <small id="dateSortieHelp" class="form-text text-muted">Ajoutez la date de sortie du film au format AAAA-MM-JJ.</small>
    </div>

    <div class="form-group">
      <label for="duree">Durée du film</label>
      <input type="number" class="form-control" id="duree" name="duree_film" min="0" max="600" value="<?php echo $editInfo['duree']; ?>">
      <small id="dureeHelp" class="form-text text-muted">Ajoutez la durée du film en minutes.</small>
    </div>

    <div class="form-group">
      <label for="resume">Résumé du film</label>
      <textarea class="form-control" id="resumeFilm" rows="3" name="resume_film"><?php echo $editInfo['resume']; ?></textarea>
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
      <input type="text" class="form-control" id="affiche" name="affiche_film" value="<?php echo $editInfo['imgPath']; ?>">
      <small id="imgHelp" class="form-text text-muted">Ajoutez le lien (relatif ou absolu) de l'affiche du film ci-dessus.</small>
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-primary">Modifier le film</button>
    </div>

  </form>
</div>

<?php

$edit1->closeCursor();
$titreOnglet = "Modifier un film";
$contenu = ob_get_clean();
require "views/template.php";
