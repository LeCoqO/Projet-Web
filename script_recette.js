getrecetteFromBdd();
function getrecetteFromBdd() {
    $.ajax({
        url: 'ajax_Bdd.php', //toujours la même page qui est appelée
        type: 'POST',
        data: {
            fonction: 'selectProduitBdd', //fonction à executer
            base: 'physique',
            table: 'produit',
            selectCondition: '*'
            //add a where EtatCde LIKE 'fini' (cest l'etat de preparation  du cuisto)

        },
        success: function (data) {
            //console.log("success");
            //console.log(data);
            document.getElementById("tableauProduit").innerHTML = data;
            setupTab(['recette', 'nom', 'ingr', 'heure', 'prix']);
        },
        error: function (dataSQL, statut) {
            alert("error sqlConnect.js : " + dataSQL.erreur);
        }
    });
}

function getIngrFromBdd() {
    $.ajax({
        url: 'ajax_Bdd.php', //toujours la même page qui est appelée
        type: 'POST',
        data: {
            fonction: 'getIngrBdd', //fonction à executer
            base: 'physique',
            table: 'ingredient',
            selectCondition: '*',
            whereValue: 'WHERE NomIngred LIKE "Pain%"',
            classOption: 'burger_pain',

        },
        success: function (data) {
            //console.log(data);

            document.getElementById("ingr_pain").innerHTML = data;
        },
        error: function (dataSQL, statut) {
            alert("error sqlConnect.js : " + dataSQL.erreur);
        }
    });

    $.ajax({
        url: 'ajax_Bdd.php', //toujours la même page qui est appelée
        type: 'POST',
        data: {
            fonction: 'getIngrBdd', //fonction à executer
            base: 'physique',
            table: 'ingredient',
            selectCondition: '*',
            whereValue: 'WHERE TypeDIngr LIKE "S"',
            classOption: 'ingr_secondaire',
        },
        success: function (data) {
            //console.log(data);

            document.getElementById("ingr_second").innerHTML = data;
        },
        error: function (dataSQL, statut) {
            alert("error sqlConnect.js : " + dataSQL.erreur);
        }
    });
    $.ajax({
        url: 'ajax_Bdd.php', //toujours la même page qui est appelée
        type: 'POST',
        data: {
            fonction: 'getIngrBdd', //fonction à executer
            base: 'physique',
            table: 'ingredient',
            selectCondition: '*',
            whereValue: 'WHERE TypeDIngr LIKE "P" AND NomIngred NOT LIKE "Pain%"',
            classOption: 'ingr_principaux',

        },
        success: function (data) {
            //console.log(data);
            document.getElementById("ingr_princ").innerHTML = data;
            setupIngrListener();
        },
        error: function (dataSQL, statut) {
            alert("error sqlConnect.js : " + dataSQL.erreur);
        }
    });
}


recette = {
    "nom": "",
    "taille": "",
    "nbr_ingr_principaux": "",
    "nbr_ingr_secondaires": "",
    "prix": "",
    "img": "",
    "ingr_principaux": {
        "ingr_1": "",
        "ingr_2": "",
        "ingr_3": "",
        "ingr_4": "",
        "ingr_5": ""
    },
    "ingr_secondaires": {
        "ingr_1": "",
        "ingr_2": "",
        "ingr_3": "",
        "ingr_4": "",
        "ingr_5": "",
        "ingr_6": ""
    },
};

function genererRecetteJSON() {
    let tabPrincipaux = document.getElementsByClassName("ingr_principaux-selected");
    let tabSecondaires = document.getElementsByClassName("ingr_secondaire-selected");
    imgFile = document.getElementById("picture");

    if (tabPrincipaux[0] && tabSecondaires[0] && imgFile.files[0]) {
        //set Nom
        recette["nom"] = document.getElementById("name").value;
        //set taille
        recette["taille"] = "M"; //à changer
        //set prix
        recette["prix"] = "15.0";
        //set nbr ingr principaux
        recette["nbr_ingr_principaux"] = tabPrincipaux.length;
        //set nbr ingr secondaires
        recette["nbr_ingr_secondaires"] = tabSecondaires.length;
        //set img path
        recette["img"] = imgFile.files[0].name;
        //set ingr_principaux
        for (let l = 0; l < tabPrincipaux.length; l++) {
            recette["ingr_principaux"]["ingr_" + (l + 1)] = tabPrincipaux[l].id;
        };
        //set ingr_secondaires
        for (let m = 0; m < tabSecondaires.length; m++) {
            recette["ingr_secondaires"]["ingr_" + (m + 1)] = tabSecondaires[m].id;
        }
        console.log(recette);
        document.getElementById("preview").style.display = "block";
        slotPreview = document.getElementsByClassName("previewRecette");
        let stringRecette = formatRecette(recette);
        for (let i = 0; i < slotPreview.length; i++) {
            slotPreview[i].innerHTML += '<br><a href="#"><span class="text-center">' + stringRecette + '</span><img class ="image" style="max-height:200px;max-width:200px;"></a>';
        }
        previewPicture(imgFile);
        resetRecette();

    } else {
        alert("Recette incomplette");
    }
}

