<?php
namespace boutique\DAO;

use Doctrine\DBAL\Connection;
use BOUTIQUE\Entity\Produit;

class ProduitDAO
{
  private $db; // Va contenir notre objet Connection, qui representera la connexion à la BDD

  public function __construct(Connection $db) {
    $this->db = $db;
  }

  public function getDb(){
    return $this->db;
  }

  public function findAll(){
    // Fonction pour récupérer tous les produits dans la BDD :

    $requete = "SELECT * FROM produit";
    $resultat = $this -> getDb() -> fetchAll($requete);

    // $resultat : Contient tous les produits sous forme d'un array multidimmentionnel

    $produits = array();

    foreach ($resultat as $value) {
      $id_produit = $value['id_produit'];
      $produits[$id_produit] = $this -> buildProduit($value);
    }
    return $produits;

  }

  // toutes les autres requêtes de l'entité Produit seront ici
  // ----
  // ----

  public function findAllCategories(){

    $req = "SELECT DISTINCT categorie FROM produit";
    $resultat = $this -> getDb() -> fetchAll($req);
    // $resultat est un tableau multidimmentionnel avec toutes les categories...

    return $resultat;
  }

  public function save(Produit $produit) {

    $produitData = array(
      'id_produit' => $produit -> getId_produit(),
      'reference' => $produit -> getReference(),
      'categorie' => $produit -> getCategorie(),
      'titre' => $produit -> getTitre(),
      'description' => $produit -> getDescription(),
      'public' => $produit -> getPublic(),
      'couleur' => $produit -> getCouleur(),
      'taille' => $produit -> getTaille(),
      'stock' => $produit -> getStock(),
      'prix' => $produit -> getPrix(),
      'photo' => 'test.png'
    );

    if ($produit -> getId_produit()) {
      // Update
      $this -> getDb() -> insert('produit', $produitData, array('id-produit' => getId_produit()));
    }
    else {
      // Ajout de produit
      $this -> getDb() -> insert('produit', $produitData);
    }
  }

  protected function buildProduit(array $value){ // l'objectif de cette fonction est de transformer un array contenant toutes les infos d'un produit en un objet de la classe Entity/Produit

    $produit = new Produit; // Notre POPO qu'on a créé avec ses getter et setter

    $produit -> setId_produit($value['id_produit']);
    $produit -> setReference($value['reference']);
    $produit -> setCategorie($value['categorie']);
    $produit -> setTitre($value['titre']);
    $produit -> setDescription($value['description']);
    $produit -> setCouleur($value['couleur']);
    $produit -> setTaille($value['taille']);
    $produit -> setPublic($value['public']);
    $produit -> setPhoto($value['photo']);
    $produit -> setPrix($value['prix']);
    $produit -> setStock($value['stock']);

    return $produit;

    // On a transformer un array qui contient toutes les infos d'un produit en un objet qui contient toutes les infos du produit et on a renvoyer cette objet ensuite :)
  }

  public function findById($id) {
    // Fonction pour récupérer un produit dans la BDD :

    $requete = "SELECT * FROM produit WHERE id_produit = ?";
    $resultat = $this -> getDb() -> fetchAssoc($requete, array($id)); // $resultat : Contient toutes les infos du produit sous forme d'un array

    $produit = $this -> buildProduit($resultat); // on retient un objet et on retourne cet objet

    return $produit;
  }

  public function findAllByCategorie($categorie) {
    $req = "SELECT * FROM produit WHERE categorie = ?";
    $resultat = $this -> getDb() -> fetchAll($req, array($categorie));
    // $resultat = Array multidimmentionnel composé d'array

    $produits = array();
    foreach ($resultat as $value) {
      $id_produit = $value['id_produit'];
      $produits[$id_produit] = $this -> buildProduit($value);
    }

    // $produits est maintenant un array multi composé d'autant d'objet que de produit récupérés par la requête
    return $produits;
  }
}
