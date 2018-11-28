<?php 
    try{
        if(isset($_POST['connexion'])){
            CtlAcceuil($_POST['identifiant'],$_POST['motDePasse']);
        }else{
            CtlAfficherInterfaceLogin();
        }

    }catch(Exception $e1){
        echo $e1->getMessage();
    }