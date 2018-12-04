<?php

require_once('controleur/controleur.php');
    try{

        if(isset($_POST['connexion'])){
            //todo : verifier si la data base est vide
            //$idEmploye=(CtlAcceuil($_POST['identifiant'],$_POST['motDePasse']))->IDEMPLOYE;
            var_dump(CtlAcceuil($_POST['identifiant'],$_POST['motDePasse']));
            $client=checkClient('3'); // temporaire


        }elseif(isset($_POST['valider'])){
            switch ($_POST['action']) {
                case 'syntese':

                CtlSyntheseClient($_POST['numClient']);
                //CtlSyntheseClient('3');//temporaire
                    break;

                case 'modif':

                CtlModificationInfo($_POST['numClient']);
                    break;

                case 'opCompte':


                //CtlOperationCompte($_POST['compte']);//temporaire
                CtlOperationCompte($_POST['numClient'],$_POST['nomCompte']);
                    break;

                case 'rdv':

               $idEmploye = CtlPriseRdv($_POST['numClient']);
               echo 'idEmploye'.var_dump($idEmploye);
                    $idEmploye=intval($idEmploye);
                    echo 'intval idemploye'.var_dump($idEmploye);
               $rdvEmploye  = getRDV(3);
               var_dump($rdvEmploye); //todo : keep going
                CtlPlanning($rdvEmploye,0);
               echo 'idEmploye'.var_dump(intval($idEmploye));
                    break;

        }

        }elseif(isset($_POST['validerRecherche'])){

        }elseif(isset($_POST['ValiderRDV'])){

            CtlConfirmationRdv($_POST['IdEMPLOYERDV']);

        }elseif(isset($_POST['suiv'])){

            $rdvEmploye=getRDV($idEmploye);
            AfficherPlanning($rdvEmploye,0);

        }elseif(isset($_POST['prec'])){

        }else{

            CtlInterfaceLogin();

        }

    }catch(Exception $e1){
        echo $e1->getMessage();
    }