<?php
function AfficherInterfaceLogin(){
	$contenu = '';

	require_once('gabaritLogin.php');
}

function AfficherAcceuil($categorie, $numClient = "",$retourAcceuil){
	if($retourAcceuil){
		$contenuInterface='<form method="post" action="banque.php"><fieldset><legend>Notifications</legend><p>Action accomplie avec succès</p></fieldset></form>';
	}else{
    $contenuInterface='<form method="post" action="banque.php"><fieldset><legend>Notifications</legend><p> Connexion réussie <br/> Bienvenue </p></fieldset></form>';
    }
	$contenuBis = '';

    switch($categorie) {
		case 'Agent':
		
            $contenuHeader = '<strong>AGENT</strong>';
            require_once ('gabaritAgent.php');
            break;

        case 'Conseiller':

			$contenuHeader = '<strong>CONSEILLER</strong>';
			
			require_once('gabaritConseiller.php');
            break;

		case 'Directeur' :
		
            $contenuHeader = '<strong>DIRECTEUR</strong>';
			
			require_once('gabaritDirecteur.php');
            break;
    }
}

function AfficherSyntheseClient($client, $compte = '', $contrat = '', $conseiller = ''){
	$contenuHeader = '<strong>AGENT</strong>';
	$contenuBis = '';

	if(count($client) == 1){
	    $numClient = $client[0]->NUMCLIENT;
		$contenuInterface = '<form method="post" action="banque.php"><fieldset><legend>Synthèse du client</legend><p>Client n°:'.$numClient.'</p>
							<p><label>Nom :</label><input type="text" name="nom1" value="'.$client[0]->NOM.'" readonly/></p>
							<p><label>Prénom :</label><input type="text" name="prenom1" value="'.$client[0]->PRENOM.'" readonly/></p>
							<p><label>Date de naissance :</label><input type="text" name="birth" value="'.$client[0]->DATEDENAISSANCE.'" readonly/></p>
							<p><label>Email :</label><input type="text" name="mail" value="'.$client[0]->EMAIL.'" readonly/></p>
							<p><label>N° téléphone :</label><input type="text" name="tel" value="'.$client[0]->NUMEROTELEPHONE.'" readonly/></p>
							<p><label>Adresse :</label><input type="text" name="adresse" value="'.$client[0]->ADRESSE.'" readonly/></p>
							<p><label>Situation familiale :</label><input type="text" name="situation" value="'.$client[0]->SITUATIONFAMILIALE.'" readonly/></p>
							<p><label>Profession :</label><input type="text" name="profession" value="'.$client[0]->PROFESSION.'" readonly/></p>
							<p><label>Nom du conseiller :</label><input type="text" name="nomconseiller" value="'.$conseiller.'" readonly/></p>';//nomconseiller

		if(count($compte) >= 1) {
			$contenuInterface .= '<table>
			<caption>Liste des comptes</caption>';

			for ($j = 0; $j < count($compte); $j++) {
				$contenuInterface .= '<tr><td>' . $compte[$j]->NOMCOMPTE . '</td><td>' . $compte[$j]->SOLDE . '</td></tr>';
			}
			$contenuInterface .= '</table>';
		}

		if(count($contrat) >= 1) {
			$contenuInterface .= '<table>
			<caption>Liste des contrats</caption>';
			for ($j = 0; $j < count($contrat); $j++) {
				$contenuInterface .= '<tr><td>' . $contrat[$j]->LIBELLE . '</td></tr>';
			}

			$contenuInterface .= '</table></fieldset></form>';
		}

	}else{
		if(count($client) > 1){
			$numClient = '';
			$contenuInterface = '<form method="post" action="banque.php"><fieldset><legend>Rechercher client</legend><table><tr><td></td><td>Nom</td><td>Prénom</td><td>Tel</td><td>Date de naissance</td></tr>';
			for($i = 0; $i < count($client) ; $i++){
				$contenuInterface.='<tr><td><input type="radio" name="leclient" value="'.$client[$i]->NUMCLIENT.'"/></td><td>'.$client[$i]->NOM.'</td><td>'.$client[$i]->PRENOM.'</td><td>'.$client[$i]->NUMEROTELEPHONE.'</td><td>'.$client[$i]->DATEDENAISSANCE.'</td></tr>';
			}

			$contenuInterface.='</table><p><input type="submit" name="synthese" value="Synthèse client"/></p></fieldset></form>';
		}else{
			$contenuInterface='<form method="post" action="banque.php"><fieldset><p>Aucun client de ce nom </p></fieldset></form>';
		}
	}
	require_once('gabaritAgent.php');
}

