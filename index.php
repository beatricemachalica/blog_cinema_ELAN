<?php
// http://localhost/blogCine_ELAN/index.php

require_once "controllers/AccueilController.php";
require_once "controllers/FilmController.php";
require_once "controllers/RealController.php";
require_once "controllers/ActeurController.php";

$ctrlAccueil = new AccueilController;
$ctrlFilm = new FilmController;
$ctrlReal = new RealController;
$ctrlActeur = new ActeurController;

if (isset($_GET['action'])) {

  $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);
  // $id = ($_GET['id']);
  // pour la sécurité (faille XSS par exemple), 
  // on rajoute un filter_input puisque l'id se trouve dans l'URL 
  // or, un utilisateur malveillant peut accéder à l'URL et injecter ce qu'il veut (comme du script)

  switch ($_GET['action']) {
      // case accueil
    case "accueil":
      $ctrlAccueil->pageAccueil();
      break;
      // cases des films
    case "listFilms":
      $ctrlFilm->filmsList();
      break;
    case "detailFilm":
      $ctrlFilm->findOneById($id);
      break;
    case "ajouterFilmFormulaire":
      $ctrlFilm->addFilmForm();
      break;
    case "ajouterFilm":
      $ctrlFilm->addFilm($_POST);
      break;
    case "effacerFilm":
      $ctrlFilm->deleteFilmById($id);
      break;
    case "modifierFilmForm":
      $ctrlFilm->modifFilmForm($id);
      break;
    case "modifierFilm":
      $ctrlFilm->editFilm($id, $_POST);
      break;
      // cases des acteurs
    case "detailActeur":
      $ctrlActeur->findOneById($id);
      break;
    case "listActeurs":
      $ctrlActeur->findAll();
      break;
    case "ajouterActeurFormulaire":
      $ctrlActeur->addActeurForm();
      break;
    case "ajouterActeur":
      $ctrlActeur->addActeur($_POST);
      break;
    case "effacerActeur":
      $ctrlActeur->deleteOneById($id);
      break;
    case "modifierActeurForm":
      $ctrlActeur->modifActeurForm($id);
      break;
    case "modifierActeur":
      $ctrlActeur->editActeur($id, $_POST);
      break;
      // cases des réalisateurs
    case "listRealisateurs":
      $ctrlReal->findAll();
      break;
    case "ajouterRealForm":
      $ctrlReal->addRealForm();
      break;
    case "ajouterRealisateur":
      $ctrlReal->addReal($_POST);
      break;
    case "effacerRealisateur":
      $ctrlReal->deleteOneById($id);
      break;
    case "modifierRealForm":
      $ctrlReal->modifierRealisateurForm($id);
      break;
    case "modifierRealisateur":
      $ctrlReal->editRealisateur($id, $_POST);
      break;
    case "detailReal":
      $ctrlReal->findOneById($id);
      break;
      // cases des genres
    case "listGenres":
      $ctrlFilm->listGenres();
      break;
    case "ajouterGenreFormulaire":
      $ctrlFilm->addGenreForm();
      break;
    case "ajouterGenre":
      $ctrlFilm->addGenre($_POST);
      break;
    case "effacerGenre":
      $ctrlFilm->deleteOneGenreById($id);
      break;
    case "modifierGenreForm":
      $ctrlFilm->modifGenreForm($id);
      break;
    case "modifierGenre":
      $ctrlFilm->editGenre($id, $_POST);
      break;
  }
} else {
  $ctrlAccueil->pageAccueil();
}
