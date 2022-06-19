var waitThree = 0;


//cette fonction récupère la liste des recettes active dans la bdd
//et la sort sous forme de tableau sur la page 
getrecetteFromBdd();
function getrecetteFromBdd() {
    $.ajax({
        url: '../STOCK_REQUETE.php', //toujours la même page qui est appelée
        type: 'POST',
        data: {
            fonction: 'select', //fonction à executer
            requete: 'SELECT * FROM produit WHERE DateArchivProd IS NULL'
        },
        success: function (data) {
            //console.log("success");
            var resultats = JSON.parse(data);
            //console.log(resultats);

            var string = "<FONT face='arial'><div class='container'><CENTER>" +
                "<div class='table'>" +
                "<div class='table-header' bgcolor='grey' align='center'>" +
                "<div class='header__item'> <a id='recette' class='filter__link' href='#'>Numéro Recette</a></div>" +
                "<div class= 'header__item'> <a id='nom' class='filter__link' href='#'>Nom recette</a></div>" +
                "<div class='header__item'> <a id='ingr' class='filter__link' href='#'>Ingrédients</a></div>" +
                "<div class='header__item'> <a id='prix' class='filter__link' href='#'>Prix</a></div>" +
                "<div class='header__item'> <a id='delete' class='filter__link' href='#'>Delete</a></div>" +
                "</div><div class='table-content'>";

            for (let i = 0; i < resultats.length; i++) {
                //console.log('in loop: ' + i);
                string += '<div class="table-row">'
                    + "<div class='table-data'>" + resultats[i]['IdProd'] + "</div>"
                    + "<div class='table-data'>" + resultats[i]['NomProd'] + "</div>"
                    + "<div class= 'table-data' > ";
                for (j = 1; j < parseInt(resultats[i]['NbIngBase']) + 1; j++) {
                    string += resultats[i]['IngBase' + j] + ", ";
                }
                for (k = 1; k < parseInt(resultats[i]['NbIngOpt']) + 1; k++) {
                    string += resultats[i]['IngOpti' + k] + ", ";
                }
                string += "</div><div class='table-data'>" + resultats[i]['PrixUHT'] + "</div><div class='table-data'>" +
                    "<input type = 'image' id = 'image'onclick = 'checkBox_open(" + resultats[i]['IdProd'] + ", false)'" +
                    " src = '../img/supprimer.png' width = '45px' height = '45px' ></input > " +
                    "</div ></div>";
            }
            string += '</div>' + '</CENTER>' + '</div>' + '</FONT>';

            document.getElementById("tableauProduit").innerHTML = string;
            setupTab(['recette', 'nom', 'ingr', 'heure', 'prix']);
        },
        error: function (dataSQL, statut) {
            alert("error sqlConnect.js : " + dataSQL.erreur);
        }
    });
}
//Cette fonction récupère la liste des ingrédients dans la bdd
//et la sort en 3 liste de h3
function getIngrFromBdd() {
    //Cette fonction récupère la liste des pains dans la bdd
    $.ajax({
        url: '../STOCK_REQUETE.php', //toujours la même page qui est appelée
        type: 'POST',
        data: {
            fonction: 'select', //fonction à executer
            requete: 'SELECT * FROM ingredient WHERE NomIng LIKE "Pain%"',
        },
        success: function (data) {
            //console.log(data);
            var resultats = JSON.parse(data);
            let string = '';
            //console.log(resultats);
            for (let i = 0; i < resultats.length; i++) {
                string += '<div class="container_test"><h3 class="text-center burger_pain " id="' + resultats[i]['NomIng'] + '">' + resultats[i]['NomIng'] +
                    '</h3>' + '<input style="display: none" class="qty_selector" type="number" id="' + resultats[i]['NomIng'] + '_qty"></div>';
            }
            document.getElementById("ingr_pain").innerHTML = string;
            setupIngrListener();
        },
        error: function (dataSQL, statut) {
            alert("error sqlConnect.js : " + dataSQL.erreur);
        }
    });
    //Cette fonction récupère la liste des ingrédients secondaires dans la bdd
    $.ajax({
        url: '../STOCK_REQUETE.php', //toujours la même page qui est appelée
        type: 'POST',
        data: {
            fonction: 'select', //fonction à executer
            requete: 'SELECT * FROM ingredient WHERE Type LIKE "S"',
        },
        success: function (data) {
            //console.log(data);
            var resultats = JSON.parse(data);
            let string = '';
            //console.log(resultats);
            for (let i = 0; i < resultats.length; i++) {
                string += '<div class="container_test"><h3 class="text-center ingr_secondaire " id="' + resultats[i]['NomIng'] + '">' + resultats[i]['NomIng'] +
                    '</h3><input style="display: none" class="qty_selector" type="number" id="' + resultats[i]['NomIng'] + '_qty"> </div>';


            }
            document.getElementById("ingr_second").innerHTML = string;
            setupIngrListener();
        },
        error: function (dataSQL, statut) {
            alert("error sqlConnect.js : " + dataSQL.erreur);
        }
    });
    //Cette fonction récupère la liste des ingrédients principaux et sans les pains dans la bdd
    $.ajax({
        url: '../STOCK_REQUETE.php', //toujours la même page qui est appelée
        type: 'POST',
        data: {
            fonction: 'select', //fonction à executer
            requete: 'SELECT * FROM ingredient WHERE Type LIKE "P" AND NomIng NOT LIKE "Pain%"',
        },
        success: function (data) {
            //console.log(data);
            var resultats = JSON.parse(data);
            let string = '';
            //console.log(resultats);
            for (let i = 0; i < resultats.length; i++) {
                string += '<div class="container_test"><h3 class="text-center ingr_principaux " id="' + resultats[i]['NomIng'] + '">' + resultats[i]['NomIng'] +
                    '</h3><input style="display: none" min="0" class="qty_selector" type="number" id="' + resultats[i]['NomIng'] + '_qty"> </div>';

            }
            document.getElementById("ingr_princ").innerHTML = string;
            setupIngrListener();
        },
        error: function (dataSQL, statut) {
            alert("error sqlConnect.js : " + dataSQL.erreur);
        }
    });
}

