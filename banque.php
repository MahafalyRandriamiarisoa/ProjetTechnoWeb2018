<?php

require_once('controleur/controleur.php');
    try{

        if(isset($_POST['connexion'])){
            //todo : verifier si la data base est vide
            $idEmploye=CtlAcceuil($_POST['identifiant'],$_POST['motDePasse']);



        }elseif(isset($_POST['valider'])){

            if(!empty($_POST['numClient'])){

                switch ($_POST['action']) {

                    case 'syntese':

                        CtlSyntheseClient($_POST['numClient']);
                        echo 'FIN CASE SYNTESE';
                        break;

                    case 'modif':

                        CtlModificationInfo($_POST['numClient']);
                        break;

                    case 'opCompte':

                        CtlOperationCompte($_POST['numClient'], $_POST['nomCompte']);
                        break;

                    case 'rdv':

                        $rdvEmploye = CtlPriseRdv($_POST['numClient']);
                        CtlPlanning($rdvEmploye, 0);
                        break;

                }
            }
            else{
                echo 'DEBUT RETOUR ACCEUIL';
                CtlRetourAcceuil($_POST['categorie']);
            }

        }elseif(isset($_POST['validerRecherche'])){

        }elseif(isset($_POST['ValiderRDV'])){

            CtlConfirmationRdv($_POST['IdEMPLOYERDV']);

        }elseif(isset($_POST['suiv'])){
            $idEmploye=intval($_POST['idEmp']);
            $rdvEmploye=getRDV($idEmploye);
            AfficherPlanning($rdvEmploye,(intval($_POST['semCourante'])+1));

        }elseif(isset($_POST['prec'])){
            $idEmploye=intval($_POST['idEmp']);
            $rdvEmploye=getRDV($idEmploye);
            AfficherPlanning($rdvEmploye,(intval($_POST['semCourante'])-1));

        }else{

            CtlInterfaceLogin();

        }

    }catch(Exception $e1){
         CtlErreur($e1->getMessage());
    }