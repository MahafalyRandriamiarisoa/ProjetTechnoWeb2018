<!DOCTYPE html>
<html lang="fr">
    <head>
      <title>Ma page</title>
      <meta charset="utf-8">
	  <link rel="stylesheet"  href="style/style.css" />
	  <script type="text/javascript" src="vue/fonction.js"></script>
    </head>
    
	<body>	
		<header>
			<p>Connexion en tant que :<?php echo $contenuHeader;?></p>
		</header>
		<aside>
			<form id="numCli" method="post" action="banque.php">
				
			
				<fieldset id="f1">
					<legend> Rechercher un client </legend>
					<p><input type="radio" name="choix" onClick="afficherNumCli()"/>Par le numéro </p>
					<p><input type="radio" name="choix"  onClick="afficherNomDate()"/>Par le nom et la date de naissance</p>
				</fieldset>
			
				<fieldset>
					<legend> Actions </legend>
					<p><label>Sélectionner une action à réaliser :<label></p>
					<p>
						<select name="action">
							<option value="syntese">Synthèse du client</option>
							<option value="modif">Modification des informations du client</option>
							<option value="opCompte">Opération sur le compte</option>
							<option value="rdv">Prise de RDV</option>
						</select>
					</p>
				</fieldset>
				<p><input type="reset"  value="Effacer"/><input type="submit" name="valider" value="Valider"/></p>
			</form>
		</aside>
		<div>
			<?php echo $contenuInterface;
				  echo $contenuBis; ?>
		</div>
	</body>
</html>