//Forme du json qui va contenir les données de la recette
recette = {
    "nom": "",
    "taille": "",
    "nbr_ingr_principaux": "",
    "nbr_ingr_secondaires": "",
    "prix": "",
    "img": "",
    "ingr_principaux": {
        "ingr_1": "",
        "ingr_1_qty": "",
        "ingr_2": "",
        "ingr_2_qty": "",
        "ingr_3": "",
        "ingr_3_qty": "",
        "ingr_4": "",
        "ingr_4_qty": "",
        "ingr_5": "",
        "ingr_5_qty": ""
    },
    "ingr_secondaires": {
        "ingr_1": "",
        "ingr_1_qty": "",
        "ingr_2": "",
        "ingr_2_qty": "",
        "ingr_3": "",
        "ingr_3_qty": "",
        "ingr_4": "",
        "ingr_4_qty": "",
        "ingr_5": "",
        "ingr_5_qty": "",
        "ingr_6": "",
        "ingr_6_qty": ""
    },
};

//Cette fonction récupère les valeurs entrées par le gérant 
//et les mets dans le json
function genererRecetteJSON() {
    let tabPrincipaux = document.getElementsByClassName("ingr_principaux-selected");
    let tabSecondaires = document.getElementsByClassName("ingr_secondaire-selected");
    let tabQtyPrincipaux = document.getElementsByClassName("selectedQtyP");
    let tabQtySecondaires = document.getElementsByClassName("selectedQtyS");

    imgFile = document.getElementById("picture");

    if (tabPrincipaux[0] && imgFile.files[0]) {
        //set Nom
        recette["nom"] = document.getElementById("name").value;
        //set taille
        recette["taille"] = document.getElementById("tailleChoice").value; //à changer
        //set prix
        recette["prix"] = document.getElementById("price").value;
        //set boolean incontournable
        recette["incontournable"] = document.getElementById("incontournableCheckbox").checked;
        //set nombre D'option max
        recette["nombreOptionMax"] = document.getElementById("maximumOption").value;
        //set nbr ingr principaux
        recette["nbr_ingr_principaux"] = tabPrincipaux.length;
        //set nbr ingr secondaires
        recette["nbr_ingr_secondaires"] = tabSecondaires.length;
        //set img path
        recette["img"] = imgFile.files[0].name;
        recette["ingr_principaux"]["ingr_1"] = document.getElementsByClassName("pain-selected")[0].id;
        recette["ingr_principaux"]["ingr_1_qty"] = document.getElementsByClassName("selectedQtyP")[0].value;
        //set ingr_principaux
        //console.log(tabPrincipaux);
        for (let l = 0; l < tabPrincipaux.length; l++) {
            recette["ingr_principaux"]["ingr_" + (l + 2)] = tabPrincipaux[l].id;
            recette["ingr_principaux"]["ingr_" + (l + 2) + "_qty"] = tabQtyPrincipaux[l + 1].value;

        };
        //set ingr_secondaires
        for (let m = 0; m < tabSecondaires.length; m++) {
            recette["ingr_secondaires"]["ingr_" + (m + 1)] = tabSecondaires[m].id;
            recette["ingr_secondaires"]["ingr_" + (m + 1) + "_qty"] = tabQtySecondaires[m].value;

        }
        //console.log(recette);
        //On affiche la prévisualisation et le button ajouter
        document.getElementById("preview").style.display = "block";
        document.getElementById("button_add_to_bdd").style.display = "block";
        var string = "";
        var stringIngrPrinc = "";
        for (let i = 0; i < recette['nbr_ingr_principaux']; i++) {
            stringIngrPrinc += ", '" + recette['ingr_principaux']['ingr_' + (i + 1)] + "'";
        }
        var stringIngrSecond = '';
        for (let i = 0; i < recette['nbr_ingr_secondaires']; i++) {
            stringIngrSecond += ", '" + recette['ingr_secondaires']['ingr_' + (i + 1)] + "'";
        }

        string += '<br><a href="#"><span class="text-center"><strong>' + recette["nom"] + '</strong></span></a>';
        string += '<div class="item">' +
            '<img class ="image" style="max-height:200px;max-width:200px;">' +
            '<div class="item-infos">' +
            '<h3>' + recette["nom"] + '</h3>' +
            '<hr> <p>' + recette['ingr_principaux']['ingr_1'] + stringIngrPrinc + stringIngrSecond + '</p><p class="prix">' + recette["prix"] + '</p>' +
            '<img src="../img/panier.png" class="imgpanier "></div></div>';

        document.getElementById("previewRecette").innerHTML = string;
        //On ajoute l'image a la prévisualisation
        previewPicture(imgFile);

        localStorage.setItem("recette", JSON.stringify(recette));
        document.getElementById("button_add_to_bdd").style.display = "block";
    } else {
        alert("Recette incomplète, Veuillez compléter tous les champs.");
    }
}
//Cette fonction ajoute la recette depuis le json vers la bdd
//et ajoute dans la table associatives entre les quantités, l'id de la recette
//et l'id des ingrédients les valeurs pour la recette créée
function addToBase() {
    let recette = localStorage.getItem("recette");
    let estIncontounable;
    let json = JSON.parse(recette);
    console.log(json);

    var stringIngrPrinc = "";
    for (let i = 0; i < json['nbr_ingr_principaux']; i++) {
        stringIngrPrinc += ", '" + json['ingr_principaux']['ingr_' + (i + 1)] + "'";
    }
    for (let i = 0; i < (5 - json['nbr_ingr_principaux']); i++) {
        stringIngrPrinc += ", 'NULL'"
    }
    var stringIngrSecond = '';
    for (let i = 0; i < json['nbr_ingr_secondaires']; i++) {
        stringIngrSecond += ", '" + json['ingr_secondaires']['ingr_' + (i + 1)] + "'";
    }
    for (let i = 0; i < (6 - json['nbr_ingr_secondaires']); i++) {
        stringIngrSecond += ", 'NULL'"
    }

    if (json['incontournable']) {
        estIncontounable = "o";
    } else {
        estIncontounable = "n";
    }
    //console.log(stringIngrPrinc);
    //console.log(stringIngrSecond);
    //Ajoute la recette dans la bdd
    $.ajax({
        url: '../STOCK_REQUETE.php', //toujours la même page qui est appelée
        type: 'POST',
        data: {
            fonction: 'update', //fonction à executer
            requete: "INSERT INTO `produit`(`NomProd`, `Taille`, `NbIngBase`, `NbIngOpt`, `PrixUHT`, `Image`," +
                " `IngBase1`, `IngBase2`, `IngBase3`, `IngBase4`, `IngBase5`, `IngOpti1`, `IngOpti2`, `IngOpti3`," +
                " `IngOpti4`, `IngOpti5`, `IngOpti6`, `NbOptMax`, `Incontournable`)" +
                " VALUES ('" + json['nom'] + "', '" + json['taille'] + "', '" + json['nbr_ingr_principaux'] + "', '"
                + json['nbr_ingr_secondaires'] + "', '" + json['prix'] + "', '../img/" + json['img'] + "'"
                + stringIngrPrinc + stringIngrSecond + ", '" + json['nombreOptionMax'] + "', '" + estIncontounable + "')",
        },
        success: function (data) {
            location.reload();
            //console.log(data)
        },
        error: function (dataSQL, statut) {
            alert("error sqlConnect.js : " + dataSQL.erreur);
        }
    });
    //Récupere l'id de la recette que l'on vient de créer 
    $.ajax({
        url: '../STOCK_REQUETE.php', //toujours la même page qui est appelée
        type: 'POST',
        data: {
            fonction: 'select', //fonction à executer
            requete: "SELECT IdProd FROM produit WHERE NomProd LIKE '" + json["nom"] + "'",
        },
        success: function (data) {
            //console.log(data)
            var resultats = JSON.parse(data);
            json["idProd"] = resultats[0]["IdProd"];
        },
        error: function (dataSQL, statut) {
            alert("error sqlConnect.js : " + dataSQL.erreur);
        }
    });
    //Ajoute toutes les quantités associées à la recette et aux ingrédients principaux
    for (let i = 0; i < json['nbr_ingr_principaux']; i++) {
        $.ajax({
            url: '../STOCK_REQUETE.php', //toujours la même page qui est appelée
            type: 'POST',
            data: {
                fonction: 'select', //fonction à executer
                requete: "SELECT IdIng FROM ingredient WHERE NomIng LIKE '" + json['ingr_principaux']['ingr_' + (i + 1)] + "'",
            },
            success: function (data) {
                var resultats = JSON.parse(data);
                console.log("Nom ingr " + i + ": ", resultats[0]["IdIng"]);
                ingId = resultats[0]["IdIng"];
                pushToBdd(ingId, json["idProd"], i, json, "ingr_principaux");
            },
            error: function (dataSQL, statut) {
                alert("error sqlConnect.js : " + dataSQL.erreur);
            }
        });

    }
    //Ajoute toutes les quantités associées à la recette et aux ingrédients principaux
    for (let i = 0; i < json['nbr_ingr_secondaires']; i++) {
        $.ajax({
            url: '../STOCK_REQUETE.php', //toujours la même page qui est appelée
            type: 'POST',
            data: {
                fonction: 'select', //fonction à executer
                requete: "SELECT IdIng FROM ingredient WHERE NomIng LIKE '" + json['ingr_secondaires']['ingr_' + (i + 1)] + "'",
            },
            success: function (data) {
                var resultats = JSON.parse(data);
                console.log("Nom ingr " + i + ": ", resultats[0]["IdIng"]);
                ingId = resultats[0]["IdIng"];
                pushToBdd(ingId, json["idProd"], i, json, "ingr_secondaires");
            },
            error: function (dataSQL, statut) {
                alert("error sqlConnect.js : " + dataSQL.erreur);
            }
        });
    }
    //On vide le json 
    localStorage.setItem("recette", "");
    resetRecette();
}

