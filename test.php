<?php 

$nom = "toularhmine";
$match = preg_match('/(^[a-z]*$)/i', $nom);

$birthday = "1999-02-25";
$match2 = preg_match('/^[1-2]([0-9]){3}-[0-1][0-2]/', $birthday);

$numTel = "0769303486";
$match3 = preg_match('/^([0-9][0-9]){5}$/', $numTel);

$situationFamiliale = "Célibataire";
$match4 = preg_match('/^[A-Za-zÀ-ÖØ-öø-ÿ]*$/i', $situationFamiliale);

$valeur = "890";
$match5 = preg_match('/^[0-9]*$/', $valeur);

var_dump($match5);