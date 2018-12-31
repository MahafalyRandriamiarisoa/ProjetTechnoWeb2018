<?php
    require_once('modele/modele.php');
    require_once('vue/vue.php');

    class Client
    {
       public $NUMCLIENT;
       public $IDEMPLOYE;
       public $NOM;
       public $PRENOM;
       public $DATEDENAISSANCE;
       public $ADRESSE;
       public $EMAIL;


       public function __construct()
        {
                $this->NUMCLIENT = '';
                $this->IDEMPLOYE = '';
                $this->NOM = '';
                $this->PRENOM = '';
                $this->DATEDENAISSANCE = '';
                $this->ADRESSE = '';
                $this->EMAIL = '';
            }



    }
/**  
 * Fonction pour le contrôle de la toute première interface, l'interface de connexion
 *@param message qui potentiellement un message inquant une erreur
 */

function CtlInterfaceLogin(){
    AfficherInterfaceLogin();
}

/**à supprimer
 * Fonction pour verifier si un client, fonction particulierement importante lors de la saisie interactive directe du numClient
 * @param $numClient identifiant potentiellement rattaché à un client
 * @return array [0]:
 *      cette ligne correspond à un client identifiable par le numClient passé en paramètre
 * @throws Exception
 *      correspond au cas où le numèro client n'existe pas (ou non spécifié lors d'une saisie)?
 */
function CtlnumClientExiste($numClient){
    $numClient = intval($numClient);
    $client = checkClient($numClient);

    if(!($client)) {
        throw new Exception("Le numéro client est inexistant");
    }
}
/**
 * Fonction pour le contrôle de l'Acceuil
 *
 * il s'agit de l'interface qui suit l'identification,
 *
 * @throws Exception si les login
 */
function CtlAcceuil($login,$mdp){
    if(!empty($login) && !empty($mdp)){

        $employe=checkLogin($login,$mdp);
        if(!empty($employe)){

            AfficherAcceuil($employe->CATEGORIE,"",false);
            exit;

        }else {
            throw new Exception("Votre identifiant ou votre mot de passe n'a pas été reconnu. Si vous rencontrez des difficultés pour vous connecter, veuillez contacter un de nos téléconseillers au 3639* choix 4.");
        }

    }else {
        throw new Exception("Veuillez remplir les champs");
    }
}

function CtlRetourAcceuil($categorie,$numClient){

    AfficherAcceuil($categorie,$numClient,true);

}

function CtlRechercherClient($nomClient, $birthday, $action){

    $match = preg_match('/(^[a-z]*$)/i', $nomClient);

    if($match == 1){
        $clients = rechercherClient($nomClient, $birthday);
        AfficherChoisirClient($clients, $action, 'Conseiller');
    }else{
        throw new Exception("Le client est introuvable");
    }

}

function CtlAfficherAction($action, $numClient = '', $nomClient = '', $birthday = ''){

    $match = preg_match('/^[0-9]*$/', $numClient);

    if($match != 1){
        throw new Exception("Le numéro client est incorrect");
    }

    if(!empty($nomClient) && !empty($birthday)){
        CtlRechercherClient($nomClient, $birthday, $action);
    }

    switch ($action) {

        case 'syntese':
            CtlnumClientExiste(intval($numClient));
            CtlSyntheseClient($numClient, 'Agent');
            break;

        case 'modif':
            CtlnumClientExiste(intval($numClient));
            CtlAfficherModificationInfo($numClient);
            break;

        case 'opCompte':
            CtlnumClientExiste(intval($numClient));
            CtlAfficherOperationCompte($numClient,'Agent');
            break;

        case 'rdv':
            CtlnumClientExiste(intval($numClient));
            CtlPlanning(0,'Agent',$numClient, ''); //todo supprimer categorie
            break;

        case 'inscrireClient' :
            CtlInscriptionClient();
            break;

        case 'vendreContrat' :

            if($numClient=='') {

                AfficherRechercherClient($action);

            }else{

                CtlnumClientExiste(intval($numClient));

                CtlAfficherVendreContrat($numClient);
            }
            break;

        case 'ouvrirCompte' :
            if($numClient=='') {
                AfficherRechercherClient($action);
            }else {
                CtlnumClientExiste($numClient);
                CtlAfficherOuvrirCompte($numClient);
            }
            break;

        case 'modifDecouvert' :
            if($numClient=='') {
                AfficherRechercherClient($action);
            }else {
                CtlnumClientExiste($numClient);
                CtlAfficherModificationDecouvert($numClient);//todo :
            }
            break;

        case 'resilier' :
            if($numClient=='') {
                AfficherRechercherClient($action);
            }else {
                CtlnumClientExiste($numClient);
                CtlAfficherResilier($numClient);//todo : Choix de la resal bref
            }
            break;

        case 'planning':

            CtlAfficherPlanning();//todo : gerer les idConseillers
            break;

        case 'synteseClientConseiller':
            if(!empty($numClient)){
                CtlnumClientExiste($numClient);
                CtlSyntheseClient($numClient, 'Conseiller'); 
            }else{
                AfficherRechercherClient($action);
            }
            break;
    }

}


