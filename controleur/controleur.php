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
 * elle s'adapte selon la catégorie d'employé
 */           
    function CtlAcceuil($login,$mdp){
        if(!emty($login) && !enmpty($mdp)){
            if(!empty(checkLogin($login,$mdp))){
                AfficherAcceuil(getCategorie($login))
            }
        }
    }