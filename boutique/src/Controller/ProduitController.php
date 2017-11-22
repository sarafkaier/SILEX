<?php

namespace boutique\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use boutique\Entity\Produit;

class ProduitController
{
  public function produitAction($id, Application $app) {

    $produit = $app['dao.produit'] -> findById($id); // Comment findByID connait l'id a chercher ?

    $params = array(
      'produit' => $produit
    );

    return $app['twig'] -> render('produit.html.twig', $params);

  }

  public function boutiqueAction($categorie, Application $app) {

    // Etape 1 : récupérer les produits en fonction des catégories
    $produits = $app['dao.produit'] -> findAllByCategorie($categorie);

    // Etape 2 : Récupérer également toutes les catégories pour ré-afficher le menu latéral
    $categories = $app['dao.produit'] -> findAllCategories();

    // Etape 3 : On affiche la bonne vue
    $params = array(
      'produits' => $produits,
      'categories' => $categories,
      'title' => 'Nos ' . $categorie . 's'
    );

    return $app['twig'] -> render('index.html.twig', $params);

  }

}