function CtlMenuDirecteur($action){
    switch($action){
    case 'modifId':
			$identifiants=allIdentifiants();
			//$identifiants=getAllEmployes();
			CtlAfficherModificationId($identifiants);
			break;
	case 'modifMotif':
			$comptes=allTypeCompte();
			$contrats=allContrats();
			CtlAfficherModificationListeContratCompte($comptes,$contrats);
			break;
	case 'modifPiece':
			$pieces=allMotif();
			CtlAfficherModificationPiece($pieces);
			break;
    case 'stat':
            $date = date('Y-m-d');
            $dateInterval1 = date('Y-m-d', strtotime($date."- 1 week"));
		    CtlAfficherStatistiques($date, $dateInterval1, $date);
			break;
    }
}

function CtlAfficherStatistiques($date, $dateInterval1, $dateInterval2){
    $dateModel = date('j/m/Y', strtotime($date));
    $dateModelInterval1 = date('j/m/Y', strtotime($dateInterval1));
    $dateModelInterval2 = date('j/m/Y', strtotime($dateInterval2));

    $rdvBetween = intval(rdvBetween($dateModelInterval1, $dateModelInterval2)->total);
    $contratsBetween = intval(contratsBetween($dateModelInterval1, $dateModelInterval2)->total);
    $disposBetween = intval(disposBetween($dateModelInterval1, $dateModelInterval2)->total);
    $totalClients = intval(clientsAtDate($dateModel)->total);
    $totalSoldeComptesClients = intval(soldeTotalBanqueAtDate(date('j/m/Y'))->total);
    $totalContrats = intval(contratsAtDate($dateModel)->total);
    $totalComptes = intval(comptesAtDate($dateModel)->total);

    AfficherStatistiques($totalClients, $totalSoldeComptesClients, $totalContrats, $totalComptes, $date, $dateInterval1, $dateInterval2, $contratsBetween, $rdvBetween, $disposBetween);
}


function CtlAfficherModificationId($identifiants){
	if($identifiants!=null){
		AfficherModificationId($identifiants);
	}else{
		throw new Exception('Aucun identifiant pour les employés');
	}
}
	
function CtlModifierIdentifiants(){
	$identifiants=allIdentifiants();
	
	for($i=0;$i<count($identifiants);$i++){
		$categorie=$identifiants[$i]->CATEGORIE;
		$login=$_POST[$categorie.'login'];
		$mdp=$_POST[$categorie.'mdp'];
		if($categorie=='' || $login==''||$mdp==''){
			throw new Exception('Un des champs est vide');
		}else{
			modifierIdentifiants($categorie, $login, $mdp);
		}
	}
	
	AfficherAcceuil("Directeur","",true);
}

function CtlAfficherModificationListeContratCompte($comptes,$contrats){
	if($comptes!=null || $contrats!=null){
		AfficherModificationListeContratCompte($comptes,$contrats);
	}else{
		throw new Exception('Aucune liste de contrats ou de comptes');
	}
}

