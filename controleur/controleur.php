<?php
    require_once('modele/modele.php');
    require_once('vue/vue.php');

/**  
 * Fonction pour le contrôle de la toute première interface, l'interface de connexion
 *@param message qui potentiellement un message inquant une erreur
 */
    function CtlInterfaceLogin(){
        AfficherInterfaceLogin();
            }

/**
 * Fonction pour verifier si un client, fonction particulierement importante lors de la saisie interactive directe du numClient
 * @param $numClient numero potentiellement rattaché à un client
 * @return bool retourne true si le client est dans la base de donnée, false si non
 */
function CtlnumClientExiste($numClient){
        if(checkClient($numClient))
            return true;

        return false;
}
/**
 * Fonction pour le contrôle de l'Acceuil
 *
 * il s'agit de l'interface qui suit l'identification,
 *
 * @throws Exception si les login
 */
    function CtlAcceuil($login,$mdp){
        if(!empty($login) && !empty($mdp)){

            $employe=checkLogin($login,$mdp);

            if(!empty($employe)){

                AfficherAcceuil($employe->CATEGORIE);
                return $employe;
            }
        }

        AfficherInterfaceLogin();
        return null;
    }


/**
 * Fonction pour enregistrer un client champ par champ
 * @param $idEmploye
 *      Correspond au conseiller du client
 * @param $nom
 *      Correspond au nom du client
 * @param $prenom
 *      Correspond au prénom du client
 * @param $dateNaissance
 *      Correspond à la date de naissance du client
 * @param $adresse
 *      Correspond à l'adresse postale du client
 * @param $email
 *      Correspond à l'adresse eMail du client
 * @param $numTel
 *      Correspond au numéro de téléphone du client
 * @param $situationFamiliale
 *      Correspond à la situation familiale du client
 * @param $profession
 *      Correspond à la profession du client
 */
function CtlenregistrerClient($idEmploye, $nom, $prenom, $dateNaissance, $adresse, $email, $numTel, $situationFamiliale, $profession){
 //todo : verifier si le client n'existe pas déjà
        enregistrerClient($idEmploye, $nom, $prenom, $dateNaissance, $adresse, $email, $numTel, $situationFamiliale, $profession);

		AfficherAcceuil(getEmploye($idEmploye)->CATEGORIE);
	}


/***
 * Fonction qui controle l'affichage de la synthese du client par son numClient
 * @param $numclient parametre déjà controllé via "rechercher un client" ou par saisie interactive
 */
	function CtlSyntheseClient($numclient){

        $client =checkClient($numclient);

        $compte=getComptesClient($client->NUMCLIENT);
        $contrat=getContratsClient($client->NUMCLIENT);

        AfficherSyntheseClient($client,$compte,$contrat);
    }

/***
 * Fonction de controle des modifications des données d'un client via son numClient
 * @param $numclient parametre déjà controllé via "rechercher un client" ou par saisie interactive
 */
    function CtlModificationInfo($numclient){

        $client =checkClient($numclient);

        AfficherModificationInfo($client);
        //AfficherModification($info,$client);
    }

/***
 * Fonction qui controle les operations sur le compte d'un client, la restriction de choix de compte se fait par Affichage au préalable des comptes du client
 * @param $compte le compte d'un client sous forme d'objet
 */
    function CtlOperationCompte($numCompte){
        $compte=getCompte($numCompte);
        AfficherOperationCompte($compte);
    }

/**
 * Fonction pour controller la prise d'un rendez-vous
 * @param $numclient  parametre déjà controllé via "rechercher un client" ou par saisie interactive
 */
function CtlPriseRdv($numclient){
        $client=checkClient($numclient);
        AfficherPriseRdv($client);
}

/**
 * Fonction pour enregistrer un RDV champ par champ
 * @param $IDEMPLOYE
 * @param $IDMOTIF
 * @param $NUMCLIENT
 * @param $DATEHEURERDV
 */
function CtlConfirmationRdv($IDEMPLOYE, $IDMOTIF, $NUMCLIENT, $DATEHEURERDV){
    enregistrerRDV($IDEMPLOYE,$IDMOTIF,$NUMCLIENT,$DATEHEURERDV);//$rdv a comme attribut (IDEMPLOYE,IDMOTIF,NUMCLIENT, DATEHEURERDV
}

/**
 * Fonction pour effectuer le debit d'un compte avec controle
 * @param $valeur montant à débiter sur le compte spécifié
 * @param $numClient numéro du client auquel appartient le compte mentionné ci-dessous
 * @param $nomCompte type de compte
 */
