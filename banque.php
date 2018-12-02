<?php

require_once('controleur/controleur.php');
    try{

        if(isset($_POST['connexion'])){
            $idEmploye=(CtlAcceuil($_POST['identifiant'],$_POST['motDePasse']))->IDEMPLOYE;
            $client=checkClient('3'); // temporaire


        }elseif(isset($_POST['valider'])){
            switch ($_POST['action']) {
                case 'syntese':

                //CtlSyntheseClient($_POST['numClient']);
                CtlSyntheseClient('3');//temporaire
                    break;

                case 'modif':

                CtlModificationInfo('3');//temporaire
                    break;

                case 'opCompte':

                //CtlOperationCompte($_POST['compte']);//temporaire
                CtlOperationCompte($numCompte);//temporaire
                    break;

                case 'rdv':

               //CtlPriseRdv($_POST['numClient']);
               CtlPriseRdv('3');
                    break;

        }

        }elseif(isset($_POST['validerRecherche'])){

        }
        else{

            CtlInterfaceLogin();

        }

    }catch(Exception $e1){
        echo $e1->getMessage();
    }