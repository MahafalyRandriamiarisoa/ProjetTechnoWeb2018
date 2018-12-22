<!DOCTYPE html>
<html lang="fr">
    <head>
      <title>Ma page</title>
      <meta charset="utf-8">
	  <link rel="stylesheet"  href="vue/style/style.css" />

    </head>
    
	<body id="bodyLogin">
		<header>
			<h1 id="loginTitle">Banque 3.0</h1>
		</header>
		
		<div class="divLogin">
			<form id="formLogin" method="post" action="banque.php">
				<fieldset id="fieldsetLogin">
						<p><label class="divLabel" for="login">Login : </label><input type="text" id="login" name="identifiant"/></p>
						<p><label class="divLabel" for="mdp">Mot de passe : </label><input type="password" id="mdp" name="motDePasse"/></p>
						<p class="pbtn"><input class="btn" type="submit"  name="connexion" value="Se connecter"/></p>
				</fieldset>
				<?php echo $contenu ?>
			</form>
		</div>
	</body>
</html>
