<?php

require_once "bdd/DAO.php";

class ActeurController
{
  public function findAll()
  {
    $dao = new DAO();
    $sql = "SELECT id_acteur, concat(prenom, ' ', nom) as nomActeur, sexe, dateNaissance, YEAR(CURRENT_TIMESTAMP) - YEAR(dateNaissance) AS age
    FROM acteur";
    $acteurs = $dao->executerRequete($sql);
    require "views/acteur/listActeurs.php";
  }

  public function findOneById($id)
  {
    $dao = new DAO();
    $sql = "SELECT a.id_acteur, concat(prenom, ' ', nom) as nomActeur, sexe, dateNaissance, GROUP_CONCAT(f.titre ORDER BY f.titre SEPARATOR ', ') AS titre, a.imgPath AS imgPath
    FROM acteur a
    LEFT JOIN casting c ON c.id_acteur = a.id_acteur
    LEFT JOIN film f ON f.id_film = c.id_film
    WHERE a.id_acteur = :id";
    $acteur = $dao->executerRequete($sql, [":id" => $id]);
    require "views/acteur/detailActeur.php";
  }

  public function addActeurForm()
  {
    require "views/acteur/ajouterActeurForm.php";
  }

  public function addOneActeur($array)
  {
    $dao = new DAO();
    // corriger le code ci-dessous
    $sql = "INSERT INTO realisateur(nom_realisateur, prenom, sexe)
    VALUES (:nom, :prenom, :sexe)";
    $nom_realisateur = filter_var($array['nom_realisateur'], FILTER_SANITIZE_STRING);
    // faire la même chose pour toutes les values
    $ajout = $dao->executerRequete($sql, [":nom" => $nom_realisateur, ":prenom" => $prenom_realisateur, ":sexe" => $sexe]);
    require "views/acteur/ajouterActeur.php";
  }

  // corriger le code ci-dessous
  public function modifierRealForm($id)
  {
    $realisateur = $this->findOneById($id, TRUE);
    require "views/acteur/editActeur.php";
  }

  public function editReal($id, $array)
  {
    // à completer
    header("Location:index.php?action=listRealisateurs");
  }
}