function CtlAjouterListeContratCompte($item,$libelle){
	if($libelle==null){
		throw new Exception('Le champ \" Nom du contrat ou du compte \" est vide');
	}
	if($item=="contrat"){
		ajouterContrat($libelle);
		ajouterMotif($libelle);
	}
	if($item=="compte"){
		ajouterCompte($libelle);
		ajouterMotif($libelle);
	}
	AfficherAcceuil("Directeur","",true);
}

function CtlModifierListeContrat(){
	$nbContrat=$_POST['nbContrat'];
	for($i=0;$i<$nbContrat;$i++){
		$ancienContrat=$_POST['ancienContrat'.$i];
		$contrat=$_POST['contrat'.$i];
		if($contrat==null){
			throw new Exception('Un des champs est vide');
		}
		modifierContrats($contrat,$ancienContrat);
		modifierMotif($contrat,$ancienContrat);
	}
	AfficherAcceuil("Directeur","",true);
}

function CtlSupprimerListeContrat($contrat){
	supprimerContrat($contrat);
	supprimerMotif($contrat);
	AfficherAcceuil("Directeur","",true);
}

function CtlModifierListeCompte(){
	$nbCompte=$_POST['nbCompte'];
	for($i=0;$i<$nbCompte;$i++){
		$ancienCompte=$_POST['ancienCompte'.$i];
		$compte=$_POST['compte'.$i];
		if($compte==null){
			throw new Exception('Un des champs est vide');
		}
		modifierComptes($compte,$ancienCompte);
		modifierMotif($compte,$ancienCompte);
	}
	AfficherAcceuil("Directeur","",true);
}

function CtlSupprimerListeCompte($compte){
	supprimerCompte($compte);
	supprimerMotif($compte);
	AfficherAcceuil("Directeur","",true);
}

function CtlAfficherModificationPiece($pieces){
	if($pieces!=null){
		AfficherModificationPiece($pieces);
	}else{
		throw new Exception('Aucune liste de pièces à fournir');
	}
}

function CtlAjouterPiece($piece,$motif){
	if($piece==''){
		throw new Exception('Le champ de la liste des pièces à fournir pour ce motif est vide');
	}
	ajouterPieceAFournir($piece,$motif);
	AfficherAcceuil("Directeur","",true);
}

function CtlSupprimerPiece($piece,$motif){
	if($piece==''){
		throw new Exception('La liste de pièces à fournir pour ce motif est déjà vide');
	}
	supprimerPieceAFournir($motif);
	AfficherAcceuil("Directeur","",true);
}

function CtlModifierPiece($piece,$motif){
	if($piece==''){
		throw new Exception('Supprimer la liste de pièces à fournir pour ce motif');
	}
	modifierPieceAFournir($piece,$motif);
	AfficherAcceuil("Directeur","",true);
}

/**
 * Fonction pour enregistrer un client champ par champ
 * @param $idEmploye
 *      Correspond au conseiller du client
 * @param $nom
 *      Correspond au nom du client
 * @param $prenom
 *      Correspond au prénom du client
 * @param $dateNaissance
 *      Correspond à la date de naissance du client
 * @param $adresse
 *      Correspond à l'adresse postale du client
 * @param $email
 *      Correspond à l'adresse eMail du client
 * @param $numTel
 *      Correspond au numéro de téléphone du client
 * @param $situationFamiliale
 *      Correspond à la situation familiale du client
 * @param $profession
 *      Correspond à la profession du client
 */
function CtlenregistrerClient($idEmploye, $nom, $prenom, $dateNaissance, $adresse, $email, $numTel, $situationFamiliale, $profession){
    //todo : verifier si le client n'existe pas déjà
    $numClient = enregistrerClient($idEmploye, $nom, $prenom, $dateNaissance, $adresse, $email, $numTel, $situationFamiliale, $profession);
    
    CtlAfficherOuvrirCompte($numClient);
}

function CtlInscriptionClient(){

    $conseillers = allConseillers();

    AfficherInscription($conseillers);
}

function CtlAfficherResilier($numClient){
    $comptes = getComptesClient($numClient);
    $contrats = getContratsClient($numClient);

    AfficherResilier($comptes, $contrats, $numClient);
}