function CtlDebiterCompte($valeur, $numClient, $nomCompte){
    $compte=getCompte($numClient,$nomCompte);
    $soldeFinal=$compte->SOLDE+$compte->MONTANTDECOUVERT;
    if(($valeur>=0)&&($valeur>=$soldeFinal)){
        debiterCompte($compte);
    }
    else CtlErreur("Fond Insuffisant pour un débit de : (".$valeur.")");
}

/**
 * Fonction pour crediter un compte d'une certaine somme
 * @param $valeur montant à créditer sur le compte spécifié
 * @param $numClient numéro du client auquel appartient le compte mentionné ci-dessous
 * @param $nomCompte type de compte
 */
function CtlCrediterCompte($valeur, $numClient, $nomCompte){
    $compte=getCompte($numClient,$nomCompte);
    crediterCompte($valeur,$compte);
}


function CtlRechercherClientNum($numClient){
    if(CtlnumClientExiste()){
//todo : reflechir à quelle vue mettre
    }
}


/**
 * Fonction qui permet à un conseiller de proposer des contrats à un client qu'il ne possède pas déjà
 * @param $numClient
 *      correspond au numèro permettant d'accéder à un unique Client
 */
function CtlContratDisponible($numClient){
    $contrats=getContratsPotentielClient($numClient);
    AfficherContratsDisponibles($contrats);
}

/**
 * Fonction pour la gestion de la vente d'un contrat à un client
 *
 * @param $numClient
 *      correspond au numèro permettant d'accéder à un unique Client
 * @param $DATEOUVERTURECONTRAT //todo ; remplacer par un getDate dans la fonction
 * @param $TARIFMENSUEL
 *      montant débité chaque mois
 * @param $LIBELLE
 *      correspond au nom du contrat
 */
function CtlVendreContrat($numClient, $DATEOUVERTURECONTRAT, $TARIFMENSUEL, $LIBELLE){
    enregistrerContrat($numClient,$DATEOUVERTURECONTRAT,$TARIFMENSUEL,$LIBELLE);
}
function CtlResilierContrat($numClient,$IDCONTRAT){
    //todo : vérifier quelles précautions sont à prendre
    resilierContrat($IDCONTRAT);
}
/**Fonction qui permet de proposer à un client d'ouvrir un compte qu'il ne possède pas déjà
 * @param $numClient
 *      correspond au numèro permettant d'accéder à un unique Client
 */
function CtlCompteDisponible($numClient){

    $comptes=getComptesPotentielsClient($numClient);

    AfficherComptesDisponibles($comptes);
}

/**
 * Fonction pour ouvrir un compte champ par champ
 * @param $NUMCLIENT
 *      correspond au numèro permettant d'accéder à un unique Client
 * @param $NOMCOMPTE
 *      correspond au type de compte
 * @param $DATEOUVERTURE //todo : remplacer par un getDate dans la fonction
 * @param $MONTANTDECOUVERT
 *      à 0 si non autorisé, il peut être modifier par le conseiller
 */
function CtlOuvrirCompte($NUMCLIENT, $NOMCOMPTE, $DATEOUVERTURE, $MONTANTDECOUVERT){
    //todo : $DATEOUVERTURE= fonction pour getDateNOW();
    ouvertureCompte($NUMCLIENT,$NOMCOMPTE,$DATEOUVERTURE,$MONTANTDECOUVERT);
}

/**
 * Fonction qui ferme le compte d'un Client
 * @param $numClient
 *      correspond au numèro permettant d'accéder à un unique Client
 * @param $nomCompte
 *      correspond au type de compte
 */
function CtlFermerCompte($numClient, $nomCompte){

    fermerCompte($numClient,$nomCompte);
}

/**
 * Fonction qui modifie le Montant du découvert d'un compte appartenant à un client
 * @param $montant
 *      correspond au nouveau montant du montant
 * @param $numClient
 *      correspond au numèro permettant d'accéder à un unique Client
 * @param $nomCompte
 *      correspond au type de compte
 */
function CtlModifierMontantDecouvert($montant,$numClient,$nomCompte){

    setMontantDecouvert($montant,$numClient,$nomCompte);
}


/**
 * Fonction affichant un message d'erreur permettant de revenir sur la page login
 * @param $msg
 */
function CtlErreur($msg){
    AfficherErreur($msg);
}

function CtlGestionClient($numClient){
    //todo : reflechir à quelle vue mettre
    //après avoir "log" un Client
}
	/**
	*Fonction 
	*
	*
	*/
	//function Ctl
	
