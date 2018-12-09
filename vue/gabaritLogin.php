<!DOCTYPE html>
<html lang="fr">
    <head>
      <title>Ma page</title>
      <meta charset="utf-8">
	  <link rel="stylesheet"  href="vue/style/style.css" />

    </head>
    
	<body>
	<header>
		<h1> Banque 3.0 </h1>
	</header>
	<div>
		<form id="formLogin" method="post" action="banque.php">
			<fieldset>
				
				<p><label>Login : </label><input type="text" name="identifiant"/></p>
				<p><label>Mot de passe : </label><input type="password" name="motDePasse"/></p>
				<p><input type="submit"  name="connexion" value="Se connecter"/></p>
			
			</fieldset>
			<?php echo $contenu ?>
		</form>
	</div>
	</body>
</html>
