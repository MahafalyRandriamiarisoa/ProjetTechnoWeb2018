<?php

/**
 * Cette fonction permet d'obtenir une connection à la base de donnée grâce aux informations de connexion
 * situées dans le fichier connect.php
 * 
 * @return PDO
 * 		Correspond à la connexion à la base de donnée
 */

function getConnect(){
		require_once('connect.php');
		try{
				$connexion = new PDO('mysql:host='.SERVEUR.';dbname='.BDD, USER, PASSWORD);
				$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$connexion->query("SET NAMES 'utf8'");
				return $connexion;
			}catch(PDOException $e){
				echo 'Il y a eu une erreur de connexion : ' . $e->getMessage();
			}
}


/**
 * Cette fonction effectue une requete SQL à la base de donnée pour obtenir un resultat
 * correspondant à l'employé recherché
 * 
 * @param string : $login
 * 		Correspond au login de l'employé à rechercher
 * @param string : $mdp
 * 		Correspond au mot de passe de l'employé à rechercher 
 * 
 * @return object
 * 		Correspond au résultat de la requête SQL sous forme d'object contenant l'employé
 * 		recherché
 */

function checkLogin($login, $mdp){
	$connexion = getConnect();
	$requete = "SELECT * FROM EMPLOYE WHERE '$login' = login AND '$mdp' = mdp";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat->fetch();
}

/**
 * Cette fonction effectue une requete SQL à la base de donnée pour obtenir un resultat
 * correspondant au client recherché
 * 
 * @param integer : $numClient
 * 		Correspond au numéro du client à rechercher
 * 
 * @return array
 * 		Correspond au résultat de la requête SQL sous forme de tableau contenant le client
 * 		recherché
 */

function checkClient($numClient){
	$connexion = getConnect();
	$requete = "SELECT * FROM CLIENT WHERE $numClient = NUMCLIENT";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat->fetchAll();
}

/**
 * Cette fonction effectue une requete SQL à la base de donnée pour obtenir un resultat
 * correspondant au client recherché
 * 
 * @param string : $nom
 * 		Correspond au nom du client à rechercher
 * 
 * @param string : $dateNaissance
 * 		Correspond à la date de naissance du client
 * 
 * @return array
 * 		Correspond au résultat de la requête SQL sous forme de tableau contenant le client
 * 		recherché
 */

function rechercherClient($nom, $dateNaissance){
	$connexion = getConnect();
	$requete = "SELECT * FROM CLIENT WHERE nom = '$nom' AND dateDeNaissance = '$dateNaissance'";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat->fetchAll();
}

/**
 * Cette fonction effectue une requete SQL à la base de donnée pour obtenir un resultat
 * correspondant à la catégorie de l'employé
 * 
 * @param string : $login
 * 		Correspond au login de l'employé
 * 
 * @return object
 * 		Correspond au résultat de la requête SQL sous forme d'object contenant la catégorie
 * 		de l'employé recherché
 */

function getCategorie($login){
	$connexion = getConnect();
	$requete = "SELECT CATEGORIE FROM EMPLOYE WHERE login = '$login'";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat ->fetch();
}

/**
 * Cette fonction effectue une requete SQL à la base de donnée pour obtenir un resultat
 * correspondant à la synthèse du client passé en paramètre
 * 
 * @param integer : $numClient
 * 		Correspond au numéro du client
 * 
 * @return object
 * 		Correspond au résultat de la requête SQL sous forme d'object contenant la synthèse du client
 */

function getSyntheseClient($numClient){
	$connexion = getConnect();
	$requete = "SELECT * FROM CLIENT WHERE NUMCLIENT = $numClient";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat ->fetch();
}

/**
 * Cette fonction effectue une requete SQL à la base de donnée pour obtenir un resultat
 * correspondant aux rendez-vous de l'employé passé en paramètre
 * 
 * @param integer : $numClient
 * 		Correspond au numéro du client
 * 
 * @return array
 * 		Correspond au résultat de la requête SQL sous forme de tableau contenant tous les rendez-vous
 * 		de l'employé
 */