function AfficherChoisirClient($client, $action){
	$numClient = '';
	$contenuBis = '';
	$contenuHeader = '';
	$contenuInterface = '<form method="post" action="banque.php"><fieldset><legend>Rechercher client</legend><table><tr><td></td><td>Nom</td><td>Prénom</td><td>Tel</td><td>Date de naissance</td></tr>';
	for($i = 0; $i < count($client) ; $i++){
		$contenuInterface.='<tr><td><input type="radio" name="leclient" value="'.$client[$i]->NUMCLIENT.'"/></td><td>'.$client[$i]->NOM.'</td><td>'.$client[$i]->PRENOM.'</td><td>'.$client[$i]->NUMEROTELEPHONE.'</td><td>'.$client[$i]->DATEDENAISSANCE.'</td></tr>';
	}

	$contenuInterface.='<input type="hidden" name="action" value="'.$action.'"/>
						</table><p><input type="submit" name="validerChoixClient" value="Choisir le client"/></p></fieldset></form>';
	require_once('gabaritConseiller.php');
}

function AfficherModificationInfo($client, $categorie){
	$contenuHeader = '<strong>AGENT</strong>';
	$contenuBis = '';
    $numClient = $client->NUMCLIENT;
	$contenuInterface = '<form method="post" action="banque.php"><fieldset><legend>Modification des informations du client</legend><p>Client n°:'.$numClient.'</p>
                        <p><input type="hidden" name="numClient" value="'.$numClient.'"/></p>
                        <p><input type="hidden" name="categorie" value="'.$categorie.'"/></p>
						<p><label>Nom :</label><input type="text" name="nom1" value="'.$client->NOM.'" disabled/></p>
						<p><label>Prénom :</label><input type="text" name="prenom1" value="'.$client->PRENOM.'" disabled/></p>
						<p><label>Date de naissance :</label><input type="text" name="birth" value="'.$client->DATEDENAISSANCE.'" disabled/></p>
						<p><label for="email">Email :</label><input type="text" name="mail" id="email" value="'.$client->EMAIL.'" /></p>
						<p><label for="numTel">N° téléphone :</label><input type="text" name="tel" id="numTel" value="'.$client->NUMEROTELEPHONE.'" /></p>
						<p><label for="adresse">Adresse :</label><input type="text" name="adresse" id="adresse" value="'.$client->ADRESSE.'" /></p>
						<p><label for="situFam">Situation familiale :</label><input type="text" name="situation" id="situFam" value="'.$client->SITUATIONFAMILIALE.'" /></p>
						<p><label for="profession">Profession :</label><input type="text" name="profession" id="profession" value="'.$client->PROFESSION.'" /></p>
						<p><input type="submit" name="modifier" value="Modifier"/></p></fieldset></form>';

	require_once('gabaritAgent.php');
}


function AfficherPriseRdv($client){
    $numClient = $client[0]->NUMCLIENT;
	$contenuHeader = '<strong>AGENT</strong>';
	$contenuInterface = '<form method="post" action="banque.php"><fieldset><p>Conseiller n°:'.$client[0]->IDEMPLOYE.'</p>';
	//plage de rdv
	$contenuBis = '';

	require_once('gabaritAgent.php');
}