//Cette fonction prends en paramètre l'id d'un ingrédient, l'id d'un produit,
//l'indice dans le json de l'ingrédient, le json et le type d'ingrédient
function pushToBdd(ingId, prodId, i, json, type) {
    console.log("pushTo: " + ingId, prodId, i);
    $.ajax({
        url: '../STOCK_REQUETE.php', //toujours la même page qui est appelée
        type: 'POST',
        data: {
            fonction: 'update', //fonction à executer
            requete: "INSERT INTO `prod_ingr` (`IdIng`, `IdProd`, `Quant`)" +
                "VALUES ('" + ingId + "', '" + prodId + "', '" + json[type]["ingr_" + (i + 1) + "_qty"] + "');",
        },
        success: function (data) {
            //location.reload();
            //console.log(data)
        },
        error: function (dataSQL, statut) {
            alert("error sqlConnect.js : " + dataSQL.erreur);
        }
    });
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
            "ingr_1_qty": "",
            "ingr_2": "",
            "ingr_2_qty": "",
            "ingr_3": "",
            "ingr_3_qty": "",
            "ingr_4": "",
            "ingr_4_qty": "",
            "ingr_5": "",
            "ingr_5_qty": ""
        },
        "ingr_secondaires": {
            "ingr_1": "",
            "ingr_1_qty": "",
            "ingr_2": "",
            "ingr_2_qty": "",
            "ingr_3": "",
            "ingr_3_qty": "",
            "ingr_4": "",
            "ingr_4_qty": "",
            "ingr_5": "",
            "ingr_5_qty": "",
            "ingr_6": "",
            "ingr_6_qty": ""
        },
    };
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

