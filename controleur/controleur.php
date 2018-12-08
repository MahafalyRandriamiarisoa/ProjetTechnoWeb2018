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
 * @param $numClient identifiant potentiellement rattaché à un client
 * @return array [0]:
 *      cette ligne correspond à un client identifiable par le numClient passé en paramètre
 * @throws Exception
 *      correspond au cas où le numèro client n'existe pas (ou non spécifié lors d'une saisie)?
 */
function CtlnumClientExiste($numClient){
    $client = checkClient($numClient);
        if($client) {
            //(checkClient($numClient));
            return $client[0];
        }

        throw new Exception("num client inexistant");
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

                AfficherAcceuil($employe->CATEGORIE,"");
                return $employe;
            }
        }
        throw new Exception("login non trouvé");
    }
    function CtlRetourAcceuil($categorie,$numClient){

        AfficherAcceuil($categorie,$numClient);

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
	function CtlSyntheseClient($numClient1){
        $numClient = intval($numClient1);
        $client = checkClient($numClient);
        $contrats = getContratsClient($numClient);
        $comptes = getComptesClient($numClient);
        $synthese = getSyntheseClient($numClient); //todo :
        
        AfficherSyntheseClient($client,$comptes,$contrats,getEmploye($client[0]->IDEMPLOYE)->NOMEMPLOYE);
    }

/***
 * Fonction de controle des modifications des données d'un client via son numClient
 * @param $numclient parametre déjà controllé via "rechercher un client" ou par saisie interactive
 * @throws Exception
 *      correspond à une exception concernant l'existence du client par rapport au numClient
 *
 */
function CtlAfficherModificationInfo($numClient){


        CtlnumClientExiste($numClient);

        $client=checkClient($numClient);

        $categorie = $_POST['categorie'];

        AfficherModificationInfo($client[0],$categorie);



    }

    function CtlValiderModificationInfo($numClient,$adresse, $email, $numTel, $situationFamiliale, $profession){
        modifierInfosClient($numClient,$adresse, $email, $numTel, $situationFamiliale, $profession);
    }

/***
 * Fonction qui controle les operations sur le compte d'un client, la restriction de choix de compte se fait par Affichage au préalable des comptes du client
 * @param $compte le compte d'un client sous forme d'objet
 */
    function CtlAfficherOperationCompte($numClient,$categorie){
        $comptes = getComptesClient($numClient);
        AfficherOperationCompte($comptes,$numClient,$categorie);
    }


    function CtlPlanning($rdvEmploye,$int,$categorie,$numClient){

        AfficherPlanning($rdvEmploye,$int, $categorie,$numClient);
    }

/**
 * Fonction pour controller la prise d'un rendez-vous
 * @param $numclient  parametre déjà controllé via "rechercher un client" ou par saisie interactive
 * @return array : rdv
 *      correspond à la demande d'un rdv
 * @throws Exception
 *      correspond à une exception liée au fait que le numClient  n'existe pas dans la dataBase
 */
function CtlAfficherRDVClient($numClient){

    CtlnumClientExiste($numClient);

    $client=checkClient($numClient);
   //AfficherPriseRdv($client);
    return getRDV($client[0]->IDEMPLOYE);
}

/**
 * Fonction pour enregistrer un RDV champ par champ
 *
 * @param $IDEMPLOYE
 * @param $IDMOTIF
 * @param $NUMCLIENT
 * @param $DATEHEURERDV
 *
 */
function CtlValiderRDV($idEmploye, $idMotif, $numClient, $DATEHEURERDV){
    //todo : envoyer date avec slash

    enregistrerRDV($idEmploye, $idMotif, $numClient, $DATEHEURERDV);//$rdv a comme attribut (IDEMPLOYE,IDMOTIF,NUMCLIENT, DATEHEURERDV
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
    var_dump($soldeFinal);

    var_dump($soldeFinal);

    if(($valeur>=0)&&($valeur<=$soldeFinal)){

        debiterCompte($valeur,$numClient,$nomCompte);
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

    crediterCompte($valeur,$numClient,$nomCompte);

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



    $comptes = getComptesPotentielsClient($numClient);

    // AfficherComptesDisponibles($comptes,$categorie);
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

    setMontantDecouvertAutorise($numClient, $nomCompte, $montant);
}


/**
 * Fonction affichant un message d'erreur permettant de revenir sur la page login
 * @param $msg
 */
function CtlErreur($categorie,$msg){

    AfficherErreur($categorie,$msg);

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
	
