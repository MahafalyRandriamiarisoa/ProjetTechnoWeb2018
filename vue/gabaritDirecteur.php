<!DOCTYPE html>
<html lang="fr">
    <head>
      <title>Ma page</title>
      <meta charset="utf-8">
	  <link rel="stylesheet"  href="vue/style/style.css" />
	  <script type="text/javascript" src="vue/fonction.js"></script>
    </head>
    
	<body>	
		<header>
			<p>Connexion en tant que : <?php echo $contenuHeader;?></p>
            <p class="btnDeconnexion"><a href="banque.php">Se Déconnecter</a></p>
		</header>
		<aside>
			<form id="f1" method="post" action="banque.php">
				<p><input type="hidden" name="categorie" value="Directeur"/></p>
				<fieldset>
					<legend> Actions </legend>
					<p><label>Sélectionner une action à réaliser :<label></p>
					<p>
						<select name="action">
							<option value="modifId"/>Modification des identifiants</option>
							<option value="modifMotif"/>Modification de la liste des comptes et contrats</option>
							<option value="modifPiece"/>Modification de la liste des pièces à fournir</option>
							<option value="stat"/>Statistiques de la banque</option>
						</select>
					</p>
				</fieldset>
				<p><input type="submit" name="valider" value="Valider"/></p>
			</form>
		</aside>
		<div class="interface">
			<?php
				  echo $contenuInterface;
				  echo $contenuBis;?>
		</div>
	</body>
</html>
