<?php 
    try{
        if(isset($_POST['connexion'])){
            CtlAcceuil($_POST['identifiant'],$_POST['motDePasse']);
        }elseif(isset($_POST['bouton1'])){

        }
        else{
            CtlAfficherInterfaceLogin();
        }

<<<<<<< HEAD
    }
    catch(Exception $e1){
=======
    }catch(Exception $e1){
>>>>>>> be76b2f12de14de6727ab55a3c905ab6db8ab302
        echo $e1->getMessage();
    }