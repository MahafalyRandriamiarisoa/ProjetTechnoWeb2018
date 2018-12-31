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
	$requete = "SELECT * FROM IDENTIFIANT WHERE '$login' = login AND '$mdp' = mdp";
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
	$requete = "SELECT * FROM CLIENT WHERE numClient = $numClient";
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
	$requete = "SELECT * FROM RENDEZVOUS NATURAL JOIN CLIENT NATURAL JOIN TYPEMOTIF WHERE idEmploye = $idEmploye";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat ->fetchAll();
}

function getDispos($idEmploye){
	$connexion = getConnect();
	$requete = "SELECT * FROM RENDEZVOUS WHERE idEmploye = $idEmploye AND numClient IS NULL";
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
	$requete = "SELECT * FROM COMPTECLIENT WHERE numClient = $numClient";
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
	$requete = "SELECT * FROM CONTRATCLIENT NATURAL JOIN CONTRAT WHERE numClient = $numClient";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat ->fetchAll();
 }

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour obtenir un résultat
 * correspondant au contrat retrouvé par son libellé passé en paramètre
 * @param string : $idEmpoye
 *      Correspond au libellé du contrat recherché
 * @return object
 * 		Correspond au résultat de la requête SQL sous forme d'object contenant le contrat recherché
 */

 function getContrat($libelle){
	$connexion = getConnect();
	$requete = "SELECT * FROM CONTRAT WHERE libelle = '$libelle'";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat->fetch();
 }

