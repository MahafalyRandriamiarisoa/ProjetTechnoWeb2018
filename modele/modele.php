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
	var_dump($dateNaissance);
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
	$requete = "INSERT INTO CLIENT values (0, $idEmploye, '$nom', '$prenom', STR_TO_DATE('$dateNaissance', '%Y-%m-%d'), '$adresse', '$email', '$numTel', '$situationFamiliale', '$profession')";
	$connexion->query($requete);
	return $connexion->lastInsertId();
 }

 //todo : fonction récup login employes

 function getAllEmployes(){
	$connexion = getConnect();
	$requete = "SELECT * FROM IDENTIFIANT";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat->fetchAll();
 }

 //todo : fonction modifier login / mdp employes

 //todo : get solde

 function getSolde($numClient, $nomCompte){
	$connexion = getConnect();
	$requete = "SELECT SOLDE FROM COMPTECLIENT WHERE numClient = $numClient AND nomCompte = '$nomCompte'";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat->fetch();
 }

 //todo : créditer compte

 function crediterCompte($montant, $numClient, $nomCompte){
	$connexion = getConnect();
	$soldeActuel = getSolde($numClient, $nomCompte)->SOLDE;
	$soldeCredite = $soldeActuel + $montant;
	$requete = "UPDATE COMPTECLIENT SET SOLDE = $soldeCredite WHERE numClient = $numClient AND nomCompte = '$nomCompte'";
	$connexion->query($requete);
 }
 //todo : débiter compte

 function debiterCompte($montant, $numClient, $nomCompte){
	$connexion = getConnect();
	$soldeActuel = getSolde($numClient, $nomCompte)->SOLDE;
	$soldeDebite = $soldeActuel - $montant;
	$requete = "UPDATE COMPTECLIENT SET SOLDE = $soldeDebite WHERE numClient = $numClient AND nomCompte = '$nomCompte'";
	$connexion->query($requete);
 }

 //todo : montant decouvert autorisé

 function getMontantDecourvertAutorise($numClient, $nomCompte){
	$connexion = getConnect();
	$requete = "SELECT montantDecouvert FROM COMPTECLIENT numClient = $numClient AND nomCompte = '$nomCompte'";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat->fetch();
 }

 //todo : get tous contrats

 function allContrats(){
	$connexion = getConnect();
	$requete = "SELECT * FROM CONTRAT";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat->fetchAll();
 }

 //todo : get all type comptes

 function allTypeCompte(){
	$connexion = getConnect();
	$requete = "SELECT * FROM COMPTE";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat->fetchAll();
 }

 //todo : get all motif

 function allMotif(){
	$connexion = getConnect();
	$requete = "SELECT * FROM TYPEMOTIF";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat->fetchAll();
 }

 //todo : getCompte($numClient,$nomCompte)

 function getCompte($numClient, $nomCompte){
	$connexion = getConnect();
	$requete = "SELECT * FROM COMPTECLIENT WHERE numClient = $numClient AND nomCompte = '$nomCompte'";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat->fetch();
 }

 //todo :  getContratsPotentielClient($numClient)
 //               par potentiel j'entends les contrats que le client peut potentiellement acheter (ce qu'ils n'a pas déjà)

 function getContratsPotentielsClient($numClient){
	$connexion = getConnect();
	$requete = "SELECT * FROM CONTRAT WHERE IDCONTRAT NOT IN (SELECT IDCONTRAT FROM CONTRATCLIENT WHERE numClient = $numClient)";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat->fetchAll();
 }

 //todo :  enregistrerContrat($numClient,$DATEOUVERTURECONTRAT,$TARIFMENSUEL,$LIBELLE);

 function enregistrerContrat($numClient, $dateOuvertureContrat, $tarifMensuel, $idContrat){
	$connexion = getConnect();
	$requete = "INSERT INTO CONTRATCLIENT VALUES ($idContrat, $numClient, STR_TO_DATE('$dateOuvertureContrat', '%Y-%m-%d'), $tarifMensuel)";
	$connexion->query($requete);
 }

 //todo : resilierContrat($idContrat, $numClient)
 function resilierContrat($numClient, $idContrat){
	$connexion = getConnect();
	$requete = "DELETE FROM CONTRATCLIENT WHERE numClient = $numClient AND idContrat = $idContrat";
	$connexion->query($requete);
 }

 function resilierCompte($numClient, $nomCompte){
	$connexion = getConnect();
	$requete = "DELETE FROM COMPTECLIENT WHERE numClient = $numClient AND nomCompte = '$nomCompte'";
	$connexion->query($requete);
 }

 //todo : getComptesPotentielsClient($numClient);
 //                     même explication que pour les contrats potentiels client

 function getComptesPotentielsClient($numClient){
	$connexion = getConnect();
	$requete = "SELECT nomCompte FROM COMPTE WHERE nomCompte NOT IN (SELECT nomCompte FROM COMPTECLIENT WHERE numClient = $numClient)";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat->fetchAll();
 }

 //todo : ouvertureCompte($NUMCLIENT,$NOMCOMPTE,$DATEOUVERTURE,$MONTANTDECOUVERT)

 function ouvertureCompte($numClient, $nomCompte, $dateOuverture, $montantDecouvert){
	$connexion = getConnect();
	$requete = "INSERT INTO COMPTECLIENT VALUES ($numClient, '$nomCompte', '$dateOuverture', 0, $montantDecouvert)";
	$connexion->query($requete);
 }

 //todo :  fermerCompte($numClient,$nomCompte)

 function fermerCompte($numClient, $nomCompte){
	$connexion = getConnect();
	$requete = "DELETE * FROM COMPTECLIENT WHERE numClient = $numClient AND nomCompte = '$nomCompte'";
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

function setMontantDecouvertAutorise($numClient, $nomCompte, $montant){
	$connexion = getConnect();
	$requete = "UPDATE COMPTECLIENT SET montantDecouvert = $montant WHERE numClient = $numClient AND nomCompte = '$nomCompte'";
	$connexion->query($requete);
}

function resilierClient($numClient){
	$connexion = getConnect();
	$requete = "DELETE * FROM CLIENT WHERE numClient = $numClient";
	$resultat = $connexion->query($requete);
}

function ajouterRDV($idEmploye, $idMotif, $numClient, $dateHeureRDV){
	$connexion = getConnect();
	$requete = "INSERT INTO RENDEZVOUS VALUES (0, $idEmploye, $idMotif, $numClient, STR_TO_DATE('$dateHeureRDV', '%d/%m/%Y/%k'))";
	$connexion->query($requete);
}

function modifierIdentifiants($categorie, $identifiant, $mdp){
	$connexion = getConnect();
	$requete = "UPDATE IDENTIFIANT SET login = '$identifiant', mdp = '$mdp' WHERE categorie = '$categorie'";
	$connexion->query($requete);
}

function ajouterContrat($libelle){
	$connexion = getConnect();
	$requete = "INSERT INTO CONTRAT VALUES (0, '$libelle')";
	$connexion->query($requete);
}

function modifierContrats($libelle,$ancienlibelle){
	$connexion = getConnect();
	$requete = "UPDATE CONTRAT SET libelle='$libelle' WHERE libelle='$ancienlibelle'";
	$connexion->query($requete);
}

function supprimerContrat($libelle){
	$connexion = getConnect();
	$requete = "DELETE FROM CONTRAT WHERE libelle='$libelle'";
	$connexion->query($requete);
}
	
function ajouterCompte($nomCompte){
	$connexion = getConnect();
	$requete = "INSERT INTO COMPTE VALUES ( '$nomCompte')";
	$connexion->query($requete);
}

function modifierComptes($nomCompte,$ancienNomCompte){
	$connexion = getConnect();
	$requete = "UPDATE COMPTE SET NOMCOMPTE='$nomCompte' WHERE NOMCOMPTE='$ancienNomCompte'";
	$connexion->query($requete);
}

function supprimerCompte($nomCompte){
	$connexion = getConnect();
	$requete = "DELETE FROM COMPTE WHERE NOMCOMPTE='$nomCompte'";
	$connexion->query($requete);
}

function ajouterMotif($motif){
	$connexion = getConnect();
	$requete = "INSERT INTO TYPEMOTIF(IDMOTIF,LIBELLEMOTIF) VALUES (0, '$motif')";
	$connexion->query($requete);
	return $connexion->lastInsertId();
}

function supprimerMotif($motif){
	$connexion = getConnect();
	$requete = "DELETE FROM TYPEMOTIF WHERE LIBELLEMOTIF='$motif'";
	$connexion->query($requete);
}

function modifierMotif($libelle,$ancienlibelle){
	$connexion = getConnect();
	$requete = "UPDATE TYPEMOTIF SET libellemotif='$libelle' WHERE libellemotif='$ancienlibelle'";
	$connexion->query($requete);
}

function supprimerPieceAFournir($motif){
	$connexion = getConnect();
	$requete = "UPDATE TYPEMOTIF SET PIECES_A_FOURNIR='' WHERE LIBELLEMOTIF='$motif'";
	$connexion->query($requete);
}

function ajouterPieceAFournir($libelle,$motif){
	$connexion = getConnect();
	$requete =  "UPDATE TYPEMOTIF SET PIECES_A_FOURNIR='$libelle' WHERE LIBELLEMOTIF='$motif'";
	$connexion->query($requete);
}

function modifierPieceAFournir($piece,$motif){
	$connexion = getConnect();
	$requete =  "UPDATE TYPEMOTIF SET PIECES_A_FOURNIR='$piece' WHERE LIBELLEMOTIF='$motif'";
	$connexion->query($requete);
}

function getPiecesAFournir($idContrat){
	$connexion = getConnect();
	$requete = "SELECT idPiece_a_fournir_1 FROM PIECES_A_FOURNIRMOTIF WHERE idMotif = 1";
	$resultat = $connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	return $resultat->fetchAll();
}

function allConseillers(){
    $connexion = getConnect();
    $requete = "SELECT * FROM EMPLOYE WHERE categorie='Conseiller'";
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    return $resultat->fetchAll();
}


function allIdentifiants(){
	$connexion = getConnect();
	$requete = "SELECT * FROM IDENTIFIANT ";
    $resultat = $connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    return $resultat->fetchAll();
}