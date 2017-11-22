<?php

$app['db.options'] = array(
    'host' => 'localhost',
    'dbname' => 'site',
    'user' => 'root',
    'password' => '',
    'charset' => 'utf8'
);

// Doctrine DBAL es prévu pour récupérer nos informations de connexion à la BDD grâce à $app['db.options'], voilà pourquoi on les met ici :)
// Quand on passe notre site sur le serveur distant de OVH ou autre registrar, c'est ici que nous viendront changer les infos de connexion à la BDD.