//Change la page de la création de recette à la  liste des recettes
function creation_open() {
    document.getElementById("main").style.display = "none";
    document.getElementById("main2").style.display = "block";
    getIngrFromBdd();
}
//Change la page de la liste des recettes à la création de recette
function liste_open() {
    document.getElementById("main").style.display = "block";
    document.getElementById("main2").style.display = "none";
    getrecetteFromBdd();
}

//Cette fonction ajoute aux listes d'ingrédients des eventListeners
//afin manipuler leurs classes pour les selectionner
function setupIngrListener() {
    // console.log($("h3"));
    waitThree++;
    if (waitThree >= 3) {
        for (var i = 0; i < $("h3").length; i++) {
            //console.log($("h3")[i]);
            $("h3")[i].addEventListener('click', function (e) {

                if ((this.className).includes("burger_pain")) {                         //click sur pain
                    tabburgerpain = document.getElementsByClassName("burger_pain");
                    for (let i = 0; i < tabburgerpain.length; i++) {
                        tabburgerpain[i].classList.remove("pain-selected");
                        $(tabburgerpain[i]).next().css("display", "none")
                        $(tabburgerpain[i]).next().removeClass("selectedQtyP");
                    }
                    this.classList.add("pain-selected");
                    $(this).next().css("display", "block")
                    $(this).next().addClass("selectedQtyP");

                }
                if (document.getElementsByClassName("pain-selected")[0]) { //si un pain choisi
                    if ((this.className).includes("ingr_principaux")) { //click sur ingr principaux
                        tabIngrPrincipauxSelected = document.getElementsByClassName("ingr_principaux-selected");
                        if ((this.className).includes("ingr_principaux-selected")) {
                            this.classList.remove("ingr_principaux-selected");
                            $(this).next().css("display", "none")
                            $(this).next().removeClass("selectedQtyP");

                        } else if (tabIngrPrincipauxSelected.length < 4) { //4 ingrédients principaux max
                            this.classList.add("ingr_principaux-selected");
                            $(this).next().css("display", "block")
                            $(this).next().addClass("selectedQtyP");
                        }
                    }
                    if ((this.className).includes("ingr_secondaire")) {
                        if (document.getElementsByClassName("ingr_principaux-selected")[0]) { //si un ingr principaux choisi
                            if ((this.className).includes("ingr_secondaire")) {                //click sur ingr secondaires
                                tabIngrSecondaireSelected = document.getElementsByClassName("ingr_secondaire-selected");
                                if ((this.className).includes("ingr_secondaire-selected")) {
                                    this.classList.remove("ingr_secondaire-selected");
                                    $(this).next().css("display", "none")
                                    $(this).next().removeClass("selectedQtyS");

                                } else if (tabIngrSecondaireSelected.length < 6) { //6 ingrédients secondaire max
                                    this.classList.add("ingr_secondaire-selected");
                                    $(this).next().css("display", "block")
                                    $(this).next().addClass("selectedQtyS");
                                }
                            }
                        }
                    }
                }
            })
        }
    }
}



