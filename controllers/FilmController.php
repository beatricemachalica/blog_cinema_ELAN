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

  public function addFilmForm()
  {
    // on récupère les réalisateurs pour le formulaire

    $dao = new DAO();
    $sql = "SELECT id_realisateur, concat(prenom, ' ', nom) AS identiteRealisateur, sexe, dateNaissance
    FROM realisateur";
    $realisateurs = $dao->executerRequete($sql);

    require "views/film/newFilmForm.php";
  }
}
