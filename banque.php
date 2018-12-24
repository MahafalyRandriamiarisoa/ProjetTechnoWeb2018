<?php

require_once('controleur/controleur.php');

try{

    if(isset($_POST['connexion'])){

        CtlAcceuil($_POST['identifiant'], $_POST['motDePasse']);


    }elseif(isset($_POST['deconnexion'])){
        CtlInterfaceLogin();
    }elseif(isset($_POST['valider'])){

        $categorie = $_POST['categorie'];
        $action = $_POST['action'];
        $numClient = '';
        
        if(isset($_POST['numClient']) && !empty($_POST['numClient']) && !isset($_POST['birthday'])){
            $numClient = $_POST['numClient'];

        }elseif(empty($numClient) && isset($_POST['nomClient']) && isset($_POST['birthday'])){
            $nomClient = $_POST['nomClient'];
            $birthday = $_POST['birthday'];
        }

        if(isset($nomClient) && isset($birthday)){
            CtlRetrouverClient($nomClient, $birthday, $action);
        }

        switch($categorie){
            case 'Agent':
                CtlAfficherAction($action, $numClient);
                break;
            case 'Conseiller' : 
                CtlAfficherAction($action);
                break;
            case 'Directeur' : 
                CtlMenuDirecteur($action);
                break;
        }

    }elseif(isset($_POST['validerRecherche'])){

        //todo validerRecherche

    }elseif(isset($_POST['ValiderRDV'])){

        //CtlConfirmationRdv($_POST['IdRDVEmploye'],);

    }elseif(isset($_POST['suiv'])){

        $idEmploye = intval($_POST['idEmp']);
        //$rdvEmploye = getRDV($idEmploye);
        $categorie = (empty($_POST['categorie'])) ? $categorie : $_POST['categorie'];

        CtlPlanning((intval($_POST['semCourante'])+1), $categorie, $_POST['numClient'], $idEmploye);
    }elseif(isset($_POST['prec'])){

        $idEmploye = intval($_POST['idEmp']);
       // $rdvEmploye = getRDV($idEmploye);
        $categorie = (empty($_POST['categorie'])) ? $categorie : $_POST['categorie'];

        CtlPlanning((intval($_POST['semCourante'])-1), $categorie, $_POST['numClient'], $idEmploye);
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

        $somme = isset($_POST['somme']) ? $_POST['somme'] : false;
        $numClient = $_POST['numClient'];

        $operationCompte = (isset($_POST['operationcompte'])) ? $_POST['operationcompte'] : false;

        if($operationCompte) {

            if(!$somme){
                throw new Exception('Veuillez préciser une somme');
            }

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

            CtlRetourAcceuil($_POST['categorie'],$_POST['numClient']);
        }else{
            throw new Exception("Veuillez choisir un type d'opération");
        }

    }elseif(isset($_POST['idRDVEmploye'])){

        $categorie = $_POST['categorie'];
        $numClient = $_POST['numClient'];
        $idMotif = $_POST['idMotif']; // controllé par la vue et par le controlleur quand le directeur en creera
        $DATEHEURERDV = $_POST['choixRDV'];
        CtlValiderRDV($_POST['semCourante'], intval($idMotif), intval($numClient), $DATEHEURERDV,$categorie);

    }elseif(isset($_POST['ajouter'])){

        $idConseiller = $_POST['conseiller'];
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
        }

    }elseif(isset($_POST['vendre'])){
        $numClient = $_POST['numClient'];
        $libelle = $_POST['actionContrat'];
        $tarifMensuel = $_POST['tarifMensuel'];
        CtlNouveauContratClient($numClient, $tarifMensuel, $libelle);

    }elseif(isset($_POST['rechercheClientConseiller'])){
        $action = $_POST['action'];
        $numClient = '';
        if(isset($_POST['numClient']) && !empty($_POST['numClient'])){
            $numClient = $_POST['numClient'];
            CtlAfficherAction($action, $numClient);
        }elseif(isset($_POST['nomClient']) && !empty($_POST['nomClient']) && isset($_POST['birthday']) && !empty($_POST['birthday'])){
            $nomClient = $_POST['nomClient'];
            $birthday = $_POST['birthday'];
            CtlAfficherAction($action, '', $nomClient, $birthday);
        }else{
            CtlErreur('Conseiller', 'Il faut remplir soit le numéro client, soit le nom du client ainsi que sa date de naissance');
        }
    }elseif(isset($_POST['choixConseiller'])){
        $idConseiller = $_POST['selectConseiller'];
        CtlPlanningConseiller($idConseiller);
    }elseif(isset($_POST['ouvrir']) && isset($_POST['actionOpenCompte'])){
        $nomsComptes = $_POST['actionOpenCompte'];
        CtlOuvrirCompte($_POST['numClient'], $nomsComptes, 0);
    }elseif(isset($_POST['resilier'])){
        $typeResiliation = $_POST['actionResilier'];
        $numClient = $_POST['numClient'];
        CtlResilier($typeResiliation, $numClient);
	}elseif(isset($_POST['modifierId'])){
		CtlModifierIdentifiants();
    }elseif(isset($_POST['dispos'])){
        $dispos = $_POST['dispos'];
        $idEmploye = $_POST['idEmp'];
        CtlDispoConseiller($dispos, $idEmploye);
    }elseif(isset($_POST['modifierDecouvert'])){
        $comptesConcernes = $_POST['compteConcerne'];
        $montantDecouverts = $_POST['setMontantDecouvert'];
        $numClient = intval($_POST['numClient']);
        CtlModifierMontantDecouvert($comptesConcernes, $montantDecouverts, $numClient);
	}elseif(isset($_POST['ajouterCo'])){
		$item=$_POST['aOuvrir'];
		$libelle=$_POST['nomCo'];
		CtlAjouterListeContratCompte($item,$libelle);
	}elseif(isset($_POST['modifierContrat'])){
		CtlModifierListeContrat();
	}elseif(isset($_POST['supprimerContrat'])){
		$contrat=$_POST['contratSuppr'];
		CtlSupprimerListeContrat($contrat);
	}elseif(isset($_POST['modifierCompte'])){
		CtlModifierListeCompte();
	}elseif(isset($_POST['supprimerCompte'])){
		$compte=$_POST['compteSuppr'];
		CtlSupprimerListeCompte($compte);
	}elseif(isset($_POST['ajoutPiece'])){
		$recup=$_POST['modifPiece'];
		$motif=explode("|",$recup);
		$piece=$_POST['newList'];
		CtlAjouterPiece($piece,$motif[0]);
	}elseif(isset($_POST['supprPiece'])){
		$recup=$_POST['modifPiece'];
		$motif=explode("|",$recup);
		$piece=$_POST['pieceasuppr'];
		CtlSupprimerPiece($piece,$motif[0]);
	}elseif(isset($_POST['modifierPiece'])){
		$recup=$_POST['modifPiece'];
		$motif=explode("|",$recup);
		$piece=$_POST['pieceamodif'];
		CtlModifierPiece($piece,$motif[0]);
    }elseif(isset($_POST['synthese'])){
        $numClient = $_POST['leclient'];
        CtlSyntheseClient($numClient);
    }elseif(isset($_POST['validerChoixClient'])){
        if(isset($_POST['leclient'])){
            $numClient = $_POST['leclient'];
            $action = $_POST['action'];
            CtlAfficherAction($action, $numClient);
        }
    }else{
        CtlInterfaceLogin();
    }

}catch(Exception $e1){

    $categorie = (isset($_POST['categorie']))?$_POST['categorie']:'';
    CtlErreur($categorie,$e1->getMessage());
}