function CtlResilier($typeResiliation, $numClient){
    $allComptes = allTypeCompte();
    $allContrats = allContrats();

    foreach($allComptes as $key => $value){
        if($value->NOMCOMPTE == $typeResiliation){
            CtlResilierCompte($numClient, $value->NOMCOMPTE);
        }
    }

    foreach($allContrats as $key => $value){
        if($value->LIBELLE == $typeResiliation){
            CtlResilierContrat($numClient, $value->IDCONTRAT);
        }
    }
}

/***
 * Fonction qui controle l'affichage de la synthese du client par son numClient
 * @param $numclient parametre déjà controllé via "rechercher un client" ou par saisie interactive
 */
	function CtlSyntheseClient($numClient1, $categorie){

        $numClient = intval($numClient1);
        $client = checkClient($numClient);
        $contrats = getContratsClient($numClient);
        $comptes = getComptesClient($numClient);
        $synthese = getSyntheseClient($numClient);
        
        if($categorie == 'Agent'){
            AfficherSyntheseClient($client,$comptes,$contrats,getEmploye($client[0]->IDEMPLOYE)->NOMEMPLOYE, 'Agent');
        }elseif($categorie == 'Conseiller'){
            AfficherSyntheseClient($client,$comptes,$contrats,getEmploye($client[0]->IDEMPLOYE)->NOMEMPLOYE, 'Conseiller');
        }
    }

/***
 * Fonction de controle des modifications des données d'un client via son numClient
 * @param $numclient parametre déjà controllé via "rechercher un client" ou par saisie interactive
 *
 *
 */
function CtlAfficherModificationInfo($numClient){

    $client=checkClient($numClient);

    $categorie = $_POST['categorie'];

    AfficherModificationInfo($client[0],$categorie);

}

function CtlValiderModificationInfo($numClient,$adresse, $email, $numTel, $situationFamiliale, $profession){
    $match = preg_match('/^([0-9][0-9]){5}$/', $numTel);
    $match2 = preg_match('/^[A-Za-zÀ-ÖØ-öø-ÿ]*$/i', $situationFamiliale);
    $match3 = preg_match('/^[A-Za-zÀ-ÖØ-öø-ÿ]*$/i', $profession);

    if($match == 1 && $match2 == 1 && $match3 == 1){
        modifierInfosClient($numClient,$adresse, $email, $numTel, $situationFamiliale, $profession);
    }else{
        throw new Exception("Vous n'avez pas remplis tous les champs correctement");
    }

}

/***
 * Fonction qui controle les operations sur le compte d'un client, la restriction de choix de compte se fait par Affichage au préalable des comptes du client
 * @param $compte le compte d'un client sous forme d'objet
 */
function CtlAfficherOperationCompte($numClient,$categorie){
    $comptes = getComptesClient($numClient);
    AfficherOperationCompte($comptes,$numClient,$categorie);
}


function CtlPlanning($int,$categorie,$numClient, $idEmploye){
    if($numClient != ""){
        $client = checkClient($numClient);
        $rdvEmploye = array_merge(getRDV($client[0]->IDEMPLOYE), getDispos($client[0]->IDEMPLOYE));
        $motifs = allMotif();
        AfficherPlanning($rdvEmploye,$int, $categorie,$client[0],$motifs, '');
    }else{
        $rdvEmploye = array_merge(getRDV($idEmploye), getDispos($idEmploye));
        $motifs = allMotif();
        AfficherPlanning($rdvEmploye,$int, $categorie,'',$motifs, $idEmploye);
    }
}

function CtlAfficherPlanning(){
    AfficherChoixPlanning(allConseillers());
}


function CtlPlanningConseiller($idConseiller){
    $rdvEmploye = array_merge(getRDV($idConseiller), getDispos($idConseiller));
    $motifs = allMotif();
    AfficherPlanning($rdvEmploye, 0, 'Conseiller', '', $motifs, $idConseiller);
}

function CtlDispoConseiller($dispos, $idEmploye){

    for($i = 0; $i < count($dispos); $i++){
        ajouterRDV($idEmploye, 3, "NULL", $dispos[$i]);
    }

    CtlPlanningConseiller($idEmploye);
}

