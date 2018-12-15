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
			<p>Connexion en tant que :<?php echo $contenuHeader;?></p>
            <a class="btnDeconnexion" href="banque.php">Se Déconnecter</a>
		</header>
		<aside>
			<form id="numCli" method="post" action="banque.php">

                <?php

                echo '<p><input type="hidden" name="categorie" value="Agent" /></p>';
                echo '<p><input type="hidden" name="numClient" value="'.$numClient.'"/></p>';

                ?>
				<fieldset id="f1">
					<legend> Rechercher un client </legend>
					<p><input type="radio" name="choix" onChange="afficherNumCli()" id="r1" /><label for="r1">Par le numéro</label> </p>
					<p><input type="radio" name="choix"  onChange="afficherNomDate()" id="r2" /><label for="r2">Par le nom et la date de naissance</label></p>
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
