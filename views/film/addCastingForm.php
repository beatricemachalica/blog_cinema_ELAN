<?php
ob_start();
// cette fonction permet de stocker (bufférisation) en mémoire tampon
?>

<h2 class="text-center">Ajouter un casting</h2>

<div class="content">

  <form action="./index.php?action=ajouterCasting" method="POST">

    <!-- choix du film -->
    <div class="form-group">
      <h4 class="text-center">Le film</h4>
      <p>
        <i class="fas fa-info-circle" style="color:cornflowerblue;"></i> Sélectionnez le film déjà existant
        <strong>ou</strong> ajoutez le ci-dessous.
      </p>
      <select class="form-control" name="film_casting" id="film_casting">
        <?php
        while ($film = $films->fetch()) {
          echo "<option value = " . $film['id_film'] . ">" . ucfirst($film['titre']) . "</option>";
        }
        ?>
      </select>

      <!-- bouton pour ajouter un film -->
      <div class="text-center">
        <p> <a href="index.php?action=ajouterFilmFormulaire" id="addFilm"><button type="button" class="btn btn-secondary">Ajouter un nouveau film <i class="fas fa-arrow-down"></i></button></a>
        </p>
      </div>
    </div>

    <!-- Choix de l'acteur -->
    <div class="form-group">
      <h4 class="text-center">L'acteur</h4>
      <p><i class="fas fa-info-circle" style="color:cornflowerblue;"></i> Sélectionnez un acteur déjà existant
        <strong>ou</strong> ajoutez le en cliquant sur le bouton ci-dessous.
      </p>
      <select class="form-control" name="acteur_casting" id="acteur_casting">
        <?php
        while ($acteur = $acteurs->fetch()) {
          echo "<option value = " . $acteur['id_acteur'] . " >"
            . $acteur["identiteActeur"] . "</option>";
        }
        ?>
      </select>

      <!-- bouton pour ajouter un acteur -->
      <div class="text-center">
        <p> <a href="index.php?action=ajouterActeurFormulaire" id="addActeur"><button type="button" class="btn btn-secondary">Inscrire un nouveau acteur <i class="fas fa-arrow-down"></i></button></a>
        </p>
      </div>
    </div>

    <!-- Création du rôle -->
    <div class="form-group">
      <label for="role">Role de l'acteur <span style="color: red;">*</span></label>
      <input type="text" class="form-control" name="role_casting" required>
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-primary">Ajouter le casting</button>
    </div>

  </form>
</div>

<?php
// On utilise closeCursor() pour éviter les erreurs s'il y a de multiples requêtes sur une même page
$films->closeCursor();
$acteurs->closeCursor();
$titreOnglet = "Ajouter un casting";
$contenu = ob_get_clean();
require "views/template.php";
