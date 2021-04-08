<?php

require_once "bdd/DAO.php";

class FilmController
{

  // méthode pour afficher la liste des films
  public function filmsList()
  {
    $dao = new DAO();
    $sql =
      "SELECT f.id_film, f.titre, f.dateSortie, TIME_FORMAT(SEC_TO_TIME(f.duree*60), '%Hh%i') AS duree, noteFilm, f.id_realisateur, concat(r.prenom,' ',r.nom) AS nom,
      GROUP_CONCAT(libelle ORDER BY libelle SEPARATOR ', ') AS genre  
      FROM film f
      LEFT JOIN avoir a
      ON a.id_film = f.id_film
      LEFT JOIN genre g
      ON g.id_genre = a.id_genre
      LEFT JOIN realisateur r
      ON r.id_realisateur = f.id_realisateur
      GROUP BY f.id_film
      ORDER BY f.titre DESC";
    $films = $dao->executerRequete($sql);
    require "views/film/listFilms.php";
    // pour avoir seulement l'année pour la dateSortie : DATE_FORMAT(f.dateSortie, ('%Y')) AS dateSortie
  }

  // méthode pour récupérer les informations d'un film et d'un casting via l'id
  public function findOneById($id)
  {
    $dao = new DAO();
    $sql = "SELECT id_film, f.titre AS titre, f.noteFilm AS note, f.dateSortie, TIME_FORMAT(SEC_TO_TIME(f.duree*60), '%Hh%i') AS duree, f.id_realisateur AS idReal, concat(r.prenom,' ',r.nom) AS nomReal, resume AS resumeFilm, f.imgPath
    FROM film f
    INNER JOIN realisateur r
    ON r.id_realisateur = f.id_realisateur
    WHERE f.id_film = :id";
    $film = $dao->executerRequete($sql, [":id" => $id]);

    // le casting du film

    $sql2 = "SELECT f.titre AS titre, f.imgPath, CONCAT(a.prenom, ' ',a.nom) AS identiteActeur, r.role AS roleActeur, a.sexe, a.dateNaissance, a.id_acteur AS idActeur
    FROM film f
    INNER JOIN casting c
    ON c.id_film = f.id_film
    INNER JOIN acteur a
    ON a.id_acteur = c.id_acteur
    INNER JOIN role r
    ON c.id_role = r.id_role
    WHERE f.id_film = :id";
    $castingFilm = $dao->executerRequete($sql2, [":id" => $id]);

    require "views/film/detailFilm.php";
  }

  // méthode pour afficher la liste des genres
  public function listGenres()
  {
    $dao = new DAO();
    $sql = "SELECT libelle, id_genre AS idGenre
    FROM genre";
    $genres = $dao->executerRequete($sql);
    require "views/genre/listGenres.php";
  }

  // méthode pour ajouter un genre de film
  public function addGenreForm()
  {
    require "views/genre/ajouterGenreForm.php";
  }

  // méthode pour ajouter un genre à partir du formulaire de "ajouterGenreForm.php"
  public function addGenre($array)
  {

    $dao = new DAO();
    $sql = "INSERT INTO genre(libelle)
    VALUES (:libelle)";
    $libelleGenre = filter_var($array["libelle_genre"], FILTER_SANITIZE_STRING);

    $ajout = $dao->executerRequete($sql, [
      ':libelle' => $libelleGenre
    ]);
    header("Location:index.php?action=listGenres");
  }

  // méthode pour supprimer un genre de film
  public function deleteOneGenreById($id)
  {
    $dao = new DAO();
    $sql = "DELETE FROM genre
    WHERE id_genre = :id";
    $genre = $dao->executerRequete($sql, [":id" => $id]);
    require "views/genre/pageGenreDeleted.php";
  }

  // méthode pour afficher un formulaire pour modifier un genre
  public function modifGenreForm($id)
  {
    $dao = new DAO();
    $sql = "SELECT libelle, id_genre AS idGenre
    FROM genre
    WHERE id_genre = :id";
    $genre = $dao->executerRequete($sql, [":id" => $id]);
    require "views/genre/editGenreForm.php";
  }