/**
 * Cette fonction effectue une requete SQL à la base de donnée pour enregistrer un 
 * client champ par champ
 *
 * @param integer : $idEmploye
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
 * 
 * @return string : correspond à l'id de la dernière ligne insérée dans la table
 */

 function enregistrerClient($idEmploye, $nom, $prenom, $dateNaissance, $adresse, $email, $numTel, $situationFamiliale, $profession){
	$connexion = getConnect();
	$requete = "INSERT INTO CLIENT values (0, $idEmploye, '$nom', '$prenom', STR_TO_DATE('$dateNaissance', '%Y-%m-%d'), '$adresse', '$email', '$numTel', '$situationFamiliale', '$profession')";
	$connexion->query($requete);
	return $connexion->lastInsertId();
 }

  /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour obtenir un résultat
 * correspondant à tous les identifiants employés
 * 
 * @return array
 * 		Correspond au résultat de la requête SQL sous forme d'object contenant les différents
 * 		identifiants des employes
 */

 function getAllEmployes(){
	$connexion = getConnect();
	$requete = "SELECT * FROM IDENTIFIANT";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat->fetchAll();
 }

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour obtenir un résultat
 * correspondant au solde du compte du client passé en paramètre
 * @param integer : $numClient
 *      Correspond au numéro du client
 * 
 * @param string : $nomCompte
 *      Correspond au nom du compte recherché
 * @return object
 * 		Correspond au résultat de la requête SQL sous forme d'object contenant le solde du compte du client
 */
 function getSolde($numClient, $nomCompte){
	$connexion = getConnect();
	$requete = "SELECT SOLDE FROM COMPTECLIENT WHERE numClient = $numClient AND nomCompte = '$nomCompte'";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat->fetch();
 }

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour créditer un compte
 * 
 * @param integer : $montant
 *      Correspond au montant de l'opération
 * @param integer : $numClient
 *      Correspond au numéro du client
 * @param string : $nomCompte
 *      Correspond au nom du compte recherché
 */
 function crediterCompte($montant, $numClient, $nomCompte){
	$connexion = getConnect();
	$soldeActuel = getSolde($numClient, $nomCompte)->SOLDE;
	$soldeCredite = $soldeActuel + $montant;
	$requete = "UPDATE COMPTECLIENT SET SOLDE = $soldeCredite WHERE numClient = $numClient AND nomCompte = '$nomCompte'";
	$connexion->query($requete);
 }

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour débiter un compte
 * 
 * @param integer : $montant
 *      Correspond au montant de l'opération
 * @param integer : $numClient
 *      Correspond au numéro du client
 * @param string : $nomCompte
 *      Correspond au nom du compte recherché
 */

 function debiterCompte($montant, $numClient, $nomCompte){
	$connexion = getConnect();
	$soldeActuel = getSolde($numClient, $nomCompte)->SOLDE;
	$soldeDebite = $soldeActuel - $montant;
	$requete = "UPDATE COMPTECLIENT SET SOLDE = $soldeDebite WHERE numClient = $numClient AND nomCompte = '$nomCompte'";
	$connexion->query($requete);
 }

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour créditer un compte
 * 
 * @param integer : $numClient
 *      Correspond au montant de l'opération
 * 
 * @param string : $nomCompte
 *      Correspond au nom du compte recherché
 * 
 * @return object :
 * 		Correspond au résultat de la requête SQL sous forme d'object contenant le montant de découvert autorisé du compte du client
 */

 function getMontantDecourvertAutorise($numClient, $nomCompte){
	$connexion = getConnect();
	$requete = "SELECT montantDecouvert FROM COMPTECLIENT numClient = $numClient AND nomCompte = '$nomCompte'";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat->fetch();
 }

  /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour obtenir un résultat
 * correspondant à tous les contrats vendus par la banque actuellement
 * 
 * @return array
 * 		Correspond au résultat de la requête SQL sous forme d'object contenant les différents
 * 		contrats vendus par la banque actuellement
 */

 function allContrats(){
	$connexion = getConnect();
	$requete = "SELECT * FROM CONTRAT";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat->fetchAll();
 }

  /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour obtenir un résultat
 * correspondant à tous les types de compte disponible dans la banque actuellement
 * 
 * @return array
 * 		Correspond au résultat de la requête SQL sous forme d'object contenant les différents
 * 		types de compte disponible dans la banque actuellement
 */

 function allTypeCompte(){
	$connexion = getConnect();
	$requete = "SELECT * FROM COMPTE";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat->fetchAll();
 }

  /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour obtenir un résultat
 * correspondant aux différents motifs possibles lors de la prise d'un rendez-vous
 * 
 * @return array
 * 		Correspond au résultat de la requête SQL sous forme d'object contenant les différents
 * 		motifs possibles lors de la prise d'un rendez-vous
 */

 function allMotif(){
	$connexion = getConnect();
	$requete = "SELECT * FROM TYPEMOTIF";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat->fetchAll();
 }

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour créditer un compte
 * 
 * @param integer : $numClient
 *      Correspond au montant de l'opération
 * 
 * @param string : $nomCompte
 *      Correspond au nom du compte recherché
 * 
 * @return object :
 * 		Correspond au résultat de la requête SQL sous forme d'object contenant le compte du client
 */

 function getCompte($numClient, $nomCompte){
	$connexion = getConnect();
	$requete = "SELECT * FROM COMPTECLIENT WHERE numClient = $numClient AND nomCompte = '$nomCompte'";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat->fetch();
 }

  /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour obtenir les contrats auxquels le client est éligible
 * 
 * @param integer : $numClient
 *      Correspond au numéro du client
 * 
 * @return array :
 * 		Correspond au résultat de la requête SQL sous forme de tableau contenant les contrats auxquels le client est éligible
 */

 function getContratsPotentielsClient($numClient){
	$connexion = getConnect();
	$requete = "SELECT * FROM CONTRAT WHERE IDCONTRAT NOT IN (SELECT IDCONTRAT FROM CONTRATCLIENT WHERE numClient = $numClient)";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat->fetchAll();
 }

  /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour enregisitrer un contrat pour un client
 * 
 * @param integer : $numClient
 *      Correspond au numéro du client
 * 
 * @param string : $dateOuvertureContrat
 *      Correspond au numéro du client
 * 
 * @param integer : $tarifMensuel
 *      Correspond au tarif mensuel du contrat
 * 
 * @param integer : $idContrat
 *      Correspond à l'id du contrat 
 */

 function enregistrerContrat($numClient, $dateOuvertureContrat, $tarifMensuel, $idContrat){
	$connexion = getConnect();
	$requete = "INSERT INTO CONTRATCLIENT VALUES ($idContrat, $numClient, STR_TO_DATE('$dateOuvertureContrat', '%Y-%m-%d'), $tarifMensuel)";
	$connexion->query($requete);
 }

