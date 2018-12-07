<?php

require_once('controleur/controleur.php');
    try{

        if(isset($_POST['connexion'])){

            //todo : verifier si la data base est vide
            $employe=CtlAcceuil($_POST['identifiant'],$_POST['motDePasse']);

            $categorie=$employe->CATEGORIE;

        }elseif(isset($_POST['valider'])){

            if(!empty($_POST['numClient'])){

                switch ($_POST['action']) {

                    case 'syntese':

                        CtlSyntheseClient($_POST['numClient']);
                        echo 'FIN CASE SYNTESE';
                        break;

                    case 'modif':
                        $numClient = $_POST['numClient'];
                        $adresse = $_POST['adresse'];
                        $email = $_POST['mail'];
                        $numTel = $_POST['tel'];
                        $situationFamiliale = $_POST['situation'];
                        $profession = $_POST['profession'];
                        CtlModificationInfo($numClient,$adresse, $email, $numTel, $situationFamiliale, $profession);
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

            //CtlConfirmationRdv($_POST['IdRDVEmploye'],);

        }elseif(isset($_POST['suiv'])){
            $employe=intval($_POST['idEmp']);
            $rdvEmploye=getRDV($employe);
            $categorie=(empty($_POST['categorie']))?$categorie:$_POST['categorie'];
            AfficherPlanning($rdvEmploye,(intval($_POST['semCourante'])+1),$categorie,$_POST['numClient']);
        
        }elseif(isset($_POST['prec'])){
            $idEmploye=intval($_POST['idEmp']);
            $rdvEmploye=getRDV($idEmploye);
            $categorie=(empty($_POST['categorie']))?$categorie:$_POST['categorie'];
            AfficherPlanning($rdvEmploye,(intval($_POST['semCourante'])-1),$categorie,$_POST['numClient']);

        }else{

            CtlInterfaceLogin();

        }

    }catch(Exception $e1){
         CtlErreur($e1->getMessage());
    }