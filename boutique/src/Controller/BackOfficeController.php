<?php

namespace boutique\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use BOUTIQUE\Form\Type\ProduitType;
use BOUTIQUE\Entity\Produit;

class BackOfficeController
{
  public function produitAction(application $app) {

    $produits = $app['dao.produit'] -> findAll();

    $params = array(
      'produits' => $produits,
      'title' => 'Gestion produits'
    );

    return $app['twig'] -> render('backoffice_produit.html.twig', $params);
  }

  public function AddProduitAction($id, application $app, Request $request) {

    $produit = $app['dao.produit'] -> find($id);

    $produitForm = $app['form.factory'] -> create(ProduitType::class, $produit);
    $produitForm -> HandleRequest($request);

    if ($produitForm -> isSubmitted() && $produitForm -> isValid()){

      $data = $produitForm -> getData();
      // echo "<pre>";
      // print_r($data);
      // echo "</pre>";

      $app['dao.produit'] -> save($produit);
      //$produit -> getPhoto -> move($this -> pathName, __DIR__ . '/web/photo/' . $this -> originalName );
    }

    $params = array(
      'title' => 'Ajouter un produit',
      'produitForm' => $produitForm -> createView()
    );

    return $app['twig'] -> render('backoffice_produit_add.html.twig', $params);
  }

}
