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

                AfficherAcceuil($employe,$employe->CATEGORIE);
                return $employe;
            }
        }

        AfficherInterfaceLogin();
        return null;
    }

/***
 * @param $nom
 * @param $prenom
 * @param $dateNaiss
 * @param $numTel
 * @param $adresse
 * @param $situationFamilial
 * @param $idEmploye
 */
	function CtlEnregistrerClient($nom,$prenom,$dateNaiss,$numTel,$adresse,$situationFamilial,$idEmploye){

		enregistrerClient($nom,$prenom,$dateNaiss,$numTel,$adresse,$situationFamilial,$idEmploye);

		AfficherAcceuil($idEmploye,getEmploye($idEmploye)->CATEGORIE);
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
	*Fonction 
	*
	*
	*/
	//function Ctl
	
