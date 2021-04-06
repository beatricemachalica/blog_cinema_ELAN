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
    // on récupère les réalisateurs pour le formulaire

    $dao = new DAO();
    $sql = "SELECT id_realisateur, concat(prenom, ' ', nom) AS identiteRealisateur, sexe, dateNaissance
    FROM realisateur";
    $realisateurs = $dao->executerRequete($sql);

    // on récupère les acteurs pour le formulaire


    require "views/film/newFilmForm.php";
  }
}