function AfficherOperationCompte($compte, $numClient){
	$contenuHeader = '<strong>AGENT</strong>';
	$contenuInterface = '<form method="post" action="banque.php"><fieldset><legend>Opération sur le compte</legend>
                        <input type="hidden" name="numClient" value="'.$numClient.'" />
	                    <input type="hidden" name="categorie" value="Agent" />';
	
	if(count($compte) == 0){
		$contenuInterface .= 'Aucun compte associé au client';
	}else{
		$contenuInterface .= '<p><label>Sélectionner le compte :<label></p>
							<p>
							<select name="actionCompte">';

		for($k = 0; $k < count($compte); $k++){
			$contenuInterface.='<option value="'.$compte[$k]->NOMCOMPTE.'">'.$compte[$k]->NOMCOMPTE.'</option>';
		}

		$contenuInterface .= '</select></p>
							<p><input type="radio" name="operationcompte" id="debit" value="debit"/><label for="debit">Débiter</label></p>
							<p><input type="radio" name="operationcompte" id="credit" value="credit"/><label for="credit">Créditer</label></p>
							<p><label for="somme"> Somme : </label><input type="text" id ="somme" name="somme" /></p>
							<p><input type="submit" name="validerOp" value="Valider opération"/></p>';
	}						
	
	$contenuInterface .= '</fieldset></form>';
	$contenuBis = '';
	
	require_once('gabaritAgent.php');
}

function AfficherInscription($conseillers){
	$contenuBis = '';
	$contenuHeader = '<strong>CONSEILLER</strong>';
	$contenuInterface = '<form method="post" action="banque.php"><fieldset><legend>Nouveau client </legend>
						<p><label>Nom:</label><input type="text" name="lastName" required /></p>
						<p><label>Prénom :</label><input type="text" name="firstName" required /></p>
						<p><label>Date de naissance:</label><input type="date" name="bday" required /></p>
						<p><label>Adresse:</label><input type="text" name="adresse" required /></p>
						<p><label>Email:</label><input type="text" name="mail" required /></p>
						<p><label>Numéro de téléphone :</label><input type="text" name="tel" required /></p>
						<p><label>Situation familiale:</label><input type="text" name="situation" required /></p>
						<p><label>Profession:</label><input type="text" name="profession" required /></p>
						<p><label>Nom du conseiller:</label><select name="conseiller">';
						
						for($i = 0; $i < count($conseillers); $i++){
							$contenuInterface.='<option value="'.$conseillers[$i]->IDEMPLOYE.'">'.$conseillers[$i]->NOMEMPLOYE.'</option>';
						}
						$contenuInterface.='</select></p>
						<p><input type="submit" name="ajouter" value="Ajouter"/></p></fieldset></form>';
	require_once('gabaritConseiller.php');
}

function AfficherVendreContrat($contrat, $numClient){
	$contenuBis = '';
	$contenuHeader = '<strong>CONSEILLER</strong>';
	$contenuInterface = '<form method="post" action="banque.php"><fieldset><legend>Vendre un contrat </legend>
						<p><label>Sélectionner le contrat à vendre :</label></p>
						<p>
							<select name="actionContrat">';

	for($i = 0; $i < count($contrat); $i++){
		$contenuInterface .= '<option value="'.$contrat[$i]->IDCONTRAT.'">'.$contrat[$i]->LIBELLE.'</option>';
	}

	$contenuInterface .= '</select>
						</p>
						<p><label>Tarif mensuel:</label><input type="text" name="tarifMensuel" required /></p>
						<input type="hidden" value="'.$numClient.'" name="numClient"/>
						<p><input type="submit" name="vendre" value="Vendre le contrat"/></p>
						</fieldset></form>';
	require_once('gabaritConseiller.php');
}

function AfficherOuvrirCompte($compte, $numClient){
	$contenuHeader='<strong>CONSEILLER</strong>';
	$contenuBis = '';
	$contenuInterface = '<form method="post" action="banque.php"><fieldset><legend>Ouvrir un ou plusieurs comptes</legend>
						<p><label>Sélectionner le ou les comptes à ouvrir :<label></p>
						<p>
							<select name="actionOpenCompte" multiple>';
							
	for($k = 0; $k < count($compte); $k++){
		$contenuInterface .= '<option value="'.$compte[$k]->nomCompte.'">'.$compte[$k]->nomCompte.'</option>';
	}
						
	$contenuInterface .= '</select></p>
						<input type="hidden" name="numClient" value="'.$numClient.'"/>
						<p><input type="submit" name="ouvrir" value="Ouvrir Compte"/></p></fieldset></form>';	
	require_once('gabaritConseiller.php');
}

