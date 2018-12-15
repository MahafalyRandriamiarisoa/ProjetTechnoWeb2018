<!DOCTYPE html>
<html lang="fr">
    <head>
      <title>Ma page</title>
      <meta charset="utf-8">
	  <link rel="stylesheet"  href="vue/style/style.css"/>
	  <script type="text/javascript" src="vue/fonction.js"></script>
	  
    </head>
    
	<body>	
		<header>
			<p>Connexion en tant que :<?php echo $contenuHeader;?></p>
            <a class="btnDeconnexion" href="banque.php">se déconnecter</a>
		</header>
		<aside>
			<form id="f1" method="post" action="banque.php">
				<?php echo '<p><input type="text" name="categorie" value="Conseiller"style="display:none" /></p>' ?>
              			<fieldset >
					<p><label style="display: none;">Numéro du client :</label><input type="hidden" name="numClient"/></p>	
					<p><label>Sélectionner une action à réaliser :<label></p>
					<p><select name="action">
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
		   <?php echo $contenuBis;?>
		</div>
	</body>
</html>