/**
 * Fonction pour enregistrer un RDV champ par champ
 *
 * @param $IDEMPLOYE
 * @param $IDMOTIF
 * @param $NUMCLIENT
 * @param $DATEHEURERDV
 *
 */
function CtlValiderRDV($semaineSelection, $idMotif, $numClient, $DATEHEURERDV, $categorie){
    //todo : envoyer date avec slash
    $client = checkClient($numClient);

    if(!($client)) {
        throw new Exception("Numéro du client inexistant !");
    }
    if($idMotif != -1){
        ajouterRDV($client[0]->IDEMPLOYE, $idMotif, $numClient, $DATEHEURERDV);
    }else{
        $idMotif = ajouterMotif('Autre');
        ajouterRDV($client[0]->IDEMPLOYE, $idMotif, $numClient, $DATEHEURERDV);
    } 
    $motifs = allMotif();
    $rdvEmploye = array_merge(getRDV($client[0]->IDEMPLOYE), getDispos($client[0]->IDEMPLOYE));
    AfficherPlanning($rdvEmploye,$semaineSelection, $categorie,$client[0],$motifs, '');
}

/** // à  supprimer
 * Fonction pour controller la prise d'un rendez-vous
 * @param $numclient  parametre déjà controllé via "rechercher un client" ou par saisie interactive
 * @return array : rdv
 *      correspond à la demande d'un rdv
 * @throws Exception
 *      correspond à une exception liée au fait que le numClient  n'existe pas dans la dataBase
 */
function CtlAfficherRDVClient($numClient){

    CtlnumClientExiste($numClient);

    $client=checkClient($numClient);
   //AfficherPriseRdv($client);
    return getRDV($client[0]->IDEMPLOYE);
}



/**
 * Fonction pour effectuer le debit d'un compte avec controle
 * @param $valeur montant à débiter sur le compte spécifié
 * @param $numClient numéro du client auquel appartient le compte mentionné ci-dessous
 * @param $nomCompte type de compte
 */
function CtlDebiterCompte($valeur, $numClient, $nomCompte){

    $compte=getCompte($numClient,$nomCompte);

    $soldeFinal=$compte->SOLDE+$compte->MONTANTDECOUVERT;

    $match = preg_match('/^[0-9]*$/', $valeur);

    if($match == 1){
        if(($valeur>=0)&&($valeur<=$soldeFinal)){
            debiterCompte($valeur,$numClient,$nomCompte);
        }else{
            throw new Exception("Fond Insuffisant pour un débit de : ".$valeur."€ (Votre Solde :".$compte->SOLDE."€)");
        }
    }else{
        throw new Exception("La valeur saisie n'est pas correcte");
    }
}

/**
 * Fonction pour crediter un compte d'une certaine somme
 * @param $valeur montant à créditer sur le compte spécifié
 * @param $numClient numéro du client auquel appartient le compte mentionné ci-dessous
 * @param $nomCompte type de compte
 */
function CtlCrediterCompte($valeur, $numClient, $nomCompte){

    $match = preg_match('/^[0-9]*$/', $valeur);

    if($match == 1){
        crediterCompte($valeur,$numClient,$nomCompte);
    }else{
        throw new Exception("La valeur saisie n'est pas correcte");
    }

}


function CtlRechercherClientNum($numClient){
    if(CtlnumClientExiste()){
//todo : reflechir à quelle vue mettre
    }
}


/**
 * Fonction qui permet à un conseiller de proposer des contrats à un client qu'il ne possède pas déjà
 * @param $numClient
 *      correspond au numèro permettant d'accéder à un unique Client
 */
function CtlContratDisponible(){
    AfficherRechercherClient();
}

/**
 * Fonction pour la gestion de la vente d'un contrat à un client
 *
 * @param $numClient
 *      correspond au numèro permettant d'accéder à un unique Client
 * @param $DATEOUVERTURECONTRAT //todo ; remplacer par un getDate dans la fonction
 * @param $TARIFMENSUEL
 *      montant débité chaque mois
 * @param $LIBELLE
 *      correspond au nom du contrat
 */
