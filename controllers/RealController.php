<?php

require_once "bdd/DAO.php";

class RealController
{
  public function findAll()
  {
    $dao = new DAO();
    $sql = "SELECT id_realisateur, concat(prenom, ' ', nom) AS identiteRealisateur, sexe, dateNaissance
    FROM realisateur";
    $realisateurs = $dao->executerRequete($sql);
    require "views/realisateur/listRealisateurs.php";
  }

  public function findOneById($id)
  {
    $dao = new DAO();
    $sql = "SELECT r.id_realisateur, concat(r.prenom,' ',r.nom) AS nom, sexe, dateNaissance, f.titre AS titre
    FROM realisateur r
    INNER JOIN film f
    ON f.id_realisateur = r.id_realisateur
    WHERE r.id_realisateur = :id";
    $realisateur = $dao->executerRequete($sql, [":id" => $id]);
    require "views/realisateur/detailReal.php";
  }

  public function addRealForm()
  {
    require "views/realisateur/ajouterRealForm.php";
  }

  public function addReal($array)
  {
    $dao = new DAO();
    $sql = "INSERT INTO realisateur(nom, prenom, sexe, dateNaissance)
    VALUES (:nom, :prenom, :sexe, :dateNaissance)";
    $nom_realisateur = filter_var($array['nom_realisateur'], FILTER_SANITIZE_STRING);
    $prenom_realisateur = filter_var($array['prenom_realisateur'], FILTER_SANITIZE_STRING);
    $sexe = filter_var($array['sexe'], FILTER_SANITIZE_STRING);
    $dateNaissance = filter_var($array['dateNaissance'], FILTER_SANITIZE_STRING);

    $ajout = $dao->executerRequete($sql, [":nom" => $nom_realisateur, ":prenom" => $prenom_realisateur, ":sexe" => $sexe, ":dateNaissance" => $dateNaissance]);
    require "views/realisateur/ajouterRealisateur.php";
  }

  public function modifierRealisateurForm($id)
  {
    $realisateur = $this->findOneById($id, true);
    require "views/realisateur/editReal.php";
    // pourquoi nous avons un true en paramètre ?
  }

  public function editRealisateur($id, $array)
  {
    // filtrer les variables du formulaire
    // faire un update
    // require views/... ou header location
    header("Location:index.php?action=listRealisateurs");
  }
}
// fonctionnalités à ajouter par la suite :
// pouvoir ajouter des réalisateurs
// pouvoir ajouter des acteurs
// pouvoir ajouter des genres (non prioritaire)
// pouvoir ajouter des films (attention, à la fin car il faut les relier dans le bdd)
