<?php
define('RACINE_SITE', '/github/SILEX/site_mvc');

require('model.php');

$infos = afficheAll();

$produits = $infos['produits'];
$categories = $infos['categories'];

require('view.php');

?>
