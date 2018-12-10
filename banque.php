<?php

require_once('controleur/controleur.php');

try{

    if(isset($_POST['connexion'])){

        //todo : verifier si la data base est vide
        $employe = CtlAcceuil($_POST['identifiant'], $_POST['motDePasse']);
        $categorie = $employe->CATEGORIE;

    }elseif(isset($_POST['valider'])){

        $categorie = $_POST['categorie'];

        if(!empty($_POST['numClient'])){

            CtlnumClientExiste($_POST['numClient']);

            $numClient = $_POST['numClient'];

            switch ($_POST['action']) {
                case 'syntese':
                    CtlSyntheseClient($_POST['numClient']);
                    break;

                case 'modif':

                    CtlAfficherModificationInfo($_POST['numClient']);
                    break;

                case 'opCompte':

                    CtlAfficherOperationCompte($_POST['numClient'],$_POST['categorie']);
                    break;

                case 'rdv':

                    CtlPlanning(0,$categorie,$numClient);
                    break;

            }

        }elseif(!empty($_POST['IdConseiller'])){

            $idConseiller = $_POST['IdConseiller'];
            $action = $_POST['action'];
            
            switch($action){
                case 'inscrireClient':
                    CtlInscriptionClient($idConseiller);
                    break;

                case 'vendreContrat':
                    CtlContratDisponible();
                    break;    
                
                case 'ouvrirCompte': 
                    $comptes = allTypeCompte();
                    AfficherOuvrirCompte($comptes);
                    break;
                    
                case 'modifDecouvert': 
                    echo "Il faut la fonction afficherModifierMontantDécouvert";
                    break;  
                
                case 'resilier': 
                    break;  

                case 'planning': 
                    break;  
            }

        }else{

            $numClient = (isset($_POST['numClient'])) ? $_POST['numClient'] : '';

            CtlRetourAcceuil($_POST['categorie'], $numClient);
        }

    }elseif(isset($_POST['validerRecherche'])){

        //todo validerRecherche

    }elseif(isset($_POST['ValiderRDV'])){

        //CtlConfirmationRdv($_POST['IdRDVEmploye'],);

    }elseif(isset($_POST['suiv'])){

        $employe = intval($_POST['idEmp']);
        $rdvEmploye = getRDV($employe);
        $categorie = (empty($_POST['categorie'])) ? $categorie : $_POST['categorie'];

        CtlPlanning((intval($_POST['semCourante'])+1), $categorie, $_POST['numClient']);
    
    }elseif(isset($_POST['prec'])){

        $idEmploye = intval($_POST['idEmp']);
        $rdvEmploye = getRDV($idEmploye);
        $categorie = (empty($_POST['categorie'])) ? $categorie : $_POST['categorie'];

        CtlPlanning((intval($_POST['semCourante']) - 1), $categorie, $_POST['numClient']);

    }elseif(isset($_POST['modifier'])){

        //log as
        $categorie = $_POST['categorie'];
        $numClient = $_POST['numClient'];
        $adresse = $_POST['adresse'];
        $email = $_POST['mail'];
        $numTel = $_POST['tel'];
        $situationFamiliale = $_POST['situation'];
        $profession = $_POST['profession'];

        CtlValiderModificationInfo($numClient,$adresse, $email, $numTel, $situationFamiliale, $profession);
        CtlRetourAcceuil($categorie,$numClient);

    }elseif(isset($_POST['validerOp'])){

        $somme = $_POST['somme'];
        $numClient = $_POST['numClient'];

        //todo : verifier que la somme soit éligible pattern et que ce soit positif

        $operationCompte = (isset($_POST['operationcompte'])) ? $_POST['operationcompte'] : false;

        if($operationCompte) {

            switch ($_POST['operationcompte']) {

                case 'debit' :

                    CtlDebiterCompte($somme, $numClient, $_POST['actionCompte']);
                    break;

                case 'credit' :

                    CtlCrediterCompte($somme, $numClient, $_POST['actionCompte']);
                    break;

                default :

                    CtlRetourAcceuil($_POST['categorie'], $_POST['numClient']);

            }

    }
        //todo : throw erreur, ou pas car vue gère
        CtlRetourAcceuil($_POST['categorie'],$_POST['numClient']);

    }elseif(isset($_POST['idRDVEmploye'])){

        $categorie = $_POST['categorie'];
        $numClient = $_POST['numClient'];
        //$idMotif = $_POST['idMotif']; // controllé par la vue et par le controlleur quand le directeur en creera
        $idMotif = ''; // controllé par la vue et par le controlleur quand le directeur en creera
        $DATEHEURERDV = $_POST['choixRDV'];
        CtlValiderRDV($_POST['semCourante'],intval($idMotif), intval($numClient), $DATEHEURERDV,$categorie);

    }elseif(isset($_POST['ajouter'])){
        $idConseiller = $_POST['idConseiller'];
        $lastName = $_POST['lastName'];
        $firstName = $_POST['firstName'];
        $bday = $_POST['bday'];
        $adresse = $_POST['adresse'];
        $mail = $_POST['mail'];
        $tel = $_POST['tel'];
        $situation = $_POST['situation'];
        $profession = $_POST['profession'];

        if(isset($lastName) && isset($firstName) && isset($bday) && isset($adresse) && isset($adresse) && isset($mail) && isset($tel) && isset($situation) && isset($profession)){

            CtlenregistrerClient($idConseiller, $lastName, $firstName, $bday, $adresse, $mail, $tel, $situation, $profession);

        }else{

            echo "DES ERREURS DANS LE FORMULAIRE";

        }

    }elseif(isset($_POST['vendre'])){
        $numClient = $_POST['numClient'];
        $libelle = $_POST['actionContrat'];
        $dateContrat = $_POST['dateContrat'];
        $tarifMensuel = $_POST['tarifMensuel'];
        CtlNouveauContratClient($numClient, $dateContrat, $tarifMensuel, $libelle);
    }else{

        CtlInterfaceLogin();

    }

}catch(Exception $e1){

    $categorie = (isset($categorie))?$_POST['categorie']:'';

    CtlErreur($categorie,$e1->getMessage());
}