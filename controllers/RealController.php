<?php

require_once "bdd/DAO.php";

class RealController
{
  // méthode pour afficher une liste des réalisateurs
  public function findAll()
  {
    $dao = new DAO();
    $sql = "SELECT id_realisateur, concat(prenom, ' ', nom) AS identiteRealisateur, sexe, dateNaissance, YEAR(CURRENT_TIMESTAMP) - YEAR(dateNaissance) AS age
    FROM realisateur";
    $realisateurs = $dao->executerRequete($sql);
    require "views/realisateur/listRealisateurs.php";
  }

  // méthode pour récuperer les informations d'un réalisateur à l'aide de l'id
  public function findOneById($id, $edit = false)
  {
    $dao = new DAO();
    $sql = "SELECT r.id_realisateur, concat(r.prenom,' ',r.nom) AS nom, sexe, dateNaissance, prenom, nom
    FROM realisateur r
    WHERE r.id_realisateur = :id";
    $realisateur = $dao->executerRequete($sql, [":id" => $id]);

    // filmographie du réalisateur
    $sql2 = "SELECT r.id_realisateur, f.titre AS titre
    FROM realisateur r
    INNER JOIN film f
    ON f.id_realisateur = r.id_realisateur
    WHERE r.id_realisateur = :id";
    $filmographie = $dao->executerRequete($sql2, [":id" => $id]);

    if (!$edit) {
      require "views/realisateur/detailReal.php";
    } else {
      return $realisateur;
    }
  }
  // ajouter un if avec $edit=false pour afficher ou non la vue "detailReal.php"
  // sinon on aura la vue en double puisqu'elle sera demandée par findOneById() 
  // et par une autre méthode comme par ex. modifierRealisateurForm()


  // méthode pour afficher un formulaire pour ajouter un réalisateur
  public function addRealForm()
  {
    require "views/realisateur/ajouterRealForm.php";
  }

  // méthode qui va traiter les entrées du formulaire de la vue "ajouterRealForm.php"
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

  // méthode pour supprimer un réalisateur 
  public function deleteOneById($id)
  {
    $dao = new DAO();
    $sql = "DELETE FROM realisateur
    WHERE id_realisateur = :id";
    $realisateur = $dao->executerRequete($sql, [":id" => $id]);
    require "views/realisateur/effacerRealisateur.php";
  }

  // méthode qui va afficher un formulaire (pour modifier les informations d'un réalisateur)
  public function modifierRealisateurForm($id)
  {
    $realisateur = $this->findOneById($id, true);
    require "views/realisateur/editReal.php";
    // ce "this" fait ref à l'objet sur lequel on travail pour utiliser une méthode
    // une méthode qu'on a déjà créer = on évite la redondance !
  }

  // méthode qui va traiter les entrées du formulaire de la vue "editReal.php"
  public function editRealisateur($id, $array)
  {
    $nom_realisateeur = filter_var($array["nom_realisateur"], FILTER_SANITIZE_STRING);
    $prenom_realisateeur = filter_var($array["prenom_realisateur"], FILTER_SANITIZE_STRING);
    $sexe = filter_var($array["sexe_realisateur"], FILTER_SANITIZE_STRING);
    $dateNaissance = filter_var($array["dateNaissance_realisateur"], FILTER_SANITIZE_STRING);

    $dao = new DAO();
    $sql = "UPDATE realisateur
    SET nom = :nom,
    prenom = :prenom,
    sexe = :sexe,
    dateNaissance = :dateNaissance
    WHERE id_realisateur = :id";
    $dao->executerRequete($sql, [
      ':id' => $id,
      ':nom' => $nom_realisateeur,
      ':prenom' => $prenom_realisateeur,
      ':sexe' => $sexe,
      ':dateNaissance' => $dateNaissance
    ]);
    header("Location:index.php?action=listRealisateurs");
  }
}
