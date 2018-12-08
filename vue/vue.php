<?php
function AfficherInterfaceLogin(){
	$contenu='';
	require_once('gabaritLogin.php');
}

function AfficherAcceuil($categorie,$numClient){
    $contenuInterface='<form method="post" action="banque.php"><fieldset><p> Connexion réussie <br/> Bienvenue </p></fieldset></form>';
    $contenuBis='';


    switch ($categorie) {
        case 'Agent':

            $contenuHeader = '<strong>AGENT</strong>';

            require_once ('gabaritAgent.php');
            var_dump($numClient);

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

function AfficherSyntheseClient($client,$compte,$contrat,$conseiller){
	$contenuHeader='<strong>AGENT</strong>';
	$contenuBis='';
	if(count($client)==1){
	    $numClient = $client[0]->NUMCLIENT;
	$contenuInterface='<form method="post" action="banque.php"><fieldset><label>Synthèse du client</label><p>Client n°:'.$numClient.'</p>
						<p><label>Nom :</label><input type="text" name="nom1" value="'.$client[0]->NOM.'" readonly/></p>
						<p><label>Prénom :</label><input type="text" name="prenom1" value="'.$client[0]->PRENOM.'" readonly/></p>
						<p><label>Date de naissance :</label><input type="text" name="birth" value="'.$client[0]->DATEDENAISSANCE.'" readonly/></p>
						<p><label>Email :</label><input type="text" name="mail" value="'.$client[0]->EMAIL.'" readonly/></p>
						<p><label>N° téléphone :</label><input type="text" name="tel" value="'.$client[0]->NUMEROTELEPHONE.'" readonly/></p>
						<p><label>Adresse :</label><input type="text" name="adresse" value="'.$client[0]->ADRESSE.'" readonly/></p>
						<p><label>Situation familiale :</label><input type="text" name="situation" value="'.$client[0]->SITUATIONFAMILIALE.'" readonly/></p>
						<p><label>Profession :</label><input type="text" name="profession" value="'.$client[0]->PROFESSION.'" readonly/></p>
						<p><label>Nom du conseiller :</label><input type="text" name="nomconseiller" value="'.$conseiller.'" readonly/></p>';//nomconseiller

				if(count($compte)<=1) {
                    $contenuInterface .= '<table>
					<caption>Liste des comptes</caption>';
                    for ($j = 0; $j < count($compte); $j++) {
                        $contenuInterface .= '<tr><td>' . $compte[$j]->NOMCOMPTE . '</td><td>' . $compte[$j]->SOLDE . '</td></tr>';
                    }
                    $contenuInterface .= '</table>';
                }

				if(count($contrat)<=1) {
                    $contenuInterface .= '<table>
					<caption>Liste des contrats</caption>';
                    for ($j = 0; $j < count($contrat); $j++) {
                        $contenuInterface .= '<tr><td>' . $contrat[$j]->LIBELLE . '</td></tr>';
                    }

                    $contenuInterface .= '</table></fieldset></form>';
                }

	}else{
		if(count($client)<1){
			$contenuInterface='<form method="post" action="banque.php"><fieldset><table><tr><td></td><td>Nom</td><td>Prénom</td><td>Tel</td><td>Date de naissance</td></tr>';
			for($i=0;$i<count($client);$i++){
				$contenuInterface.='<tr><td><input type="radio" name="leclient" value="'.$client[$i]->NUMCLIENT.'"/></td><td>'.$client[$i]->NOM.'</td><td>'.$client[$i]->PRENOM.'</td><td>'.$client[$i]->NUMEROTELEPHONE.'</td><td>'.$client[$i]->DATEDENAISSANCE.'</td></tr>';
			}
			$contenuInterface.='</table><p><input type="submit" name="synthese" value="Synthèse client"/></p></fieldset></form>';
		}else{
			$contenuInterface='<form method="post" action="banque.php"><fieldset><p>Aucun client de ce nom </p></fieldset></form>';
		}
	}
	require_once('gabaritAgent.php');
}


function AfficherModificationInfo($client,$categorie){
	$contenuHeader='<strong>AGENT</strong>';
	$contenuBis='';

    $numClient = $client->NUMCLIENT;
    var_dump($numClient);
	$contenuInterface='<form method="post" action="banque.php"><fieldset><label>Modification des informations du client</label><p>Client n°:'.$numClient.'</p>
                        <p><input type="hidden" name="numClient" value="'.$numClient.'"</p>
                        <p><input type="hidden" name="categorie" value="'.$categorie.'"</p>
						<p><label>Nom :</label><input type="text" name="nom1" value="'.$client->NOM.'" readonly/></p>
						<p><label>Prénom :</label><input type="text" name="prenom1" value="'.$client->PRENOM.'" readonly/></p>
						<p><label>Date de naissance :</label><input type="text" name="birth" value="'.$client->DATEDENAISSANCE.'" readonly/></p>
						<p><label>Email :</label><input type="text" name="mail" value="'.$client->EMAIL.'" /></p>
						<p><label>N° téléphone :</label><input type="text" name="tel" value="'.$client->NUMEROTELEPHONE.'" /></p>
						<p><label>Adresse :</label><input type="text" name="adresse" value="'.$client->ADRESSE.'" /></p>
						<p><label>Situation familiale :</label><input type="text" name="situation" value="'.$client->SITUATIONFAMILIALE.'" /></p>
						<p><label>Profession :</label><input type="text" name="profession" value="'.$client->PROFESSION.'" /></p>
						<p><input type="submit" name="modifier" value="Modifier"/></p></fieldset></form>';

	require_once('gabaritAgent.php');
}


function AfficherPriseRdv($client){
    $numClient = $client[0]->NUMCLIENT;
	$contenuHeader='<strong>AGENT</strong>';
	$contenuInterface='<form method="post" action="banque.php"><fieldset><p>Conseiller n°:'.$client[0]->IDEMPLOYE.'</p>';
	//plage de rdv
	$contenuBis='';

	require_once('gabaritAgent.php');
}

function AfficherOperationCompte($compte,$numClient, $categorie){

	$contenuHeader='<strong>AGENT</strong>';
	$contenuInterface='<form method="post" action="banque.php"><fieldset><label>Opération sur le compte</label>
                        <input type="hidden" name="numClient" value="'.$numClient.'" />
	                    <input type="hidden" name="categorie" value="'.$categorie.'" />';
	
			if(count($compte)==0){
				$contenuInterface.='Aucun compte associé au client';
			}else{
				$contenuInterface.='<p><label>Sélectionner le compte :<label></p>
									<p>
									<select name="actionCompte">';

									for($k=0;$k<count($compte);$k++){
										$contenuInterface.='<option value="'.$compte[$k]->NOMCOMPTE.'">'.$compte[$k]->NOMCOMPTE.'</option>';
									}


				$contenuInterface.='</select></p>
									<p><input type="radio" name="operationcompte" id="debit" value="debit"/><label for="debit">Débiter</label></p>
									<p><input type="radio" name="operationcompte" id="credit" value="credit"/><label for="credit">Créditer</label></p>
									<p><label for="somme"> Somme : </label><input type="text" id ="somme" name="somme" /></p>
									<p><input type="submit" name="validerOp" value="Valider opération"/></p>';
			}						
			
			$contenuInterface.='</fieldset></form>';
	        $contenuBis='';
	
	require_once('gabaritAgent.php');
}

function AfficherInscription($idConseiller){
	$contenuHeader='<strong>CONSEILLER</strong>';
	$contenuInterface='<form method="post" action="banque.php"><fieldset><legend>Nouveau client </legend>
						<p><label>IdConseiller:</label><input type="text" name="idConseiller" value="'.$idConseiller.'" required /></p>
						<p><label>Nom:</label><input type="text" name="lastName" required /></p>
						<p><label>Prénom :</label><input type="text" name="firstName" required /></p>
						<p><label>Date de naissance:</label><input type="text" name="bday" required /></p>
						<p><label>Adresse:</label><input type="text" name="adresse" required /></p>
						<p><label>Email:</label><input type="text" name="mail" required /></p>
						<p><label>Numéro de téléphone :</label><input type="text" name="tel" required /></p>
						<p><label>Situation familiale:</label><input type="text" name="situation" required /></p>
						<p><label>Profession:</label><input type="text" name="profession" required /></p>
						//compte
						<p><input type="submit" name="ajouter" value="Ajouter"/></p></fieldset></form>';
		require_once('gabaritConseiller.php');
}

function AfficherVendreContrat($contrat){
	$contenuHeader='<strong>CONSEILLER</strong>';
	$contenuInterface='<form method="post" action="banque.php"><fieldset><legend>Vendre un contrat </legend>
						<p><label>Numéro du client:</label><input type="text" name="numClient" required /></p>
						<p><label>Sélectionner le contrat à vendre :</label></p>
						<p>
							<select name="actionContrat">';
							for($i=0;$i<count($contrat);$i++){
							$contenuInterface.='<option value="'.$contrat[$i]->LIBELLE.'">'.$contrat[$i]->LIBELLE.'</option>';
							}
							$contenuInterface.='</select>
						</p>
						<p><label>Date du contrat:</label><input type="date" name="dateContrat" required /></p>
						<p><label>Tarif mensuel:</label><input type="text" name="tarifMensuel" required /></p>
						<p><input type="submit" name="vendre" value="Vendre le contrat"/></p>
						</fieldset></form>';
						require_once('gabaritConseiller.php');
}

function AfficherOuvrirCompte($compte){
	$contenuHeader='<strong>CONSEILLER</strong>';
	$contenuInterface='<form method="post" action="banque.php"><fieldset><legend>Ouvrir un ou plusieurs comptes</legend>
						<p><label>Numéro du client:</label><input type="text" name="numClient" required /></p>
						<p><label>Sélectionner le ou les comptes à ouvrir :<label></p>
						<p>
							<select name="actionOpenCompte" mutliple>';
							
							for($k=0;$k<count($compte);$k++){
							$contenuInterface.='<option value="'.$compte[$k]->NOMCOMPTE.'">'.$compte[$k]->NOMCOMPTE.'</option>';
						}
						
						$contenuInterface.='</select></p>
											<p><input type="submit" name="ouvrir" value="Ouvrir Compte"/></p></fieldset></form>';	
											require_once('gabaritConseiller.php');
}

function AfficherResilier($compte,$contrat){
	$contenuHeader='<strong>CONSEILLER</strong>';
	$contenuInterface='<form method="post" action="banque.php"><fieldset><legend>Résilier compte ou contrat</legend>
						<p><label>Numéro du client:</label><input type="text" name="numClient" required /></p>
						<p><label>Sélectionner le compte ou le contrat à résilier :<label></p>
						<p>
							<select name="actionResilier"><optgroup label="Compte">';
							
							for($k=0;$k<count($compte);$k++){
								$contenuInterface.='<option value="'.$compte[$k]->NOMCOMPTE.'">'.$compte[$k]->NOMCOMPTE.'</option>';
							}
							$contenuInterface.='</optgroup><optgroup label="Contrat">';
							
							for($i=0;$i<count($contrat);$i++){
								$contenuInterface.='<option value="'.$contrat[$i]->LIBELLE.'">'.$contrat[$i]->LIBELLE.'</option>';
							}
							
						$contenuInterface.='</optgroup></select></p>
											<p><input type="submit" name="resilier" value="Résilier le compte ou le contrat"/></p></fieldset></form>';	
											require_once('gabaritConseiller.php');
}

	
function AfficherErreurLogin ($erreur){
	$contenu='<fieldset>
			   <legend> Erreurs détectées</legend>
			   <p>'.$erreur.'</p>
			  </fieldset>';
	require_once('gabaritLogin.php');		  
}

	
function AfficherErreurAgent ($erreur){
	$contenuHeader='<strong>AGENT</strong>';
	$contenuInterface='<fieldset>
			   <legend> Erreurs détectées</legend>
			   <p>'.$erreur.'</p>
			  </fieldset>';
	require_once('gabaritAgent.php');		  
}

	
function AfficherErreurConseiller ($erreur){
	$contenuHeader='<strong>CONSEILLER</strong>';
	$contenuInterface='<fieldset>
			   <legend> Erreurs détectées</legend>
			   <p>'.$erreur.'</p>
			  </fieldset>';
	require_once('gabaritConseiller.php');		  
}

	
function AfficherErreurDirecteur ($erreur){
	$contenuHeader='<strong>DIRECTEUR</strong>';
	$contenuInterface='<fieldset>
			   <legend> Erreurs détectées</legend>
			   <p>'.$erreur.'</p>
			  </fieldset>';
	require_once('gabaritDirecteur.php');		  
}



function AfficherErreur($categorie,$erreur){

    $contenuHeader = '<strong>'.strtoupper($categorie).'</strong>';
    $contenuInterface = '<fieldset>
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

function AfficherPlanning($rdvEmploye, $semaineSelection, $categorie, $numClient){
    $contenuHeader='';
	$nbRDV = count($rdvEmploye);
	$time = array();

	for($i = 0; $i < $nbRDV; $i++){
		$time[$i] = strtotime($rdvEmploye[$i]->DATEHEURERDV);
	}

	$datesRDV = array();

	for($i = 0; $i < $nbRDV; $i++){
		$datesRDV[$i] = date("j/m/Y/G/i", $time[$i]);
	}

	$semaine = array();

	for($i = 0; $i < 6; $i++){
		$semaine[$i] = date('j/m/Y', strtotime('+'.($i+5).' day +'.($semaineSelection - 1).' week'));
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
				$planning[$heureRDV - 8][$j] = array(
					"RDV",
					$rdvEmploye[$i]->NOM,
					$rdvEmploye[$i]->PRENOM,
					$rdvEmploye[$i]->IDEMPLOYE,
					$rdvEmploye[$i]->LIBELLEMOTIF,
					$rdvEmploye[$i]->LIBELLE_PIECES_A_FOURNIR,
					$rdvEmploye[$i]->DATEHEURERDV
				);
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
									<input type="hidden" class="invisible" name="idEmp" value="'.$rdvEmploye[0]->IDEMPLOYE.'" />
									<input type="hidden" class="invisible" name="semCourante" value="'.$semaineSelection.'" />
										<td><input type="submit" name="prec" value="Semaine précédente" /></td>
										<th colspan="4" style="text-align: center;">Semaine du '.$semaine[0].'</th>
										<td><input type="submit" name="suiv" value="Semaine suivante" /></td>
								</form>
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
		for($k = 0; $k < 11; $k++){
			$heure = 8 + $k;
			$contenuBis .= '<tr>
								<th>'.$heure.'H</th>';
			for($j = 0; $j < count($planning[0]); $j++){
				if($planning[$k][$j][0] != ""){
					$contenuBis .= '<td onClick="showRDV(\''.$planning[$k][$j][1].'\', \''.$planning[$k][$j][2].'\', \''.$planning[$k][$j][4].'\', \''.$planning[$k][$j][5].'\', \''.$planning[$k][$j][6].'\')">'.$planning[$k][$j][0].'</td>';
				}else{
					$contenuBis .= '<td onClick="checkRDV(\''.($k).($j).'\')"><input type="checkbox" id="'.($k).($j).'"/></td>';
				}
			}
		}
		$contenuBis .= '</table>
					</div>
					<input type="submit" value="Valider les disponiblités">
				</fieldset>';
	}elseif($categorie == 'Agent'){
		for($k = 0; $k < 11; $k++){
			$heure = 8 + $k;
			$contenuBis .= '<tr>
								<th>'.$heure.'H</th>';
			for($j = 0; $j < count($planning[0]); $j++){
				if($planning[$k][$j][0] != ""){
					$contenuBis .= '<td class="disabled">EN RDV</td>';
				}else{
					$contenuBis .= '<td onClick="checkRDV(\''.($k).($j).'\')"><input type="radio" name="choixRDV" id="'.($k).($j).'" value="'.$semaine[$j].'/'.$heure.'"/></td>';
				}
			}
		}
		$contenuBis .= '</table>
					</div>
					<input type="submit" name="idRDVEmploye" value="Valider le RDV">
				</fieldset>';
	}
	require_once('gabaritAgent.php');

}
/**
 * require_once('../modele/modele.php');
$rdv = getRDV(3);
AfficherPlanning($rdv, 0);
**/