function resetRecette() {
    recette = {
        "nom": "",
        "taille": "",
        "nbr_ingr_principaux": "",
        "nbr_ingr_secondaires": "",
        "prix": "",
        "img": "",
        "ingr_principaux": {
            "ingr_1": "",
            "ingr_2": "",
            "ingr_3": "",
            "ingr_4": "",
            "ingr_5": ""
        },
        "ingr_secondaires": {
            "ingr_1": "",
            "ingr_2": "",
            "ingr_3": "",
            "ingr_4": "",
            "ingr_5": "",
            "ingr_6": ""
        },
    };
    /*let tabburgerpain = document.getElementsByClassName("burger_pain");
    for (let i = 0; i < tabburgerpain.length; i++) {
        tabburgerpain[i].classList.remove("pain-selected");
    }
    let tabburgerViande = document.getElementsByClassName("ingr_principaux");
    for (let i = 0; i < tabburgerViande.length; i++) {
        tabburgerViande[i].classList.remove("ingr_principaux-selected");
    }
    let tabburgerSauce = document.getElementsByClassName("ingr_secondaire");
    for (let i = 0; i < tabburgerSauce.length; i++) {
        tabburgerSauce[i].classList.remove("ingr_secondaire-selected");
    }*/
}



function showPanier() {
    var lePanier = document.getElementById("panier");
    var panierContent = document.getElementById("content");
    var panierOuvertContent = document.getElementById("contentOuv");
    var panierFermeeContent = document.getElementById("contentFer");

    if ((lePanier.className).includes("panier_fermee")) {
        lePanier.classList.remove("panier_fermee");
        lePanier.classList.add("panier_ouvert");
        panierOuvertContent.style.display = "none";
        panierFermeeContent.style.display = "block";

    } else {
        lePanier.classList.remove("panier_ouvert");
        lePanier.classList.add("panier_fermee");
        panierOuvertContent.style.display = "block";
        panierFermeeContent.style.display = "none";
        panierContent.innerHTML = "";
    }
}

function formatRecette(recette) {
    let strgCommande = "<strong>" + recette["nom"] + "</strong>";
    /*for (let i = 0; i < recette.length; i++) {
        strgCommande += ;
        for (let j = 0; j < 2; j++) {
            if (recette[i]["viandes"]["viande" + (j + 1)]) {
                strgCommande += recette[i]["viandes"]["viande" + (j + 1)];
            }
        };
    }*/
    //console.log(strgCommande)
    return strgCommande;
}

var images = document.getElementsByClassName("image");
// La fonction previewPicture
var previewPicture = function (e) {
    // e.files contient un objet FileList
    const [picture] = e.files
    // "picture" est un objet File
    if (picture) {
        // L'objet FileReader
        var reader = new FileReader();
        // L'événement déclenché lorsque la lecture est complète
        reader.onload = function (e) {
            // On change l'URL de l'image (base64)
            for (let i = 0; i < images.length; i++) {
                images[i].src = e.target.result
            }
            //image.src = e.target.result
        }
        // On lit le fichier "picture" uploadé
        reader.readAsDataURL(picture)

    }
}

function creation_open() {
    document.getElementById("main").style.display = "none";
    document.getElementById("main2").style.display = "block";
    getIngrFromBdd();

}
function liste_open() {
    document.getElementById("main").style.display = "block";
    document.getElementById("main2").style.display = "none";
    getrecetteFromBdd()
}


function setupIngrListener() {
    // console.log($("h3"));
    for (var i = 0; i < $("h3").length; i++) {
        $("h3")[i].addEventListener('click', function (e) {
            //console.log(this);
            if ((this.className).includes("burger_pain")) { //click sur pain
                tabburgerpain = document.getElementsByClassName("burger_pain");
                for (let i = 0; i < tabburgerpain.length; i++) { //Parcours tous les pains
                    tabburgerpain[i].classList.remove("pain-selected"); //enleve pain_selected
                }
                this.classList.add("pain-selected"); //selectionne this
            }
            if (document.getElementsByClassName("pain-selected")[0]) { //si pain choisi
                if ((this.className).includes("ingr_principaux")) { //click sur pain ingr principaux
                    tabIngrPrincipauxSelected = document.getElementsByClassName("ingr_principaux-selected");
                    if ((this.className).includes("ingr_principaux-selected")) {
                        this.classList.remove("ingr_principaux-selected");
                    } else if (tabIngrPrincipauxSelected.length < 4) { //4 ingrédients principaux max
                        this.classList.add("ingr_principaux-selected");
                    }
                }
                if ((this.className).includes("ingr_secondaire")) {
                    if (document.getElementsByClassName("ingr_principaux-selected")[0]) {
                        if ((this.className).includes("ingr_secondaire")) {
                            tabIngrSecondaireSelected = document.getElementsByClassName("ingr_secondaire-selected");
                            if ((this.className).includes("ingr_secondaire-selected")) {
                                this.classList.remove("ingr_secondaire-selected");
                            } else if (tabIngrSecondaireSelected.length < 6) { //6 ingrédients secondaire max
                                this.classList.add("ingr_secondaire-selected");
                            }
                        }
                    }
                }
            }
        })
    }

}


/*
$.ajax({
    url: 'ajax_Bdd.php', //toujours la même page qui est appelée
    type: 'POST',
    data: {
        fonction: 'selectCommande', //fonction à executer
        base: 'physique',
        selectCondition: '*',
    },
    success: function (data) {
        //console.log(data);
        document.getElementById("test").innerHTML = data;
    },
    error: function (dataSQL, statut) {
        alert("error sqlConnect.js : " + dataSQL.erreur);
    }
});*/

function test() {
    $.ajax({
        url: 'ajax_Bdd.php', //toujours la même page qui est appelée
        type: 'POST',
        data: {
            fonction: 'newFournisseur', //fonction à executer
            base: 'physique',
            table: 'fournisseur',
            nom: "Diego",
            adr: "adr",
            post: "71100",
            ville: "Chalon",
            tel: "0771718751"
        },
        success: function (data) {
            //console.log(data);
            document.getElementById("test").innerHTML = data;

        },
        error: function (dataSQL, statut) {
            alert("error sqlConnect.js : " + dataSQL.erreur);
        }
    });
}
