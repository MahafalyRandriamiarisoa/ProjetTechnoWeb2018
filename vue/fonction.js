function afficherNumCli(){
	var noeudDiv=document.createElement("div");
	noeudDiv.id='idDiv';
	var noeudP=document.createElement("p");
	noeudP.id='idP';
	var noeud=document.getElementById('f1');
	noeud.appendChild(noeudDiv);
	noeudDiv.appendChild(noeudP);
	document.getElementById('idP').innerHTML='<p><label>Numéro du client : </label><input type="text" name="numClient"/></p>';
}

function afficherNomDate(){
	var noeudDiv=document.createElement("div");
	noeudDiv.id='idDiv';
	var noeudP=document.createElement("p");
	noeudP.id='idP';
	var noeud=document.getElementById('f1');
	noeud.appendChild(noeudDiv);
	noeudDiv.appendChild(noeudP);
	document.getElementById('idP').innerHTML='<p><label>Nom du client : <label><input type="text" name="nomClient" required /></p><p><label>Date de naissance : <label><input type="text" name="birthday" required /></p>';
}
