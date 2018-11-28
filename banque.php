<?php 
    try{
        if(isset($_POST['connexion'])){
            CtlAcceuil($_POST['identifiant'],$_POST['motDePasse']);
        }else{
            CtlAfficherInterfaceLogin();
        }

    }catch(PDOException e1){
        echo e1->getMessage();
    }