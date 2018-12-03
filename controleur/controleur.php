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
 * Fonction pour effectuer le debit d'un compte avec controle
 * @param $debit montant à débiter sur le compte spécifié
 * @param $numClient numéro du client auquel appartient le compte mentionné ci-dessous
 * @param $nomCompte type de compte
 */
function CtldebiterCompte($debit, $numClient, $nomCompte){
    $compte=getCompte($numClient,$nomCompte);
    $soldeFinal=$compte->SOLDE+$compte->MONTANTDECOUVERT;
    if(($debit>=0)&&($debit>=$soldeFinal)){
        debiterCompte($compte);
    }
}



function CtlRechercherClientNum($numClient){
    if(CtlnumClientExiste()){
//todo : reflechir à quelle vue mettre
    }
}

	/**
	*Fonction 
	*
	*
	*/
	//function Ctl
	
