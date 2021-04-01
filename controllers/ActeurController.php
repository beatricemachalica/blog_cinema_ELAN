<?php

require_once "bdd/DAO.php";

class ActeurController
{

  // méthode pour afficher une liste des acteurs
  public function findAll()
  {
    $dao = new DAO();
    $sql = "SELECT id_acteur, concat(prenom, ' ', nom) as nomActeur, sexe, dateNaissance, YEAR(CURRENT_TIMESTAMP) - YEAR(dateNaissance) AS age
    FROM acteur";
    $acteurs = $dao->executerRequete($sql);
    require "views/acteur/listActeurs.php";
  }

  // méthode pour récuperer les informations d'un acteur à l'aide de l'id
  public function findOneById($id, $edit = false)
  {
    $dao = new DAO();
    $sql = "SELECT a.id_acteur AS idActeur, concat(prenom, ' ', nom) as nomActeur, a.prenom AS prenom, a.nom AS nom, sexe, dateNaissance, GROUP_CONCAT(f.titre ORDER BY f.titre SEPARATOR ', ') AS titre, a.imgPath AS imgPath
    FROM acteur a
    LEFT JOIN casting c ON c.id_acteur = a.id_acteur
    LEFT JOIN film f ON f.id_film = c.id_film
    WHERE a.id_acteur = :id";
    $acteur = $dao->executerRequete($sql, [":id" => $id]);

    if (!$edit) {
      require "views/acteur/detailActeur.php";
    } else {
      return $acteur;
    }
  }

  // méthode pour afficher un formulaire pour ajouter un acteur
  public function addActeurForm()
  {
    require "views/acteur/ajouterActeurForm.php";
  }

  // méthode pour traiter les informations du formulaire de "ajouterActeurForm.php"
  public function addActeur($array)
  {
    $dao = new DAO();
    $sql = "INSERT INTO acteur(nom, prenom, sexe, dateNaissance, imgPath)
    VALUES (:nom, :prenom, :sexe, :dateNaissance, :imgPath)";
    $nom_acteur = filter_var($array['nom_acteur'], FILTER_SANITIZE_STRING);
    $prenom_acteur = filter_var($array['prenom_acteur'], FILTER_SANITIZE_STRING);
    $sexe = filter_var($array['sexe'], FILTER_SANITIZE_STRING);
    $dateNaissance = filter_var($array['dateNaissance'], FILTER_SANITIZE_STRING);
    $photoActeur = filter_var($array["photo_acteur"], FILTER_SANITIZE_STRING);

    $ajout = $dao->executerRequete($sql, [
      ":nom" => $nom_acteur,
      ":prenom" => $prenom_acteur,
      ":sexe" => $sexe,
      ":dateNaissance" => $dateNaissance,
      ":imgPath" => $photoActeur
    ]);
    require "views/acteur/ajouterActeur.php";
  }

  // méthode pour supprimer un acteur 
  public function deleteOneById($id)
  {
    $dao = new DAO();
    $sql = "DELETE FROM acteur
    WHERE id_acteur = :id";
    $acteur = $dao->executerRequete($sql, [":id" => $id]);
    require "views/acteur/effacerActeur.php";
  }

  // méthode qui va afficher un formulaire 
  // (pour modifier les informations d'un acteur)
  public function modifActeurForm($id)
  {
    $acteur = $this->findOneById($id, true);
    require "views/acteur/editActeur.php";
  }

  // méthode qui va traiter les entrées du formulaire de la vue "editActeur.php"
  public function editActeur($id, $array)
  {
    $nom_acteur = filter_var($array["nom_acteur"], FILTER_SANITIZE_STRING);
    $prenom_acteur = filter_var($array["prenom_acteur"], FILTER_SANITIZE_STRING);
    $sexe = filter_var($array["sexe_acteur"], FILTER_SANITIZE_STRING);
    $dateNaissance = filter_var($array["dateNaissance_acteur"], FILTER_SANITIZE_STRING);
    $photoActeur = filter_var($array["photo_acteur"], FILTER_SANITIZE_STRING);

    $dao = new DAO();
    $sql = "UPDATE acteur
    SET nom = :nom,
    prenom = :prenom,
    sexe = :sexe,
    dateNaissance = :dateNaissance,
    imgPath = :imgPath
    WHERE id_acteur = :id";
    $dao->executerRequete($sql, [
      ':id' => $id,
      ':nom' => $nom_acteur,
      ':prenom' => $prenom_acteur,
      ':sexe' => $sexe,
      ':dateNaissance' => $dateNaissance,
      ':imgPath' => $photoActeur
    ]);
    header("Location:index.php?action=listActeurs");
  }
}