/** 
 * Cette fonction effectue une requete SQL à la base de donnée pour résilier le contrat d'un client
 * 
 * @param integer : $numClient
 *      Correspond au numéro du client 
 * 
 * @param integer : $idContrat
 *      Correspond à l'id du contrat 
 */
 function resilierContrat($numClient, $idContrat){
	$connexion = getConnect();
	$requete = "DELETE FROM CONTRATCLIENT WHERE numClient = $numClient AND idContrat = $idContrat";
	$connexion->query($requete);
 }

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour résilier le compte d'un client
 * 
 * @param integer : $numClient
 *      Correspond au numéro du client 
 * 
 * @param string : $nomCompte
 *      Correspond au nom du compte
 */

 function resilierCompte($numClient, $nomCompte){
	$connexion = getConnect();
	$requete = "DELETE FROM COMPTECLIENT WHERE numClient = $numClient AND nomCompte = '$nomCompte'";
	$connexion->query($requete);
 }

  /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour obtenir les comptes auxquels le client est éligible
 * 
 * @param integer : $numClient
 *      Correspond au numéro du client
 * 
 * @return array :
 * 		Correspond au résultat de la requête SQL sous forme de tableau contenant les comptes auxquels le client est éligible
 */
 function getComptesPotentielsClient($numClient){
	$connexion = getConnect();
	$requete = "SELECT nomCompte FROM COMPTE WHERE nomCompte NOT IN (SELECT nomCompte FROM COMPTECLIENT WHERE numClient = $numClient)";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat->fetchAll();
 }

  /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour enregisitrer un contrat pour un client
 * 
 * @param integer : $numClient
 *      Correspond au numéro du client
 * 
 * @param string : $nomCompte
 *      Correspond au nom ud compte
 * 
 * @param string : $dateOuverture
 *      Correspond à la date d'ouverture du compte
 * 
 * @param integer : $montantDecouvert
 *      Correspond au montant de découvert autorisé sur ce compte
 */

 function ouvertureCompte($numClient, $nomCompte, $dateOuverture, $montantDecouvert){
	$connexion = getConnect();
	$requete = "INSERT INTO COMPTECLIENT VALUES ($numClient, '$nomCompte', '$dateOuverture', 0, $montantDecouvert)";
	$connexion->query($requete);
 }

/**
 * Cette fonction effectue une requete SQL à la base de donnée pour modifier les informations 
 * d'un client
 * 
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

function modifierInfosClient($numClient, $adresse, $email, $numTel, $situationFamiliale, $profession){
	$connexion = getConnect();
	$requete = "UPDATE CLIENT SET adresse = '$adresse', email = '$email', numeroTelephone = '$numTel', situationFamiliale = '$situationFamiliale', profession = '$profession' WHERE numClient = $numClient";
	$connexion->query($requete);
}

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour redéfinir le montant de découvert autorisé sur le compte d'un client
 * 
 * @param integer : $numClient
 *      Correspond au numéro du client 
 * 
 * @param string : $nomCompte
 *      Correspond au nom du compte
 * 
 * @param integer : $montant
 *      Correspond au montant
 */

function setMontantDecouvertAutorise($numClient, $nomCompte, $montant){
	$connexion = getConnect();
	$requete = "UPDATE COMPTECLIENT SET montantDecouvert = $montant WHERE numClient = $numClient AND nomCompte = '$nomCompte'";
	$connexion->query($requete);
}

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour résilier un client
 * 
 * @param integer : $numClient
 *      Correspond au numéro du client 
 */

function resilierClient($numClient){
	$connexion = getConnect();
	$requete = "DELETE * FROM CLIENT WHERE numClient = $numClient";
	$resultat = $connexion->query($requete);
}

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour ajouter un rendez-vous dans la table
 * 
 * @param integer : $idEmploye
 *      Correspond à l'ID de l'employé
 * 
 * @param integer : $idMotif
 *      Correspond à l'ID du motif
 * 
 * @param integer : $numClient
 *      Correspond au numéro du client 
 * 
 * @param string : $dateHeureRDV
 *      Correspond à la date et l'heure du rendez-vous
 */

function ajouterRDV($idEmploye, $idMotif, $numClient, $dateHeureRDV){
	$connexion = getConnect();
	$requete = "INSERT INTO RENDEZVOUS VALUES (0, $idEmploye, $idMotif, $numClient, STR_TO_DATE('$dateHeureRDV', '%d/%m/%Y/%k'))";
	$connexion->query($requete);
}

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour modifier les identifiants d'une catégorie d'employé
 * 
 * @param string : $categorie
 *      Correspond à la catégorie de l'employé
 * 
 * @param string : $identifiant
 *      Correspond à l'identifiant de la catégorie d'employé
 * 
 * @param string : $mdp
 *      Correspond au mot de passe de la catégorie d'employé
 */

