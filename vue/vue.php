<?php
function AfficherInterfaceLogin(){
	$contenu='';
	require_once('gabaritLogin.php');
}

function AfficherAcceuil($categorie){
	if($categorie=='Agent'){
		$contenuHeader='<strong>AGENT</strong>';
		$contenuInterface='<form method="post" action="banque.php"><fieldset><p> Connexion réussie <br/> Bienvenue </p></fieldset></form>';
		$contenuBis='';
		require_once('gabaritAgent.php');
	}
	if($categorie=='Conseiller'){
		$contenuHeader='<strong>CONSEILLER</strong>';
		$contenuInterface='<form method="post" action="banque.php"><fieldset><p> Connexion réussie <br/> Bienvenue </p></fieldset></form>';
		require_once('gabaritConseiller.php');
	}
	if($categorie=='Directeur'){
		$contenuHeader='<strong>DIRECTEUR</strong>';
		$contenuBis='';
		$contenuInterface='<form method="post" action="banque.php"><fieldset><p> Connexion réussie <br/> Bienvenue </p></fieldset></form>';
		require_once('gabaritDirecteur.php');
	}
	
}

function AfficherSyntheseClient($client,$compte,$contrat){
	$contenuHeader='<strong>AGENT</strong>';
	$contenuBis='';
	if(count($client)==1){
	$contenuInterface='<form method="post" action="banque.php"><fieldset><p>Client n°:'.$client[0]->NUMCLIENT.'</p>
						<p><label>Nom :</label><input type="text" name="nom1" value="'.$client[0]->NOM.'" readonly/></p>
						<p><label>Prénom :</label><input type="text" name="prenom1" value="'.$client[0]->PRENOM.'" readonly/></p>
						<p><label>Date de naissance :</label><input type="text" name="birth" value="'.$client[0]->DATEDENAISSANCE.'" readonly/></p>
						<p><label>Email :</label><input type="text" name="mail" value="'.$client[0]->EMAIL.'" readonly/></p>
						<p><label>N° téléphone :</label><input type="text" name="tel" value="'.$client[0]->NUMEROTELEPHONE.'" readonly/></p>
						<p><label>Adresse :</label><input type="text" name="adresse" value="'.$client[0]->ADRESSE.'" readonly/></p>
						<p><label>Situation familiale :</label><input type="text" name="situation" value="'.$client[0]->SITUATIONFAMILIALE.'" readonly/></p>
						<p><label>Profession :</label><input type="text" name="profession" value="'.$client[0]->PROFESSION.'" readonly/></p>
						<p><label>Nom du conseiller :</label><input type="text" name="nomconseiller" value="" readonly/></p>';//nomconseiller

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


function AfficherModificationInfo($client){
	$contenuHeader='<strong>AGENT</strong>';
	$contenuBis='';
	$contenuInterface='<form method="post" action="banque.php"><fieldset><p>Client n°:'.$client->NUMCLIENT.'</p>
						<p><label>Nom :</label><input type="text" name="nom1" value="'.$client->NOM.'" readonly/></p>
						<p><label>Prénom :</label><input type="text" name="prenom1" value="'.$client->PRENOM.'" readonly/></p>
						<p><label>Date de naissance :</label><input type="text" name="birth" value="'.$client->DATEDENAISSANCE.'" readonly/></p>
						<p><label><input type="checkbox" name="Email" value="'.$client->EMAIL.'" />Email :</label><input type="text" name="mail" value="'.$client->EMAIL.'" readonly/></p>
						<p><label><input type="checkbox" name="N° téléphone" value="'.$client->NUMEROTELEPHONE.'" />N° téléphone :</label><input type="text" name="tel" value="'.$client->NUMEROTELEPHONE.'" readonly/></p>
						<p><label><input type="checkbox" name="Adresse" value="'.$client->ADRESSE.'" />Adresse :</label><input type="text" name="adresse" value="'.$client->ADRESSE.'" readonly/></p>
						<p><label><input type="checkbox" name="Situation familiale" value="'.$client->SITUATIONFAMILIALE.'" />Situation familiale :</label><input type="text" name="situation" value="'.$client->SITUATIONFAMILIALE.'" readonly/></p>
						<p><label><input type="checkbox" name="Profession" value="'.$client->PROFESSION.'" />Profession :</label><input type="text" name="profession" value="'.$client->PROFESSION.'" readonly/></p>
						<p><input type="submit" name="modifier" value="Modifier"/></p></fieldset></form>';

	require_once('gabaritAgent.php');
}

function AfficherInfoAmodifier($client,$info){
	$contenuHeader='<strong>AGENT</strong>';
	$contenuInterface='<form method="post" action="banque.php"><fieldset><p>Client n°:'.$client->NUMCLIENT.'</p>
						<p><label>Nom :</label><input type="text" name="nom1" value="'.$client->NOM.'" readonly/></p>
						<p><label>Prénom :</label><input type="text" name="prenom1" value="'.$client->PRENOM.'" readonly/></p>
						<p><label>Date de naissance :</label><input type="text" name="birth" value="'.$client->DATEDENAISSANCE.'" readonly/></p>
						<p><label>Email :</label><input type="text" name="mail" value="'.$client->EMAIL.'" readonly/></p>
						<p><label>N° téléphone :</label><input type="text" name="tel" value="'.$client->NUMEROTELEPHONE.'" readonly/></p>
						<p><label>Adresse :</label><input type="text" name="adresse" value="'.$client->ADRESSE.'" readonly/></p>
						<p><label>Situation familiale :</label><input type="text" name="situation" value="'.$client->SITUATIONFAMILIALE.'" readonly/></p>
						<p><label>Profession :</label><input type="text" name="profession" value="'.$client->PROFESSION.'" readonly/></p>
						</fieldset>';

	$contenuBis='<fieldset>';
	for($i=0;$i<count($info);$i++){
		$contenuBis.='<p><label>'.$info->namecheckbox .' : </label><input type="text" name="'.$info->namecheckbox .'" placeholder="'.$info->ancienneval.'"/>';
	}
	$contenuBis.='<p><input type="submit" name="validerModif" value="Valider"/></p></fieldset></form>';

	require_once('gabaritAgent.php');
}

function AfficherPriseRdv($client){
	$contenuHeader='<strong>AGENT</strong>';
	$contenuInterface='<form method="post" action="banque.php"><fieldset><p>Conseiller n°:'.$client[0]->IDEMPLOYE.'</p>';
	//plage de rdv
	$contenuBis='';

	require_once('gabaritAgent.php');
}

function AfficherOperationCompte($compte){

	$contenuHeader='<strong>AGENT</strong>';
	$contenuInterface='<form method="post" action="banque.php"><fieldset>
						<p><label>Sélectionner le compte :<label></p>
						<p>
						<select name="actionCompte">';

						for($k=0;$k<count($compte);$k++){
							$contenuInterface.='<option value="'.$compte[$k]->NOMCOMPTE.'">'.$compte[$k]->NOMCOMPTE.'</option>';
						}


						$contenuInterface.='</select></p>
											<p><input type="radio" name="operationcompte" value="debit"/>Débiter</p>
											<p><input type="radio" name="operationcompte"  value="credit"/>Créditer</p>
											<p><label> Somme : </label><input type="text" name="somme" /></p>
											<p><input type="submit" name="validerop" value="Valider opération"/></p>
											</fieldset></form>';
	$contenuBis='';

	require_once('gabaritAgent.php');
}

function AfficherErreur ($erreur){
	$contenu='<fieldset>
			   <legend> Erreurs détectées</legend>
			   <p>'.$erreur.'</p>
			  </fieldset>';
	require_once('gabaritLogin.php');
}

function AfficherPlanning($rdvEmploye, $semaineSelection){
    $contenuHeader='';
	$nbRDV = count($rdvEmploye);
	$time = array();

	for($i = 0; $i < $nbRDV; $i++){
		$time[$i] = strtotime($rdvEmploye[$i]->DATEHEURERDV);
	}

	$datesRDV = array();

	for($i = 0; $i < $nbRDV; $i++){
		$datesRDV[$i] = date("j/m/G/i", $time[$i]);
	}

	$semaine = array();

	$semaineCourante = date('W')+$semaineSelection;

	if($semaineCourante > 52){

		$anneeCourante = date('Y') + 1;
		$semaineCouranteNext = date('W', date('Y',strtotime($anneeCourante)) + ($semaineCourante - 52));

		for($i = 0; $i < 6; $i++){
			$semaine[$i] = date('j/m', strtotime($anneeCourante."W".$semaineCouranteNext.($i+2)));
		}
	}else{
		$anneeCourante = date('Y');

		for($i = 0; $i < 6; $i++){
			$semaine[$i] = date('j/m', strtotime($anneeCourante."W".$semaineCourante.($i+2)));
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
		$jourMoisRDV =  $rdv[0].'/'.$rdv[1];
		$heureRDV = $rdv[2];
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
				<div class="planning">
					<table>
						<legend>Vos RDV</legend>
						<tr>
						    <form method="post" action="banque.php">
						    <input type="text" class="invisible" name="idEmp" value="'.$rdvEmploye[0]->IDEMPLOYE.'" style="display:none" />
						    <input type="text" class="invisible" name="semCourante" value="'.$semaineSelection.'" style="display:none" />
                                <td><input type="submit" name="prec" value="Semaine précédente" /></td>
                                <th colspan="4" style="text-align: center;">Semaine du '.$semaine[0].'/'. getDate()['year'].'</th>
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
						</tr>
						<tr>
							<th>8H</th>';
	for($j = 0; $j < count($planning[0]); $j++){
		if($planning[0][$j][0] != ""){
			$contenuBis .= '<td onClick="showRDV(\''.$planning[0][$j][1].'\', \''.$planning[0][$j][2].'\', \''.$planning[0][$j][4].'\', \''.$planning[0][$j][5].'\', \''.$planning[0][$j][6].'\')">'.$planning[0][$j][0].'</td>';
		}else{
			$contenuBis .= '<td class="disabled"></td>';
		}
	}
	$contenuBis .= '	</tr>
						<tr>
							<th>9H</th>';
	for($j = 0; $j < count($planning[0]); $j++){
		if($planning[1][$j][0] != null){
			$contenuBis .= '<td onClick="showRDV(\''.$planning[1][$j][1].'\', \''.$planning[1][$j][2].'\', \''.$planning[1][$j][4].'\', \''.$planning[1][$j][5].'\', \''.$planning[1][$j][6].'\')">'.$planning[1][$j][0].'</td>';
		}else{
			$contenuBis .= '<td class="disabled"></td>';
		}
	}
	$contenuBis .= '	</tr>
						<tr>
							<th>10H</th>';
	for($j = 0; $j < count($planning[0]); $j++){
		if($planning[2][$j][0] != null){
			$contenuBis .= '<td onClick="showRDV(\''.$planning[2][$j][1].'\', \''.$planning[2][$j][2].'\', \''.$planning[2][$j][4].'\', \''.$planning[2][$j][5].'\', \''.$planning[2][$j][6].'\')">'.$planning[2][$j][0].'</td>';
		}else{
			$contenuBis .= '<td class="disabled"></td>';
		}
	}
	$contenuBis .= '	</tr>
						<tr>
							<th>11H</th>';
	for($j = 0; $j < count($planning[0]); $j++){
		if($planning[3][$j][0] != null){
			$contenuBis .= '<td onClick="showRDV(\''.$planning[3][$j][1].'\', \''.$planning[3][$j][2].'\', \''.$planning[3][$j][4].'\', \''.$planning[3][$j][5].'\', \''.$planning[3][$j][6].'\')">'.$planning[3][$j][0].'</td>';
		}else{
			$contenuBis .= '<td class="disabled"></td>';
		}
	}
	$contenuBis .= '	</tr>
						<tr>
							<th>12H</th>';
	for($j = 0; $j < count($planning[0]); $j++){
		if($planning[4][$j][0] != null){
			$contenuBis .= '<td onClick="showRDV(\''.$planning[4][$j][1].'\', \''.$planning[4][$j][2].'\', \''.$planning[4][$j][4].'\', \''.$planning[4][$j][5].'\', \''.$planning[4][$j][6].'\')">'.$planning[4][$j][0].'</td>';
		}else{
			$contenuBis .= '<td class="disabled"></td>';
		}
	}
	$contenuBis .= '	</tr>
						<tr>
							<th>13H</th>';
	for($j = 0; $j < count($planning[0]); $j++){
		if($planning[5][$j][0] != null){
			$contenuBis .= '<td onClick="showRDV(\''.$planning[5][$j][1].'\', \''.$planning[5][$j][2].'\', \''.$planning[5][$j][4].'\', \''.$planning[5][$j][5].'\', \''.$planning[5][$j][6].'\')">'.$planning[5][$j][0].'</td>';
		}else{
			$contenuBis .= '<td class="disabled"></td>';
		}
	}
	$contenuBis .= '	
						</tr>
						<tr>
							<th>14H</th>';
	for($j = 0; $j < count($planning[0]); $j++){
		if($planning[6][$j][0] != null){
			$contenuBis .= '<td onClick="showRDV(\''.$planning[6][$j][1].'\', \''.$planning[6][$j][2].'\', \''.$planning[6][$j][4].'\', \''.$planning[6][$j][5].'\', \''.$planning[6][$j][6].'\')">'.$planning[6][$j][0].'</td>';
		}else{
			$contenuBis .= '<td class="disabled"></td>';
		}
	}
	$contenuBis .= '	</tr>
						<tr>
							<th>15H</th>';
	for($j = 0; $j < count($planning[0]); $j++){
		if($planning[7][$j][0] != null){
			$contenuBis .= '<td onClick="showRDV(\''.$planning[7][$j][1].'\', \''.$planning[7][$j][2].'\', \''.$planning[7][$j][4].'\', \''.$planning[7][$j][5].'\', \''.$planning[7][$j][6].'\')">'.$planning[7][$j][0].'</td>';
		}else{
			$contenuBis .= '<td class="disabled"></td>';
		}
	}
	$contenuBis .= '	</tr>
						<tr>
							<th>16H</th>';
	for($j = 0; $j < count($planning[0]); $j++){
		if($planning[8][$j][0] != null){
			$contenuBis .= '<td onClick="showRDV(\''.$planning[8][$j][1].'\', \''.$planning[8][$j][2].'\', \''.$planning[8][$j][4].'\', \''.$planning[8][$j][5].'\', \''.$planning[8][$j][6].'\')">'.$planning[8][$j][0].'</td>';
		}else{
			$contenuBis .= '<td class="disabled"></td>';
		}
	}
	$contenuBis .= '	</tr>
						<tr>
							<th>17H</th>';
	for($j = 0; $j < count($planning[0]); $j++){
		if($planning[9][$j][0] != null){
			$contenuBis .= '<td onClick="showRDV(\''.$planning[9][$j][1].'\', \''.$planning[9][$j][2].'\', \''.$planning[9][$j][4].'\', \''.$planning[9][$j][5].'\', \''.$planning[9][$j][6].'\')">'.$planning[9][$j][0].'</td>';
		}else{
			$contenuBis .= '<td class="disabled"></td>';
		}
	}
	$contenuBis .= '	</tr>
						<tr>
							<th>18H</th>';
	for($j = 0; $j < count($planning[0]); $j++){
		if($planning[10][$j][0] != ""){
			$contenuBis .= '<td onClick="showRDV(\''.$planning[10][$j][1].'\', \''.$planning[10][$j][2].'\', \''.$planning[10][$j][4].'\', \''.$planning[10][$j][5].'\', \''.$planning[10][$j][6].'\')">'.$planning[10][$j][0].'</td>';
		}else{
			$contenuBis .= '<td class="disabled"></td>';
		}
	}
	$contenuBis .= '	</tr>
					</table>
				</div>';
	require_once('gabaritAgent.php');

}
/**
 * require_once('../modele/modele.php');
$rdv = getRDV(3);
AfficherPlanning($rdv, 0);
**/
