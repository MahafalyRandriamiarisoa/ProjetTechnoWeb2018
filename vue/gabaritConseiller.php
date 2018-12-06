<!DOCTYPE html>
<html lang="fr">
    <head>
      <title>Ma page</title>
      <meta charset="utf-8">
	  <link rel="stylesheet"  href="vue/style/styles.css" />
	  
    </head>
    
	<body>	
		<header>
			<p>Connexion en tant que :<?php echo $contenuHeader;?></p>
		</header>
		<aside>
			<form id="f1" method="post" action="banque.php">
				<fieldset >
					<legend> Conseiller n° </legend>
					<p><label>Id Conseiller :</label><input type="text" name="IdConseiller"/></p>
					
				</fieldset>
			
				<fieldset>
					<legend> Actions </legend>
					
					<p><label>Sélectionner une action à réaliser :<label></p>
					<p>
						<select name="action">
							<option value="inscrireClient">Inscrire un nouveau client</option>
							<option value="vendreContrat">Vendre un contrat</option>
							<option value="ouvrirCompte">Ouvrir un compte</option>
							<option value="modifDecouvert">Modifier la valeur d'un découvert</option>
							<option value="resilier">Résilier un compte ou un contrat</option>
							<option value="planning">Afficher le planning</option>
						</select>
					</p>
					
				</fieldset>
				<p><input type="reset"  value="Effacer"/><input type="submit" name="valider" value="Valider"/></p>
			
			</form>
			
				
			
		</aside>
		<div>
		   <?php echo $contenuInterface; ?>
		</div>
	</body>
</html>