function modifierIdentifiants($categorie, $identifiant, $mdp){
	$connexion = getConnect();
	$requete = "UPDATE IDENTIFIANT SET login = '$identifiant', mdp = '$mdp' WHERE categorie = '$categorie'";
	$connexion->query($requete);
}

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour ajouter un contrat
 * 
 * @param string : $libelle
 *      Correspond au libellé du contrat à ajouter
 */

function ajouterContrat($libelle){
	$connexion = getConnect();
	$requete = "INSERT INTO CONTRAT VALUES (0, '$libelle')";
	$connexion->query($requete);
}

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour modifier le libellé d'un contrat
 * 
 * @param string : $libelle
 *      Correspond au nouveau libellé du contrat
 * 
 * @param string : $ancienLibelle
 *      Correspond à l'ancien libellé du contrat
 */

function modifierContrats($libelle,$ancienlibelle){
	$connexion = getConnect();
	$requete = "UPDATE CONTRAT SET libelle='$libelle' WHERE libelle='$ancienlibelle'";
	$connexion->query($requete);
}

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour supprimer un contrat
 * 
 * @param string : $libelle
 *      Correspond au nouveau libellé du contrat à supprimer
 */

function supprimerContrat($libelle){
	$connexion = getConnect();
	$requete = "DELETE FROM CONTRAT WHERE libelle='$libelle'";
	$connexion->query($requete);
}

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour ajouter un compte à la table
 * 
 * @param string : $nomCompte
 *      Correspond au nouveau libellé au nom du compte à ajouter
 */
	
function ajouterCompte($nomCompte){
	$connexion = getConnect();
	$requete = "INSERT INTO COMPTE VALUES ( '$nomCompte')";
	$connexion->query($requete);
}

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour modifier le libellé d'un compte
 * 
 * @param string : $nomCompte
 *      Correspond au nouveau nom du compte
 * 
 * @param string : $ancienNomCompte
 *      Correspond à l'ancien nom du compte
 */

function modifierComptes($nomCompte,$ancienNomCompte){
	$connexion = getConnect();
	$requete = "UPDATE COMPTE SET NOMCOMPTE='$nomCompte' WHERE NOMCOMPTE='$ancienNomCompte'";
	$connexion->query($requete);
}

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour supprimer un compte. Il ne sera donc plus disponible à l'ouverture pour les clients
 * 
 * @param string : $nomCompte
 *      Correspond au nouveau nom du compte
 */

function supprimerCompte($nomCompte){
	$connexion = getConnect();
	$requete = "DELETE FROM COMPTE WHERE NOMCOMPTE='$nomCompte'";
	$connexion->query($requete);
}

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour ajouter un motif.
 * 
 * @param string : $motif
 *      Correspond au nom du motif
 */

function ajouterMotif($motif){
	$connexion = getConnect();
	$requete = "INSERT INTO TYPEMOTIF(IDMOTIF,LIBELLEMOTIF) VALUES (0, '$motif')";
	$connexion->query($requete);
	return $connexion->lastInsertId();
}

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour supprimer un motif.
 * 
 * @param string : $motif
 *      Correspond au nom du motif
 */

function supprimerMotif($motif){
	$connexion = getConnect();
	$requete = "DELETE FROM TYPEMOTIF WHERE LIBELLEMOTIF='$motif'";
	$connexion->query($requete);
}

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour modifier le libellé d'un motif.
 * 
 * @param string : $libelle
 *      Correspond au nouveau libellé du motif
 * 
 * @param string : $ancienLibelle
 *      Correspond à l'ancien libellé du motif
 */

function modifierMotif($libelle,$ancienlibelle){
	$connexion = getConnect();
	$requete = "UPDATE TYPEMOTIF SET libellemotif='$libelle' WHERE libellemotif='$ancienlibelle'";
	$connexion->query($requete);
}

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour supprimer une liste de pièces à fournir pour un motif.
 * 
 * @param string : $motif
 *      Correspond au nouveau libellé du motif
 */

function supprimerPieceAFournir($motif){
	$connexion = getConnect();
	$requete = "UPDATE TYPEMOTIF SET PIECES_A_FOURNIR='' WHERE LIBELLEMOTIF='$motif'";
	$connexion->query($requete);
}

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour modifier une liste de pièces à fournir pour un motif.
 * 
 * @param string : $libelle
 *      Correspond au libellé de la pièce à fournir
 * 
 * @param string : $motif
 *      Correspond au nouveau libellé du motif
 */