function AfficherResilier($compte,$contrat, $numClient){
	$contenuHeader = '<strong>CONSEILLER</strong>';
	$contenuBis = '';
	$contenuInterface = '<form method="post" action="banque.php"><fieldset><legend>Résilier compte ou contrat</legend>						<p><label>Sélectionner le compte ou le contrat à résilier :<label></p>
						<p>
							<select name="actionResilier"><optgroup label="Compte">';
							
	for($k = 0; $k < count($compte); $k++){
		$contenuInterface .= '<option value="'.$compte[$k]->NOMCOMPTE.'">'.$compte[$k]->NOMCOMPTE.'</option>';
	}
	$contenuInterface .= '</optgroup><optgroup label="Contrat">';
	
	for($i = 0; $i < count($contrat); $i++){
		$contenuInterface .= '<option value="'.$contrat[$i]->LIBELLE.'">'.$contrat[$i]->LIBELLE.'</option>';
	}
	
	$contenuInterface .= '</optgroup></select></p>
					<input type="hidden" name="numClient" value="'.$numClient.'"/>
					<p><input type="submit" name="resilier" value="Résilier le compte ou le contrat"/></p></fieldset></form>';	
	require_once('gabaritConseiller.php');
}

function AfficherModifDecouvert($comptes, $numClient){
	$contenuBis = '';
	$contenuHeader='<strong>CONSEILLER</strong>';
	$contenuInterface='<form method="post" action="banque.php"><fieldset><legend>Modifier la valeur du découvert</legend>';
						
	for($k=0;$k<count($comptes);$k++){
	$contenuInterface.='<p><label>Nom du compte :</label><input type="text"  name="compteConcerne[]" value="'.$comptes[$k]->NOMCOMPTE.'" readonly/></p>
						<p><label>Montant du découvert :</label><input type="text" name="setMontantDecouvert[]" value="'.$comptes[$k]->MONTANTDECOUVERT.'"/></p><br/>';
	}
						
	$contenuInterface.='<p><input type="submit" name="modifierDecouvert" value="Modifier la valeur du découvert"/></p>
						<input type="hidden" name="numClient" value="'.$numClient.'"/>';	
	require_once('gabaritConseiller.php');
	
}


function AfficherModificationId($identifiants){
	$contenuHeader='<strong>DIRECTEUR</strong>';
	$contenuBis='';
	$contenuInterface='<form method="post" action="banque.php"><fieldset>
						<legend>Identifiants des employés</legend>';
	for($l=0;$l<count($identifiants);$l++){
		$contenuInterface.='<p><label>Catégorie: </label><input type="text" name="'.$identifiants[$l]->CATEGORIE.'" value="'.$identifiants[$l]->CATEGORIE.'"disabled/></p>
							<p><label>Login: </label><input type="text" name="'.$identifiants[$l]->CATEGORIE.'login" value="'.$identifiants[$l]->LOGIN.'"/></p>
							<p><label>Mot de passe: </label><input type="text" name="'.$identifiants[$l]->CATEGORIE.'mdp" value="'.$identifiants[$l]->MDP.'"/></p><br/>';
							
	}
	$contenuInterface.='<p><input type="submit" name="modifierId" value="Modifier les identifiants"/></p></fieldset></form>';

	require_once('gabaritDirecteur.php');
}	



function AfficherModificationListeContratCompte($compte,$contrat){
	$contenuHeader='<strong>DIRECTEUR</strong>';
	$contenuBis='';
	$contenuInterface='<form name="modifMotif" method="post" action="banque.php"><fieldset id="liste">
						<legend>Liste des contrats et des comptes</legend>';
						for($i=0;$i<count($compte);$i++){
							$contenuInterface.='<p><input type="hidden" name="compte'.$i.'" value="'.$compte[$i]->NOMCOMPTE.'"/></p>';
						}
						
						for($i=0;$i<count($contrat);$i++){
							$contenuInterface.='<p><input type="hidden" name="contrat'.$i.'" value="'.$contrat[$i]->LIBELLE.'"/></p>';
						}
						
						$contenuInterface.='<p><input type="radio" name="choix" value="Ajouter" onClick="afficherAjout()" id="r1" /><label for="r1">Ajouter</label> 
						<input type="radio" name="choix"  value="modifierContrat" onClick="afficherModificationCon('.count($contrat).')" id="r2" /><label for="r2">Modifier la liste des contrats</label>
						<input type="radio" name="choix" value="supprimerContrat" onClick="afficherSuppressionCon('.count($contrat).')" id="r3" /><label for="r3">Supprimer la liste des contrats</label>
						<input type="radio" name="choix"  value="modifierCompte" onClick="afficherModificationCom('.count($compte).')" id="r4" /><label for="r4">Modifier la liste des comptes</label>
						<input type="radio" name="choix" value="supprimerCompte" onClick="afficherSuppressionCom('.count($compte).')" id="r5" /><label for="r5">Supprimer la liste des comptes</label>
						</p>
						</fieldset></form>';
require_once('gabaritDirecteur.php');
}