function getRDV($idEmploye){
	$connexion = getConnect();
	$requete = "SELECT * FROM RENDEZVOUS NATURAL JOIN CLIENT NATURAL JOIN TYPEMOTIF NATURAL JOIN PIECES_A_FOURNIR NATURAL JOIN PIECES_A_FOURNIRMOTIF WHERE idEmploye = $idEmploye";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat ->fetchAll();
}

/** 
 * Cette fonction effectue une requete SQL à la base de donnée pour obtenir un résultat
 * correspondant à l'employé recherché à partir de son idEmploye
 * @param string : $idEmpoye
 *      Correspond au login de l'employé à rechercher
 * @return object
 * 		Correspond au résultat de la requête SQL sous forme d'object contenant l'employé
 * 		recherché
 */

 function getEmploye($idEmploye){
	$connexion = getConnect();
	$requete = "SELECT * FROM EMPLOYE WHERE idEmploye = $idEmploye";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat ->fetch();
 }

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour obtenir un résultat
 * correspondant aux comptes du client recherché
 * @param integer : $numClient
 *      Correspond au numéro du client
 * @return array
 * 		Correspond au résultat de la requête SQL sous forme d'object contenant les différents
 * 		comptes du client
 */

 function getComptesClient($numClient){
	$connexion = getConnect();
	$requete = "SELECT * FROM COMPTE WHERE numClient = $numClient";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat ->fetchAll();
 }

  /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour obtenir un résultat
 * correspondant aux contrats du client recherché
 * @param integer : $numClient
 *      Correspond au numéro du client
 * @return array
 * 		Correspond au résultat de la requête SQL sous forme d'object contenant les différents
 * 		contrats du client
 */

 function getContratsClient($numClient){
	$connexion = getConnect();
	$requete = "SELECT * FROM CONTRAT WHERE numClient = $numClient";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat ->fetchAll();
 }

