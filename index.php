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
  // (un utilisateur malveillant peut accéder à l'URL et injecter ce qu'il veut)

  switch ($_GET['action']) {
    case "accueil":
      $ctrlAccueil->pageAccueil();
      break;
    case "listFilms":
      $ctrlFilm->filmsList();
      break;
    case "detailFilm":
      $ctrlFilm->findOneById($id);
      break;
    case "detailActeur":
      $ctrlActeur->findOneById($id);
      break;
    case "listActeurs":
      $ctrlActeur->findAll();
      break;
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
      $ctrlReal->editRealisateur($_POST, $id);
      break;
    case "detailReal":
      $ctrlReal->findOneById($id);
      break;
  }
} else {
  $ctrlAccueil->pageAccueil();
}
