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

function showRDV(dataNom, dataPrenom, dataMotif, dataPieceAFournir, dataDateHeure){
    var divBack = document.createElement("div");
    var divModal = document.createElement("div");
    var quit = document.createElement("img");
    var title = document.createElement("h1");
    var infos = document.createElement("div");
    var nomClient = document.createElement("label");
    var inputNomClient = document.createElement("input");
    var motif = document.createElement("label");
    var nomMotif = document.createElement("input");
    var date = document.createElement("label");
    var nomDate = document.createElement("input");
    var paf = document.createElement("label");
    var listePaf = document.createElement("textarea");
    var br = document.createElement("br");

    divBack.className = "showRDV_back";
    divModal.className = "showRDV_modal";
    infos.className="infos";

    document.body.appendChild(divBack);

    divBack.appendChild(divModal);
    divModal.appendChild(quit);
    divModal.appendChild(title);
    infos.appendChild(br.cloneNode(true));
    infos.appendChild(br.cloneNode(true));
    divModal.appendChild(infos);
    infos.appendChild(nomClient);
    infos.appendChild(inputNomClient);
    infos.appendChild(br);
    infos.appendChild(br.cloneNode(true));
    infos.appendChild(br.cloneNode(true));
    infos.appendChild(br.cloneNode(true));
    infos.appendChild(br.cloneNode(true));
    infos.appendChild(motif);
    infos.appendChild(nomMotif);
    infos.appendChild(br.cloneNode(true));
    infos.appendChild(br.cloneNode(true));
    infos.appendChild(br.cloneNode(true));
    infos.appendChild(br.cloneNode(true));
    infos.appendChild(br.cloneNode(true));
    infos.appendChild(date);
    infos.appendChild(nomDate);
    infos.appendChild(br.cloneNode(true));
    infos.appendChild(br.cloneNode(true));
    infos.appendChild(br.cloneNode(true));
    infos.appendChild(br.cloneNode(true));
    infos.appendChild(paf);
    infos.appendChild(listePaf);

    var dateRAW = dataDateHeure.split('-');
    var mois = dateRAW[1];
    var annee = dateRAW[0];
    var jour = dateRAW[2].split(' ')[0];
    var heureRAW = dateRAW[2].split(' ')[1];
    var heureSplit = heureRAW.split(':');
    var heurePropre = heureSplit[0] + "H" + heureSplit[1];
    var datePropre = "Le " + jour + "/" + mois + "/" + annee + " à " + heurePropre;
    quit.src = "vue/style/cross.png";
    title.textContent = "Plus d'information";
    nomClient.textContent = "Nom du client : ";
    inputNomClient.value = dataNom.toUpperCase() + " " + dataPrenom;
    inputNomClient.readOnly = "readOnly";
    motif.textContent = "Motif : ";
    nomMotif.value = dataMotif;
    nomMotif.readOnly = "readOnly";
    date.textContent = "Date : ";
    nomDate.value = datePropre;
    nomDate.readOnly = "readOnly";
    paf.textContent = "Liste des pièces à fournir : ";
    listePaf.value = dataPieceAFournir;
    listePaf.readOnly = "readOnly";
    listePaf.style = "resize : none;";

    quit.addEventListener('click', handler, false);

    document.onkeydown = function(e){
        if(e.key == "Escape"){
            handler(e);
        }
    };

    function handler(event){
        event.preventDefault();
        document.body.removeChild(divBack);
    }
}

function checkRDV(c){
    var b = document.getElementById(c).checked;
    if(b){
        document.getElementById(c).checked = false;
    }else{
        document.getElementById(c).checked = true;
    }

}