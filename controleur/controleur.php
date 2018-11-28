<?php
    require_once('../modele/modele.php');
    require_once('../vue/vue.php');

/**  
 * Fonction pour le contrôle de la toute première interface, l'interface de connexion
 *
 */
    function CtlInterfaceLogin(){ 
        AfficherInterfaceLogin();
            }

/**
 * Fonction pour le contrôle de l'Acceuil
 * 
 * il s'agit de l'interface qui suit l'identification,
 * On y récupere la categorie de l'employé ainsi que 
 */           
    function CtlAcceuil($login,$mdp){
        if(!emty($login) && !enmpty($mdp)){
            $employe=checkLogin($login,$mdp);
            if(!empty($employe){
                AfficherAcceuil(checkLogin($employe,$employe[0]->CATEGORIE);
            }
        }
    }