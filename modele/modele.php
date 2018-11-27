<?php

function getConnect(){
		require_once('connect.php');

		try{
				$connexion = new PDO('mysql:host='.SERVEUR.';dbname='.BDD, USER, PASSWORD);
				$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$connexion->query("SET NAMES UTF8");
				return $connexion;
			}catch(PDOException $e){
				echo 'Il y a eu une erreur de connexion : ' . $e->getMessage();
			}
}

function showAll(){
	$connexion = getConnect();
	$requete = "SELECT * FROM CLIENT";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat->fetchAll();
}