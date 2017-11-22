<?php

namespace boutique\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class MembreController
{
  public function profilAction(Application $app) {

    session_start();

    $_SESSION['membre']['pseudo'] = 'Yakine';
    $_SESSION['membre']['sexe'] = 'm';
    $_SESSION['membre']['prenom'] = 'Yakine';
    $_SESSION['membre']['nom'] = 'Hamida';
    $_SESSION['membre']['email'] = 'yakine.hamida@hotmail.fr';
    $_SESSION['membre']['adresse'] = '11 rue des marguerites';
    $_SESSION['membre']['code_postal'] = 83600;
    $_SESSION['membre']['ville'] = 'Fréjus';
    $_SESSION['membre']['statut'] = '1';

    $params = array(
      'membre' => $_SESSION['membre']
    );

    return $app['twig'] -> render('profil.html.twig', $params);
  }

}