/**
 * Cette fonction effectue une requete SQL à la base de donnée pour enregistrer un 
 * client champ par champ
 *
 * @param string : $idEmploye
 * 		Correspond au conseiller du client
 * @param string : $nom
 * 		Correspond au nom du client
 * @param string : $prenom
 * 		Correspond au prénom du client
 * @param string : $dateNaissance
 * 		Correspond à la date de naissance du client
 * @param string : $adresse
 * 		Correspond à l'adresse postale du client
 * @param string : $email
 * 		Correspond à l'adresse eMail du client
 * @param string : $numTel
 * 		Correspond au numéro de téléphone du client
 * @param string : $situationFamiliale
 *		Correspond à la situation familiale du client
 * @param string : $profession
 * 		Correspond à la profession du client
 */

 function enregistrerClient($idEmploye, $nom, $prenom, $dateNaissance, $adresse, $email, $numTel, $situationFamiliale, $profession){
	$connexion = getConnect();
	$requete = "INSERT INTO CLIENTS values ($idEmploye, '$nom', '$prenom', '$dateNaissance', '$adresse', '$email', '$numTel', '$situationFamiliale', '$profession')";
	$resultat = $connexion->query($requete);
 }

 //todo : fonction récup login employes

 function getAllEmployes(){
	$connexion = getConnect();
	$requete = "SELECT * FROM EMPLOYE";
	$resultat = $connexion->query($requete);
	return $resultat->fetchAll();
 }

 //todo : fonction modifier login / mdp employes

 //todo : get solde

 function getSolde($numClient, $nomCompte){
	$connexion = getConnect();
	$requete = "SELECT montant FROM COMPTE WHERE numClient = $numClient AND nomCompte = '$nomCompte'";
	$resultat = $connexion->query($requete);
	return $resultat->fetch();
 }

 //todo : créditer compte

 function crediterCompte($montant, $numClient, $nomCompte){
	$connexion = getConnect();
	$soldeActuel = getSolde($numClient, $nomCompte)->MONTANT;
	$soldeCredite = $soldeActuel + $montant;
	$requete = "INSERT INTO COMPTE (montant) VALUES $soldeCredite WHERE numClient = $numClient AND nomCompte = '$nomCompte'";
	$resultat = $connexion->query($requete);
 }
 //todo : débiter compte

 function debiterCompte($montant, $numClient, $nomCompte){
	$connexion = getConnect();
	$soldeActuel = getSolde($numClient, $nomCompte)->MONTANT;
	$soldeDebite = $soldeActuel - $montant;
	$requete = "INSERT INTO COMPTE (montant) VALUES $soldeDebite WHERE numClient = $numClient AND nomCompte = '$nomCompte'";
	$resultat = $connexion->query($requete);
 }

 //todo : montant decouvert autorisé

 function getMontantDecourvertAutorise($numClient, $nomCompte){
	$connexion = getConnect();
	$requete = "SELECT montantDecouvert FROM COMPTECLIENT numClient = $numClient AND nomCompte = '$nomCompte'";
	$resultat = $connexion->query($requete);
	return $resultat->fetch();
 }

 //todo : get tous contrats

 function getAllContrats(){
	$connexion = getConnect();
	$requete = "SELECT * FROM CONTRAT";
	$resultat = $connexion->query($requete);
	return $resultat->fetchAll();
 }

 //todo : get all type comptes

 function allTypeCompte(){
	$connexion = getConnect();
	$requete = "SELECT * FROM COMPTE";
	$resultat = $connexion->query($requete);
	return $resultat->fetchAll();
 }

 //todo : get all motif

 function allMotif(){
	$connexion = getConnect();
	$requete = "SELECT * FROM TYPEMOTIF";
	$resultat = $connexion->query($requete);
	return $resultat->fetchAll();
 }

 //todo : getCompte($numClient,$nomCompte)

 function getCompte($numClient, $nomCompte){
	$connexion = getConnect();
	$requete = "SELECT * FROM COMPTECLIENT WHERE numClient = $numClient AND nomCompte = '$nomCompte'";
	$resultat = $connexion->query($requete);
	return $resultat->fetch();
 }

 //todo :  getContratsPotentielClient($numClient)
 //               par potentiel j'entends les contrats que le client peut potentiellement acheter (ce qu'ils n'a pas déjà)

 function getContratsPotentielsClient($numClient){
	$connexion = getConnect();
	$requete = "SELECT IDCONTRAT FROM CONTRAT WHERE IDCONTRAT NOT IN (SELECT IDCONTRAT FROM CONTRATCLIENT)";
	$resultat = $connexion->query($requete);
	return $resultat->fetchAll();
 }

 //todo :  enregistrerContrat($numClient,$DATEOUVERTURECONTRAT,$TARIFMENSUEL,$LIBELLE);

 function enregistrerContrat($numClient, $dateOuvertureContrat, $tarifMensuel, $idContrat){
	$connexion = getConnect();
	$requete = "INSERT INTO CONTRATCLIENT VALUES ($numClient, '$dateOuvertureContrat', $tarifMensuel, $idContrat) WHERE numClient = $numClient ";
	$resultat = $connexion->query($requete);
 }

 //todo : resilierContrat($idContrat, $numClient)
 function resilierContrat($numClient, $idContrat){
	$connexion = getConnect();
	$requete = "DELETE * FROM CONTRATCLIENT WHERE numClient = $numClient AND idContrat = $idContrat";
	$resultat = $connexion->query($requete);
 }


 //todo : getComptesPotentielsClient($numClient);
 //                     même explication que pour les contrats potentiels client

 function getComptesPotentielsClient($numClient){
	$connexion = getConnect();
	$requete = "SELECT nomCompte FROM COMPTE WHERE nomCompte NOT IN (SELECT nomCompte FROM COMPTECLIENT)";
	$resultat = $connexion->query($requete);
	return $resultat->fetchAll();
 }

 //todo : ouvertureCompte($NUMCLIENT,$NOMCOMPTE,$DATEOUVERTURE,$MONTANTDECOUVERT)

 function ouvertureCompte($numClient, $nomCompte, $dateOuverture, $montantDecouvert){
	$connexion = getConnect();
	$requete = "INSERT INTO COMPTECLIENT VALUES ($numClient, $nomCompte, '$dateOuverture', 0, $montantDecouvert)";
	$resultat = $connexion->query($requete);
 }

 //todo :  fermerCompte($numClient,$nomCompte)

 function fermerCompte($numClient, $nomCompte){
	$connexion = getConnect();
	$requete = "DELETE * FROM COMPTECLIENT WHERE numClient = $numClient AND nomCompte = '$nomCompte'";
	$resultat = $connexion->query($requete);
 }
//todo : 


