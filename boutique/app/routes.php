<?php
use Symfony\Component\HttpFoundation\Request;
// Créer ça en étape 6.3

// $app -> get('/', function(){
//     require '../src/model.php';
//     // Fichier qiu contient notre fonction afficheAll()
//
//     $infos = afficheAll();
//
//     $produits = $infos['produits'];
//     $categories = $infos['categories'];
//
//     ob_start(); // Enclenche la temporisation. Cela signifie que tout ce qui suit ne sera pas exécuté
//     require '../views/view.php';
//     $view = ob_get_clean(); // Stocke tout ce qui a été retenu dans une variable
//     return $view;

    // Ici on a stocké notre vue dans la vriable $view grâce à ob_start() et ob_get_clean(). Ensuite on return la vue. C'est la base de la fonction render() qu'on utilisera par la suite.
// });

// Commenter en étape 7.9

// Route pour l'affichage de la home :
$app -> get('/', "BOUTIQUE\Controller\BaseController::indexAction")-> bind('home');

// Route pour l'affichage d'un produit :
$app -> get('/produits/{id}', "BOUTIQUE\Controller\ProduitController::produitAction")-> bind('produit');

// On souhaite construire une nouvelle route qui va nous afficher tous les produits en fonction des catégories. L'URL souhaitée est : www.boutique.dev/boutique/nom_de_la_categorie
$app -> get('/boutique/{categorie}', "BOUTIQUE\Controller\ProduitController::boutiqueAction")-> bind('boutique');

// Route pour l'affichage du profil du membre :
$app -> get('/profil', "BOUTIQUE\Controller\MembreController::profilAction")-> bind('profil');

// Fonctionnalité pour le formulaire de contact : /contact/
$app -> match('contact/', "BOUTIQUE\Controller\BaseController::contactAction")-> bind('contact');

// Route pour l'affichage de tous les  produits dans le backoffice (dans un tableau HTML)
$app -> get('/backoffice/produit', "BOUTIQUE\Controller\BackOfficeController::produitAction")-> bind('bo_produit');

// Route pour ajouter un nouveau produit
$app -> match('backoffice/produit/add/', "BOUTIQUE\Controller\BackOfficeController::AddProduitAction")-> bind('bo_produit_add');
