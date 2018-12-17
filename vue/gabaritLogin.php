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
						<p><label class="divLabel">Login : </label><br><input type="text" name="identifiant"/></p><br/>
						<p><label class="divLabel">Mot de passe : </label><br><input type="password" name="motDePasse"/></p>
						<p><label class="divLabel"></label><input class="btn" type="submit"  name="connexion" value="Se connecter"/></p>
				</fieldset>
				<?php echo $contenu ?>
			</form>
		</div>
	</body>
</html>
