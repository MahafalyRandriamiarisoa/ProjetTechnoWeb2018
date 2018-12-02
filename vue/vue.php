<?php
function AfficherInterfaceLogin(){
	$contenu='';
	require_once('gabaritLogin.php');
}

function AfficherAcceuil($numClient,$categorie){
	if($categorie='Agent'){
		$contenuHeader='<strong>AGENT</strong>';
		$contenuInterface='<form method="post" action="banque.php"><fieldset><p> Connexion réussie <br/> Bienvenue </p></fieldset></form>';
		$contenuBis='';
		require_once('gabaritAgent.php');
	}
	if($categorie='Conseiller'){
		$contenuHeader='<strong>CONSEILLER</strong>';
		$contenuInterface='<form method="post" action="banque.php"><fieldset><p> Connexion réussie <br/> Bienvenue </p></fieldset></form>';
		require_once('gabaritConseiller.php');
	}
	if($categorie='Directeur'){
		$contenuHeader='<strong>DIRECTEUR</strong>';
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
				$contenuInterface.='<tr><td><input type="radio" name="leclient"/></td><td>'.$client[$i]->NOM.'</td><td>'.$client[$i]->PRENOM.'</td><td>'.$client[$i]->NUMEROTELEPHONE.'</td><td>'.$client[$i]->DATEDENAISSANCE.'</td></tr>';
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

function AfficherModification($info,$client){ //j'ai rajouté le parametre client
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

function AfficherPriseRdv($client){ ////j'ai rajouté le parametre client
	$contenuHeader='<strong>AGENT</strong>';
	$contenuInterface='<form method="post" action="banque.php"><fieldset><p>Conseiller n°:'.$client->IDEMPLOYE.'</p>';
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