  // méthode pour traiter les données du formulaire de "editGenreForm.php"
  public function editGenre($id, $array)
  {
    $libelleGenre = filter_var($array["libelle_genre"], FILTER_SANITIZE_STRING);

    $dao = new DAO();
    $sql = "UPDATE genre
    SET libelle = :libelle
    WHERE id_genre = :id";
    $dao->executerRequete($sql, [
      ':id' => $id,
      ':libelle' => $libelleGenre
    ]);
    header("Location:index.php?action=listGenres");
  }

  // méthode pour ajouter un film
  public function addFilmForm()
  {

    $dao = new DAO();

    // on récupère les réalisateurs pour le formulaire
    $sql = "SELECT id_realisateur, concat(prenom, ' ', nom) AS identiteRealisateur, sexe, dateNaissance
    FROM realisateur";
    $realisateurs = $dao->executerRequete($sql);

    // on récupère les genres pour le formulaire
    $sql2 = "SELECT id_genre AS idGenre, libelle
    FROM genre";
    $genres = $dao->executerRequete($sql2);

    require "views/film/newFilmForm.php";
  }

  // méthode pour traiter les informations du formulaire de "newFilmForm.php"
  public function addFilm($array)
  {
    $dao = new DAO();

    $sql1 = "INSERT INTO film(titre, dateSortie, resume, noteFilm, imgPath, duree, id_realisateur)
    VALUES (:titre, :dateSortie, :resume, :noteFilm, :imgPath, :duree, :idRealisateur)";

    $titre = filter_var($array['titre_film'], FILTER_SANITIZE_STRING);
    $dateSortie = filter_var($array['dateSortie_film'], FILTER_SANITIZE_STRING);
    $resume = filter_var($array['resume_film'], FILTER_SANITIZE_STRING);
    $noteFilm = filter_var($array['note_film'], FILTER_SANITIZE_STRING);
    $affiche = filter_var($array['affiche_film'], FILTER_SANITIZE_STRING);
    $duree = filter_var($array['duree_film'], FILTER_SANITIZE_STRING);
    $realisateur = filter_var($array['realisateur_film'], FILTER_SANITIZE_STRING);

    $ajout = $dao->executerRequete($sql1, [
      ":titre" => $titre,
      ":dateSortie" => $dateSortie,
      ":resume" => $resume,
      ":noteFilm" => $noteFilm,
      ":imgPath" => $affiche,
      ":duree" => $duree,
      ":idRealisateur" => $realisateur
    ]);

    // puis on fait une seconde requête pour le genre du film
    $lastId = $dao->getBdd()->lastInsertId();

    $sql2 = "INSERT INTO avoir(id_genre, id_film) 
    VALUES (:idGenre, :idFilm)";

    $genre_film = filter_var_array($array['genref'], FILTER_SANITIZE_STRING);

    foreach ($genre_film as $valueGenre) {
      $ajoutGenre = $dao->executerRequete($sql2, [":idGenre" => $valueGenre, ":idFilm" => $lastId]);
    }

    require "views/film/nouveauFilmAjoute.php";
  }

  // méthode pour effacer un film
  public function deleteFilmById($id)
  {
    $dao = new DAO();

    // on garde le titre pour l'afficher plus tard
    $sql0 = "SELECT id_film, titre 
    FROM film
    WHERE id_film = :id";
    $film = $dao->executerRequete($sql0, [":id" => $id]);
    $deletedMovie = $film->fetch(PDO::FETCH_ASSOC);
    $titleDeletedMovie = $deletedMovie['titre'];

    // on doit d'abord effacer le casting
    $sql1 = "DELETE FROM casting
    WHERE id_film = :id";
    // puis, on doit effacer les informations dans la table associative "avoir"
    $sql2 = "DELETE FROM avoir
    WHERE id_film = :id";
    // enfin, on va effacer le film (à la fin car avec les clés étrangères on risque d'avoir des problèmes)
    $sql3 = "DELETE FROM film
    WHERE id_film = :id";

    // c'est important d'effacer d'abord les "traces"
    $deleteCasting = $dao->executerRequete($sql1, [":id" => $id]);
    $deleteAvoir = $dao->executerRequete($sql2, [":id" => $id]);
    $deletefilm = $dao->executerRequete($sql3, [":id" => $id]);

    require "views/film/filmEfface.php";
  }

