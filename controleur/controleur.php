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
        if(!emty($login) && !empty($mdp)){
            $employe=checkLogin($login,$mdp);
            if(!empty($employe){
                AfficherAcceuil(checkLogin($employe,$employe[0]->CATEGORIE);
            }else{
                AfficherInterfaceLogin("Identifiants Incorrectes");
            }
        }else{
            AfficherInterfaceLogin("Identifiants Incorrectes");
        }
    }