function AfficherModificationPiece($piece){
	$contenuHeader='<strong>DIRECTEUR</strong>';
	$contenuBis='';
	$contenuInterface='<form name="formuPiece" method="post" action="banque.php"><fieldset id="modifListePiece">
						<legend>Liste des pieces à fournir</legend>
						<p><select name="modifPiece" onchange="afficherSelectPiece()">';
						
						for($p=0;$p<count($piece);$p++){
							$contenuInterface.='<option value="'.$piece[$p]->LIBELLEMOTIF.'|'.$piece[$p]->PIECES_A_FOURNIR.'">'.$piece[$p]->LIBELLEMOTIF.'</option>';
						}
						$contenuInterface.='</select></p></fieldset></form>';
	require_once('gabaritDirecteur.php');
}

function AfficherStatistiques(){
	
}

function AfficherErreur($categorie,$erreur){
    $numClient = '';
    $contenuBis = '';
    $contenuHeader = '<strong>'.strtoupper($categorie).'</strong>';
    $contenuInterface = '<fieldset class="erreurs">
                            <legend>Erreurs détectées</legend>
                            <p>'.$erreur.'</p>
                         </fieldset>';

    $contenu = $contenuInterface;

    switch ($categorie){
        case 'Agent' :
            require_once('gabaritAgent.php');
            break;

        case 'Conseiller' :
            require_once('gabaritConseiller.php');
            break;

        case 'Directeur' :
            require_once ('gabaritDirecteur.php');
            break;

        default :
            require_once('gabaritLogin.php');
    }

}

function AfficherRechercherClient($action){
	$contenuHeader = '<strong>CONSEILLER</strong>';
	$contenuBis = '';
	$contenuInterface = '
    <form method="post" action="banque.php">
        <fieldset id="f1">
        <legend> Rechercher un client </legend>
        <p><label for="r1">Par le numéro : </label> </p>
        <p><input type="text" name="numClient" /></p>
        <p><input type="hidden" name="action" value="'.$action.'"></p><br>
		<p><label for="r2">Par le nom et la date de naissance : </label></p>
		<p><label>Nom : </label><input type="text" name="nomClient" /></p>
		<p><label>Date de naissance : </label><input type="date" name="birthday" /></p>
        <input type="submit" name="rechercheClientConseiller" value="Valider"
        </fieldset>
    </form>';
	require_once('gabaritConseiller.php');
}

function AfficherChoixPlanning($conseillers){
	$contenuHeader = '<strong>CONSEILLER</strong>';
	$contenuBis = '';
	$contenuInterface = '
    <form method="post" action="banque.php">
        <fieldset id="f3">
		<legend>Veuillez choisir un conseiller</legend>
		<select name="selectConseiller">';
	
	for($i = 0; $i < count($conseillers); $i++){
		$contenuInterface .= '<option value="'.$conseillers[$i]->IDEMPLOYE.'">'.$conseillers[$i]->IDEMPLOYE.' '.$conseillers[$i]->NOMEMPLOYE.'</option>';
	}
	$contenuInterface .= '</select><br><br>
		<input type="submit" name="choixConseiller" value="Valider"/>
        </fieldset>
    </form>';
	require_once('gabaritConseiller.php');
}