  // méthode pour afficher un formulaire pour modifier un film
  public function modifFilmForm($id)
  {
    $dao = new DAO();
    $sql1 = ("SELECT id_film AS 'idFilm', titre, dateSortie, resume, noteFilm, imgPath, duree, id_realisateur
    FROM film
    WHERE id_film = :id");
    $edit1 = $dao->executerRequete($sql1, [":id" => $id]);

    $sql2 = ("SELECT id_genre, id_film FROM avoir WHERE id_film = :id");
    $edit2 = $dao->executerRequete($sql2, [":id" => $id]);

    $sql3 = ("SELECT id_genre, libelle FROM genre");
    $edit3 = $dao->executerRequete($sql3);

    $sql4 = ("SELECT DISTINCT concat(prenom,' ', nom) AS realNom, id_realisateur FROM realisateur");
    $edit4 = $dao->executerRequete($sql4);

    require "views/film/modifierUnFilmFormulaire.php";
  }

  // méthode pour afficher un formulaire pour modifier un film
  public function editFilm($id, $array)
  {
    $dao = new DAO();

    $titre = filter_var($array['titre_film'], FILTER_SANITIZE_STRING);
    $dateSortie = filter_var($array['dateSortie_film'], FILTER_SANITIZE_STRING);
    $resume = filter_var($array['resume_film'], FILTER_SANITIZE_STRING);
    $noteFilm = filter_var($array['note_film'], FILTER_SANITIZE_STRING);
    $affiche = filter_var($array['affiche_film'], FILTER_SANITIZE_STRING);
    $duree = filter_var($array['duree_film'], FILTER_SANITIZE_STRING);
    $realisateur = filter_var($array['realisateur_film'], FILTER_SANITIZE_STRING);
    $genre_film = filter_var_array($array['genref'], FILTER_SANITIZE_STRING);

    $sql = "UPDATE film
    SET titre = :titre,
    dateSortie = :dateSortie,
    resume = :resume,
    noteFilm = :noteFilm,
    imgPath = :imgPath,
    duree = :duree,
    id_realisateur = :id_realisateur
    WHERE id_film = :id";

    $dao->executerRequete($sql, [
      ':id' => $id,
      ':titre' => $titre,
      ':dateSortie' => $dateSortie,
      ':resume' => $resume,
      ':noteFilm' => $noteFilm,
      ':imgPath' => $affiche,
      ':duree' => $duree,
      ':id_realisateur' => $realisateur
    ]);

    $sql2 = "DELETE FROM avoir 
    WHERE id_film = :id";
    $delete = $dao->executerRequete($sql2, [":id" => $id]);
    // on supprime tous les genres du film en question pour les remettre ensuite
    // ceci est obligatoire car on travail sur une table associative

    $sql3 = "INSERT INTO avoir(id_genre, id_film)
    VALUES (:idGenre, :idFilm)";

    foreach ($genre_film as $genreActuel1) {
      $genreActuel2 = filter_var($genreActuel1, FILTER_SANITIZE_STRING);
      $addGenre = $dao->executerRequete($sql3, [":idGenre" => $genreActuel2, ":idFilm" => $id]);
    }

    header("Location:index.php");
  }

  // faire une méthode pour ajouter des castings dans le détail du film (acteurs + rôles)
  // méthode qui affiche un formulaire pour ajouter un casting
  // public function addCastingForm()
  // {
  // on affiche un formulaire avec require
  // }

  // méthode qui va traiter les informations du formulaire pour ajouter un casting
  // public function addCastingForm()
  // {
  // on recupère les informations du formulaire avec POST
  // on doit filtrer les infos puis insert into etc.
  // on require ou on redirige vers le détail du film
  // }
}
