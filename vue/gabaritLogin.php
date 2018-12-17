<!DOCTYPE html>
<html lang="fr">
    <head>
      <title>Ma page</title>
      <meta charset="utf-8">
	  <link rel="stylesheet"  href="vue/style/style.css" />

    </head>
    
	<body>
		<header>
			<h1>Bienvenue, veuillez vous connecter :</h1>
		</header>
		
		<div class="divLogin">
			<form id="formLogin" method="post" action="banque.php">
				<fieldset id="fieldsetLogin">
						<p><label class="labelinput">Login : </label><br><input type="text" name="identifiant"/></p><br/>
						<p><label class="labelinput">Mot de passe : </label><br><input type="password" name="motDePasse"/></p>
						<p><label class="label_nostyle">h</label><input type="submit"  name="connexion" value="Se connecter"/></p>
				</fieldset>
				<?php echo $contenu ?>
			</form>
		</div>
	</body>
</html>
