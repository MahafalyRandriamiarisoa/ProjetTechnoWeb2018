<?php
    require_once('../modele/modele.php');
    require_once('../vue/vue.php');

/**  
 * Fonction pour le contrôle de la toute première interface, l'interface de connexion
 *@param message qui potentiellement un message inquant une erreur
 */
    function CtlInterfaceLogin($msg){ 
        AfficherInterfaceLogin($msg);
            }
   

/**
 * Fonction pour le contrôle de l'Acceuil
 * 
 * il s'agit de l'interface qui suit l'identification,
 *  
 */           
    function CtlAcceuil($login,$mdp){
        if(!empty($login) && !empty($mdp)){
            $employe=checkLogin($login,$mdp);
            if(!empty($employe)){
                $idEmploye=$employe->IDEMPLOYE;
                AfficherAcceuil($idEmploye,$employe->CATEGORIE);
                return $idEmploye;
            }else{
                AfficherInterfaceLogin("Identifiants Incorrectes");
            }
        }else{
            AfficherInterfaceLogin("Identifiants Incorrectes");
        }
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
	/**
	*Fonction 
	*
	*
	*/
	/*function Ctl
	