function AfficherPlanning($rdvEmploye, $semaineSelection, $categorie, $client,$motifs, $idEmploye){
    //todo : numClient peut être à remplacer par un $client pour pouvoir récuperer l'idEmploye même si le tableau de RDV est vide (@see : ligne 355)
    $nbRDV = count($rdvEmploye);
	$time = array();
	$idEmploye = $idEmploye != '' ? $idEmploye : $client->IDEMPLOYE;
	$numClient = $client == '' ? $client : $client->NUMCLIENT;


	foreach($rdvEmploye as $key => $value){
		if($value->IDMOTIF == 3){
			$rdvEmploye[$key]->NOM = "Aucun";
			$rdvEmploye[$key]->PRENOM = "";
			$rdvEmploye[$key]->LIBELLEMOTIF = "Disponibilité administrative";
			$rdvEmploye[$key]->PIECES_A_FOURNIR = "Aucune";
		}
	}

	for($i = 0; $i < $nbRDV; $i++){
		$time[$i] = strtotime($rdvEmploye[$i]->DATEHEURERDV);
	}

	$datesRDV = array();

	for($i = 0; $i < $nbRDV; $i++){
		$datesRDV[$i] = date("j/m/Y/G/i", $time[$i]);
	}

	$semaine = array();

	$jourActuel = intval(date('w'));
	for($i = 0; $i < 6; $i++){
		if($semaineSelection >= 0){
			$semaine[$i] = date('j/m/Y', strtotime('- '.($jourActuel).' days + '.($i + 2).' days + '.$semaineSelection.' week'));
		}else{
			$semaine[$i] = date('j/m/Y', strtotime('- '.($jourActuel).' days + '.($i + 2).' days - '.( -$semaineSelection).' week'));
		}
	}

	$planning = array();

	for($i = 0; $i < 11; $i++){
		for($j = 0; $j < 5; $j++){
			$planning[$i][$j][0] = "";
		}
	}

	for($i = 0; $i < $nbRDV; $i++){
		$rdv = explode('/', $datesRDV[$i]);
		$jourMoisRDV =  $rdv[0].'/'.$rdv[1].'/'.$rdv[2];
		$heureRDV = $rdv[3];
		for($j = 0; $j < count($semaine); $j++){
			if($semaine[$j] == $jourMoisRDV){
				if($rdvEmploye[$i]->IDMOTIF == 3){
					$planning[$heureRDV - 8][$j] = array(
						"DISPO ADMIN",
						$rdvEmploye[$i]->NOM,
						$rdvEmploye[$i]->PRENOM,
						$rdvEmploye[$i]->IDEMPLOYE,
						$rdvEmploye[$i]->LIBELLEMOTIF,
						$rdvEmploye[$i]->PIECES_A_FOURNIR,
						$rdvEmploye[$i]->DATEHEURERDV
					);
				}else{
					$planning[$heureRDV - 8][$j] = array(
						"RDV",
						$rdvEmploye[$i]->NOM,
						$rdvEmploye[$i]->PRENOM,
						$rdvEmploye[$i]->IDEMPLOYE,
						$rdvEmploye[$i]->LIBELLEMOTIF,
						$rdvEmploye[$i]->PIECES_A_FOURNIR,
						$rdvEmploye[$i]->DATEHEURERDV
					);
				}
			}
		}
	}

	$contenuInterface = '';
	$contenuBis = '
			<fieldset>
				<legend>Planning</legend>
					<div class="planning">
						<table>
							<tr>
								<form method="post" action="banque.php">
								    <input type="hidden" name="numClient" value="'.$numClient.'" /></p>
								    <input type="hidden" name="categorie" value="'.$categorie.'" /></p>
									<input type="hidden" class="invisible" name="idEmp" value="'.$idEmploye.'" />
									<input type="hidden" class="invisible" name="semCourante" value="'.$semaineSelection.'" />
									<td><input type="submit" name="prec" value="Semaine précédente" /></td>
									<th colspan="4" style="text-align: center;">Semaine du '.$semaine[0].'</th>
									<td><input type="submit" name="suiv" value="Semaine suivante" /></td>
							</tr>
							<tr>
								<td class="disabled"></td>';
	$contenuBis .='
								<th>Mardi '.$semaine[0].'</th>
								<th>Mercredi '.$semaine[1].'</th>
								<th>Jeudi '.$semaine[2].'</th>
								<th>Vendredi '.$semaine[3].'</th>
								<th>Samedi '.$semaine[4].'</th>
							</tr>';

	if($categorie == 'Conseiller'){
		$contenuHeader = '<strong>CONSEILLER</strong>';
		for($k = 0; $k < 11; $k++){
			$heure = 8 + $k;
			$contenuBis .= '<tr>
								<th>'.$heure.'H</th>';
			for($j = 0; $j < count($planning[0]); $j++){
				if($planning[$k][$j][0] != ""){
					$contenuBis .= '<td onClick="showRDV(\''.$planning[$k][$j][1].'\', \''.$planning[$k][$j][2].'\', \''.$planning[$k][$j][4].'\', \''.$planning[$k][$j][5].'\', \''.$planning[$k][$j][6].'\')">'.$planning[$k][$j][0].'</td>';
				}else{
					//$contenuBis .= '<td onClick="checkRDV(\''.($k).($j).'\')"><input type="checkbox" id="'.($k).($j).'" name="dispos[]" value="'.$semaine[$j].'/'.$heure.'"/></td>';
					
					$heureActuelle = date('H');
					$dateActuelle = date('j/m/Y');
					$semaineRaw = explode('/', $semaine[$j]);
					$semaineClean = $semaineRaw[1].'/'.$semaineRaw[0].'/'.$semaineRaw[2];

					if($dateActuelle == $semaine[$j]){
						if($heureActuelle >= $heure){
							$contenuBis .= '<td class="disabled"></td>';
						}else{
							$contenuBis .= '<td onClick="checkRDV(\''.($k).($j).'\')"><input type="checkbox" id="'.($k).($j).'" name="dispos[]" value="'.$semaine[$j].'/'.$heure.'"/></td>';
						}
					}elseif(strtotime('now') > strtotime($semaineClean)){
						$contenuBis .= '<td class="disabled"></td>';
					}else{
						$contenuBis .= '<td onClick="checkRDV(\''.($k).($j).'\')"><input type="checkbox" id="'.($k).($j).'" name="dispos[]" value="'.$semaine[$j].'/'.$heure.'"/></td>';
					}
				}
			}
		}
		$contenuBis .= '</table>
					</div>
					<input type="submit" value="Valider les disponiblités">
				</fieldset>';
		require_once('gabaritConseiller.php');
	}elseif($categorie == 'Agent'){
		$contenuHeader = '<strong>AGENT</strong>';
		for($k = 0; $k < 11; $k++){
			$heure = 8 + $k;
			$contenuBis .= '<tr>
								<th>'.$heure.'H</th>';
			for($j = 0; $j < count($planning[0]); $j++){
				if($planning[$k][$j][0] != ""){
					$contenuBis .= '<td onClick="showRDV(\''.$planning[$k][$j][1].'\', \''.$planning[$k][$j][2].'\', \''.$planning[$k][$j][4].'\', \''.$planning[$k][$j][5].'\', \''.$planning[$k][$j][6].'\')">'.$planning[$k][$j][0].'</td>';
				}else{
					$heureActuelle = date('H');
					$dateActuelle = date('j/m/Y');
					$semaineRaw = explode('/', $semaine[$j]);
					$semaineClean = $semaineRaw[1].'/'.$semaineRaw[0].'/'.$semaineRaw[2];

					if($dateActuelle == $semaine[$j]){
						if($heureActuelle >= $heure){
							$contenuBis .= '<td class="disabled"></td>';
						}else{
							$contenuBis .= '<td onClick="checkRDV(\''.($k).($j).'\')"><input type="radio" name="choixRDV" id="'.($k).($j).'" value="'.$semaine[$j].'/'.$heure.'"/></td>';
						}
					}elseif(strtotime('now') > strtotime($semaineClean)){
						$contenuBis .= '<td class="disabled"></td>';
					}else{
						$contenuBis .= '<td onClick="checkRDV(\''.($k).($j).'\')"><input type="radio" name="choixRDV" id="'.($k).($j).'" value="'.$semaine[$j].'/'.$heure.'"/></td>';
					}				
				}
			}
		}
		$contenuBis .= '</table>
					</div>
					
					<p><label>Motif du rendez-vous: </label><select name="idMotif">';
					for($p=0;$p<count($motifs);$p++){
						$contenuBis .= '<option value="'.$motifs[$p]->IDMOTIF.'">'.$motifs[$p]->LIBELLEMOTIF.'</option>';
					}
					$contenuBis .= '</select></p>
					<p><input class="bottom" href=#bottom type="submit" name="idRDVEmploye" value="Valider le RDV"/></p>
					</form>
				</fieldset>';
		require_once('gabaritAgent.php');
	}

}