function CtlAfficherVendreContrat($numClient){
    $contrats = getContratsPotentielsClient($numClient);
    AfficherVendreContrat($contrats, $numClient);
}

function CtlNouveauContratClient($numClient,$tarifMensuel, $libelle){
    $idContrat = intval($libelle);
    $dateOuvertureContrat = date('Y-m-d');
    enregistrerContrat($numClient, $dateOuvertureContrat, $tarifMensuel, $idContrat);
    CtlRetourAcceuil('Conseiller', '');
}

function CtlResilierContrat($numClient,$idContrat){
    //todo : vérifier quelles précautions sont à prendre
    resilierContrat($numClient, $idContrat);

    CtlRetourAcceuil('Conseiller', $numClient);
}

function CtlResilierCompte($numClient,$nomCompte){
    //todo : vérifier quelles précautions sont à prendre
    resilierCompte($numClient, $nomCompte);
    
    CtlRetourAcceuil('Conseiller', $numClient);
}
/**Fonction qui permet de proposer à un client d'ouvrir un compte qu'il ne possède pas déjà
 * @param $numClient
 *      correspond au numèro permettant d'accéder à un unique Client
 */
function CtlCompteDisponible($numClient){

    $comptes = getComptesPotentielsClient($numClient);

    //AfficherComptesDisponibles($comptes,$categorie);
}

/**
 * Fonction pour ouvrir un compte champ par champ
 * @param $NUMCLIENT
 *      correspond au numèro permettant d'accéder à un unique Client
 * @param $NOMCOMPTE
 *      correspond au type de compte
 * @param $DATEOUVERTURE //todo : remplacer par un getDate dans la fonction
 * @param $MONTANTDECOUVERT
 *      à 0 si non autorisé, il peut être modifier par le conseiller
 */
function CtlOuvrirCompte($numClient, $nomsComptes, $montantDecouvert){
    //todo : $DATEOUVERTURE= fonction pour getDateNOW();
    $dateOuverture = date('Y/m/j');

    for($i = 0; $i < count($nomsComptes); $i++){
        ouvertureCompte($numClient,$nomsComptes[$i],$dateOuverture,$montantDecouvert);
    }

    CtlRetourAcceuil('Conseiller', '');
}

/**
 * Fonction qui modifie le Montant du découvert d'un compte appartenant à un client
 * @param $montant
 *      correspond au nouveau montant du montant
 * @param $numClient
 *      correspond au numèro permettant d'accéder à un unique Client
 * @param $nomCompte
 *      correspond au type de compte
 */
function CtlModifierMontantDecouvert($comptesConcernes,$montantsDecouverts,$numClient){
    for($i = 0; $i < count($comptesConcernes); $i++){
        setMontantDecouvertAutorise($numClient, $comptesConcernes[$i], $montantsDecouverts[$i]);
    }

    CtlRetourAcceuil('Conseiller', '');
}

function CtlAfficherModificationDecouvert($numClient){
    $comptes = getComptesClient($numClient);
    AfficherModifDecouvert($comptes, $numClient);
}


/**
 * Fonction affichant un message d'erreur permettant de revenir sur la page login
 * @param $msg
 */
function CtlErreur($categorie,$msg){

    AfficherErreur($categorie,$msg);

}

function CtlRetrouverClient($nomClient, $birthday, $action){
    $match = preg_match('/(^[a-z]*$)/i', $nomClient);

    if($match == 1){
        $clientsCorrespondants = rechercherClient($nomClient, $birthday);
        if(count($clientsCorrespondants) == 1){
            CtlAfficherAction($action, $clientsCorrespondants[0]->NUMCLIENT);
        }else{
            AfficherChoisirClient($clientsCorrespondants, $action, 'Agent');
        }
    }else{
        throw new Exception("Le nom du client est incorrect");
    }
}

function CtlAfficherOuvrirCompte($numClient){

    $comptes = getComptesPotentielsClient($numClient);

    AfficherOuvrirCompte($comptes, $numClient);
}

