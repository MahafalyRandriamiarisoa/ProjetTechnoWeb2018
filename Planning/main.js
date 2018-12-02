function showRDV(){
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

    quit.src = "cross.png";
    title.textContent = "Plus d'information";
    nomClient.textContent = "Nom du client : ";
    inputNomClient.value = "DUPONT Martin";
    inputNomClient.readOnly = "readOnly";
    motif.textContent = "Motif : ";
    nomMotif.value = "Crédit";
    nomMotif.readOnly = "readOnly";
    date.textContent = "Date : ";
    nomDate.value = "Le 25/06/2018 à 8H";
    nomDate.readOnly = "readOnly";
    paf.textContent = "Liste des pièces à fournir : ";
    listePaf.value = "Pièce d'identité, Fiche de salaire, Fiche d'imposition";
    listePaf.readOnly = "readOnly";

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