function ajouterPieceAFournir($libelle,$motif){
	$connexion = getConnect();
	$requete =  "UPDATE TYPEMOTIF SET PIECES_A_FOURNIR='$libelle' WHERE LIBELLEMOTIF='$motif'";
	$connexion->query($requete);
}

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour modifier une liste de pièces à fournir pour un motif.
 * 
 * @param string : $piece
 *      Correspond au nouveau libellé de la pièce à fournir
 * 
 * @param string : $motif
 *      Correspond au nouveau libellé du motif
 */

function modifierPieceAFournir($piece,$motif){
	$connexion = getConnect();
	$requete =  "UPDATE TYPEMOTIF SET PIECES_A_FOURNIR='$piece' WHERE LIBELLEMOTIF='$motif'";
	$connexion->query($requete);
}

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour obtenir la liste de tous les conseillers de la banque
 * 
 * @return array :
 * 		Résultat de la requête SQL contenant tous les conseillers de la banques
 */

function allConseillers(){
    $connexion = getConnect();
    $requete = "SELECT * FROM EMPLOYE WHERE categorie='Conseiller'";
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    return $resultat->fetchAll();
}

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour obtenir la liste de tous les identifiants
 * 
 * @return array :
 * 		Résultat de la requête SQL contenant tous les identifiants de toutes les catégories
 */

function allIdentifiants(){
	$connexion = getConnect();
	$requete = "SELECT * FROM IDENTIFIANT ";
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    return $resultat->fetchAll();
}

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour obtenir la liste de tous les contrats souscrits entre deux dates
 * 
 * @param string :
 * 		Première date
 * 
 * @param string :
 * 		Deuxième date
 * @return array :
 * 		Résultat de la requête SQL contenant tous les contrats souscrits entre la première date et la seconde date
 */

function contratsBetween($date1, $date2){
	$connexion = getConnect();
    $requete = "SELECT * FROM CONTRATCLIENT WHERE dateOuvertureContrat BETWEEN STR_TO_DATE('$date1', '%d/%m/%Y') AND STR_TO_DATE('$date2', '%d/%m/%Y')";
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    return $resultat->fetchAll();
}

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour obtenir la liste de tous les clients à une date donnée
 * 
 * @param string :
 * 		Date
 * @return array :
 * 		Résultat de la requête SQL contenant tous les clients de la banque à une date donnée
 */

function clientsAtDate($date){
	$connexion = getConnect();
    $requete = "SELECT COUNT(*)total FROM(SELECT numClient FROM COMPTECLIENT WHERE dateOuverture <= STR_TO_DATE('$date', '%d/%m/%Y') GROUP BY NUMCLIENT)clients";
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    return $resultat->fetch();
}

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour obtenir le nombre de contrats souscrits à une date donnée
 * 
 * @param string :
 * 		Date
 * @return array :
 * 		Résultat de la requête SQL contenant le nombre de contrats souscrits à une date donnée
 */

function contratsAtDate($date){
	$connexion = getConnect();
    $requete = "SELECT COUNT(*)total FROM(SELECT numClient FROM CONTRATCLIENT WHERE dateOuvertureContrat <= STR_TO_DATE('$date', '%d/%m/%Y') GROUP BY NUMCLIENT)clients";
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    return $resultat->fetch();
}

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour obtenir le nombre de comptes souscrits à une date donnée
 * 
 * @param string :
 * 		Date
 * @return array :
 * 		Résultat de la requête SQL contenant le nombre de comptes souscrits à une date donnée
 */

function comptesAtDate($date){
	$connexion = getConnect();
    $requete = "SELECT COUNT(*)total FROM(SELECT numClient FROM COMPTECLIENT WHERE dateOuverture <= STR_TO_DATE('$date', '%d/%m/%Y') GROUP BY NUMCLIENT)clients";
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    return $resultat->fetch();
}

 /** 
 * Cette fonction effectue une requete SQL à la base de donnée pour obtenir le solde total de tous les comptes des clients à une date
 * 
 * @param string :
 * 		Date
 * @return object :
 * 		Résultat de la requête SQL contenant le solde total de tous les comptes des clients de la banque à une date donnée
 */

function soldeTotalBanqueAtDate($date){
	$connexion = getConnect();
    $requete = "SELECT SUM(solde)total FROM COMPTECLIENT WHERE dateOuverture <= STR_TO_DATE('$date', '%d/%m/%Y')";
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    return $resultat->fetch();
}



