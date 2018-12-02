<?php

require_once('controleur/controleur.php');
    try{

        if(isset($_POST['connexion'])){
            $idEmploye=(CtlAcceuil($_POST['identifiant'],$_POST['motDePasse']));



        }elseif(isset($_POST['bouton1'])){

        }
        else{
            CtlInterfaceLogin();

        }

    }catch(Exception $e1){
        echo $e1->getMessage();
    }