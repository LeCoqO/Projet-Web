<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="author" content="Diego TORRES" />
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Hom'burger</title>
</head>
<header>
    <div class="sidebar" id="mySidebar">
        <button class="bar-item button" onclick="sidebar_close()">Close &times;</button><br>
        <br /><a href="index.php" class="bar-item button">Accueil</a><br>
        <br /><a href="commande.php" class="bar-item button">Livreur</a><br>
        <br /><a href="mentionLegale.html" class="bar-item button">Mention légale</a><br>
    </div>
    <button class="button left hide-large" onclick="sidebar_open()">&#9776;</button>
    <h1 class="text-center ">
        <img src="./img/logo.jpg" class="logo" alt="" />
    </h1>
</header>

<body>
    <div id="panier" class="panier_fermee" onclick="showPanier()">
        <p id="content" class="text-center">
            <small>R<br>E<br>C<br>E<br>T<br>T<br>E</small>
        </p>
    </div>
    <div class="container content-container">
        <main role="main">
            <?php
            //require_once '../connexion.php';
            try {
                $connex = new PDO(
                    'mysql:host=' . 'localhost' . ';dbname='
                        . 'clicom',
                    'root',
                    'cqfd14sAfe',
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
                );
            } catch (PDOException $e) {
                echo 'Erreur : ' . $e->getMessage() . '<br />';
                echo 'N° : ' . $e->getCode();
                die();
            }
            $connex->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
            $connex->beginTransaction(); //début
            $rq = "Select * from commande";
            $result = $connex->query($rq);

            echo '<FONT face="arial">';
            echo '<div class="container">';
            echo '<CENTER>';
            echo '<div class="table">';
            echo "<div class='table-header' bgcolor='grey' align='center'>";
            printf(
                "<div class='header__item'> <a id='ncom' class='filter__link' href='#'>Numéro Commande</a></div>
        <div class='header__item'> <a id='ncli'  class='filter__link' href='#'>Numéro Client</a></div>
        <div class='header__item'> <a id='date' class='filter__link' href='#'>Date</a></div>
        <div class='header__item'> <a id='iti' class='filter__link' href='#'>Adresse</a></div>"
            );
            echo '</div>';
            echo '<div class="table-content">';
            foreach ($result as $element) {
                printf('<div class="table-row">'
                    . "<div class='table-data'>" . $element['NCOM'] . "</div>"
                    . "<div class='table-data'>" . $element['NCLI'] . "</div>"
                    . "<div class='table-data'>" . $element['DATECOM'] . "</div>"
                    . "<div class='table-data buttonItineraire'>26 rue de mirande Dijon</div>"
                    . '</div>');
            }
            echo '</div>';
            echo '</CENTER>';
            echo '</div>';
            echo '</FONT>';
            ?>
        </main>
        <main role="main2">
            <h2 class="text-center">Création d'un menu:</h2>
            <h2>Nom du menu</h2>
            <input class="text-center" type="text" id="name" name="name" required size="10">
            <div class="clear"><br><br><br></div>
            <div class="half">
                <h2>Choisir une image</h2>
                <label for="mon_fichier">Sélectionnez le fichier à
                    télécharger <br>(extensions valides :'jpg' , 'jpeg' , 'gif' , 'png' -- max 1
                    Mo) :</label><br>
                <input type="file" name="picture" id="picture" onchange="previewPicture(this)" accept=".jpg, .png, .gif" required />
            </div>
            <div class="half">
                <img class="image" style="max-height:150px;max-width:150px;">
            </div>
            <div class="clear"><br><br><br></div>

            <section class="left">
                <article role="article center">
                    <h1 class="text-center">ÉTAPE 1</h1>
                    <h2 class="small text-center">Choisissez le pain</h2>
                    <h3 class="text-center tacos-size" id="L">
                        Pain Sésame
                    </h3>
                    <h3 class="text-center tacos-size" id="XL">
                        Pain Blé
                    </h3>
                </article>
            </section>
            <section class="left">
                <article class="left">
                    <h1 class="text-center">ÉTAPE 2</h1>
                    <h2 class="small text-center">Choisissez votre viande</h2>
                    <h3 class="text-center tacos-viande" id="Filet de poulet nature ou mariné">
                        Filet de poulet nature ou mariné
                    </h3>
                    <h3 class="text-center tacos-viande" id="Viande hachée">
                        Viande hachée
                    </h3>
                    <h3 class="text-center tacos-viande" id="Cordon Bleu">
                        Cordon Bleu
                    </h3>
                    <h3 class="text-center tacos-viande" id="Nuggets">
                        Nuggets
                    </h3>
                    <h3 class="text-center tacos-viande" id="Merguez">
                        Merguez
                    </h3>
                    <h3 class="text-center tacos-viande" id="Tenders">
                        Tenders
                    </h3>
                    <h3 class="text-center tacos-viande" id="Falafels">
                        Falafels
                    </h3>
                </article>
            </section>

            <section class="left">
                <article class="col-md-6 d-flex flex-column justify-content-center">
                    <h1 class="text-center">ÉTAPE 3</h1>
                    <h2 class="small text-center">Choississez votre sauce</h2>
                    <h3 class="text-center tacos-sauce" id="Algerienne">
                        Algerienne
                    </h3>
                    <h3 class="text-center tacos-sauce" id="Barbecue">
                        Barbecue
                    </h3>
                    <h3 class="text-center tacos-sauce" id="Burger">
                        Burger
                    </h3>
                    <h3 class="text-center tacos-sauce" id="Chili thai">
                        Chili thai
                    </h3>
                    <h3 class="text-center tacos-sauce" id="Ketchup">
                        Ketchup
                    </h3>
                    <h3 class="text-center tacos-sauce" id="Mayonnaise">
                        Mayonnaise
                    </h3>
                    <h3 class="text-center tacos-sauce" id="Fuego">
                        Fuego
                    </h3>
                </article>
            </section>


        </main>
        <div class="clear"><br><br><br></div>

        <div id="preview" style="display: none;">
            <h2>Prévisualisation</h2>
            <div class="row text-center">
                <div class="column previewMenu"></div>
                <div class="column previewMenu"></div>
                <div class="column previewMenu"></div>
            </div>
        </div>
        <button onclick="genererMenuJSON()">Générer</button>

    </div>

</body>
<script>
    var menu = {
        "name": "",
        "size": "",
        "viandes": {
            "viande1": "",
            "viande2": "",
            "viande3": ""
        },
        "sauce": "",
        "supplements": {
            "supplement1": "",
            "supplement2": ""
        },
        "boisson": ""
    };
    var commande = [];

    for (var i = 0; i < $("h3").length; i++) {
        $("h3")[i].addEventListener('click', function(e) {
            if ((this.className).includes("tacos-size")) {
                tabtacosSize = document.getElementsByClassName("tacos-size");
                for (let i = 0; i < tabtacosSize.length; i++) {
                    tabtacosSize[i].classList.remove("size-selected");
                }
                this.classList.add("size-selected");
            }
            if (document.getElementsByClassName("size-selected")[0]) {
                if ((this.className).includes("tacos-viande")) {
                    if (document.getElementsByClassName("size-selected")[0].id == "M") {
                        if ((this.className).includes("tacos-viande-selected")) {
                            this.classList.remove("tacos-viande-selected");
                        } else {
                            if ($(".tacos-viande-selected").length >= 1) {
                                $(".tacos-viande-selected")[0].classList.remove("tacos-viande-selected");
                            }
                            this.classList.add("tacos-viande-selected");
                        }
                    }
                    if (document.getElementsByClassName("size-selected")[0].id == "L") {
                        if ((this.className).includes("tacos-viande-selected")) {
                            this.classList.remove("tacos-viande-selected");
                        } else {
                            if ($(".tacos-viande-selected").length < 1) {
                                this.classList.add("tacos-viande-selected");
                            } else if ($(".tacos-viande-selected").length == 1) {
                                this.classList.add("tacos-viande-selected");
                            }
                        }
                    }
                    if (document.getElementsByClassName("size-selected")[0].id == "XL") {
                        if ((this.className).includes("tacos-viande-selected")) {
                            this.classList.remove("tacos-viande-selected");
                        } else {
                            if ($(".tacos-viande-selected").length < 1) {
                                this.classList.add("tacos-viande-selected");
                            } else if ($(".tacos-viande-selected").length == 1) {
                                this.classList.add("tacos-viande-selected");
                            } else if ($(".tacos-viande-selected").length == 2) {
                                this.classList.add("tacos-viande-selected");
                            }
                        }
                    }
                }
                if ((this.className).includes("tacos-sauce")) {
                    if (document.getElementsByClassName("tacos-viande-selected")[0]) {
                        if ((this.className).includes("tacos-sauce-selected")) {
                            this.classList.remove("tacos-sauce-selected");
                        } else {
                            let tabTacosSauce = document.getElementsByClassName("tacos-sauce");
                            for (let i = 0; i < tabTacosSauce.length; i++) {
                                tabTacosSauce[i].classList.remove("tacos-sauce-selected");
                            }
                            this.classList.add("tacos-sauce-selected");
                        }
                    }
                }
                if ((this.className).includes("tacos-supplement")) {
                    if (document.getElementsByClassName("tacos-sauce-selected")[0]) {
                        if ((this.className).includes("tacos-supplement-selected")) {
                            this.classList.remove("tacos-supplement-selected");
                        } else {
                            if ($(".tacos-supplement-selected").length < 1) {
                                //menu["supplements"]["supplement1"] = this.id;
                                this.classList.add("tacos-supplement-selected");
                            } else if ($(".tacos-supplement-selected").length == 1) {
                                // menu["supplements"]["supplement2"] = this.id;
                                this.classList.add("tacos-supplement-selected");
                            }
                        }
                    }
                }
                if ((this.className).includes("tacos-boisson")) {
                    tabtacosBoisson = document.getElementsByClassName("tacos-boisson");
                    for (let i = 0; i < tabtacosBoisson.length; i++) {
                        tabtacosBoisson[i].classList.remove("boisson-selected");
                    }
                    this.classList.add("boisson-selected");
                }
            }

        })
    }

    function genererMenuJSON() {
        if (document.getElementsByClassName("size-selected")[0] &&
            document.getElementsByClassName("tacos-viande-selected")[0] &&
            document.getElementsByClassName("tacos-sauce-selected")[0] &&
            document.getElementsByClassName("boisson-selected")[0]) {
            menu["name"] = document.getElementById("name").value;
            menu["size"] = document.getElementsByClassName("size-selected")[0].id;
            menu["viandes"]["viande1"] = document.getElementsByClassName("tacos-viande-selected")[0].id;
            if (document.getElementsByClassName("tacos-viande-selected")[1]) {
                menu["viandes"]["viande2"] = document.getElementsByClassName("tacos-viande-selected")[1].id;
            }
            if (document.getElementsByClassName("tacos-viande-selected")[2]) {
                menu["viandes"]["viande3"] = document.getElementsByClassName("tacos-viande-selected")[2].id;
            }
            menu["sauce"] = document.getElementsByClassName("tacos-sauce-selected")[0].id;
            if (document.getElementsByClassName("tacos-supplement-selected")[0]) {
                menu["supplements"]["supplement1"] = document.getElementsByClassName("tacos-supplement-selected")[0].id;
            }
            if (document.getElementsByClassName("tacos-supplement-selected")[1]) {
                menu["supplements"]["supplement2"] = document.getElementsByClassName("tacos-supplement-selected")[1].id;
            }
            menu["boisson"] = document.getElementsByClassName("boisson-selected")[0].id
            console.log(menu);
            commande.push(menu);
            resetMenu();
            document.getElementById("preview").style.display = "block";
            slotPreview = document.getElementsByClassName("previewMenu");
            for (let i = 0; i < slotPreview.length; i++) {
                slotPreview[i].innerHTML += menu["name"] + '<br><a href="#"><span class="text-center">' + formatCommande(commande) + '</span><img class ="image" style="max-height:200px;max-width:200px;"></a>';
            }
            imgFile = document.getElementById("picture");
            previewPicture(imgFile);
        } else {
            alert("Recette incomplette");
        }
    }

    function resetMenu() {
        menu = {
            "name": "",
            "size": "",
            "viandes": {
                "viande1": "",
                "viande2": "",
                "viande3": ""
            },
            "sauce": "",
            "supplements": {
                "supplement1": "",
                "supplement2": ""
            },
            "boisson": ""
        };
        let tabTacosSize = document.getElementsByClassName("tacos-size");
        for (let i = 0; i < tabTacosSize.length; i++) {
            tabTacosSize[i].classList.remove("size-selected");
        }
        let tabTacosViande = document.getElementsByClassName("tacos-viande");
        for (let i = 0; i < tabTacosViande.length; i++) {
            tabTacosViande[i].classList.remove("tacos-viande-selected");
        }
        let tabTacosSauce = document.getElementsByClassName("tacos-sauce");
        for (let i = 0; i < tabTacosSauce.length; i++) {
            tabTacosSauce[i].classList.remove("tacos-sauce-selected");
        }
        let tabTacosSupplement = document.getElementsByClassName("tacos-supplement");
        for (let i = 0; i < tabTacosSupplement.length; i++) {
            tabTacosSupplement[i].classList.remove("tacos-supplement-selected");
        }
        let boisson = document.getElementsByClassName("boisson-selected");
        boisson[0].classList.remove("boisson-selected");
    }



    function showPanier() {
        var lePanier = document.getElementById("panier");
        var panierContent = document.getElementById("content");
        if ((lePanier.className).includes("panier_fermee")) {
            lePanier.classList.remove("panier_fermee");
            lePanier.classList.add("panier_ouvert");
            panierContent.innerHTML = formatCommande(commande);
        } else {
            lePanier.classList.remove("panier_ouvert");
            lePanier.classList.add("panier_fermee");
            panierContent.innerHTML = "<small>R<br>E<br>C<br>E<br>T<br>T<br>E</small>";
        }
    }

    function formatCommande(commande) {
        var strgCommande = "";
        console.log(commande);
        /*commande = [{ //debug
            "size": "M",
            "viandes": {
                "viande1": "poulit",
                "viande2": "",
                "viande3": ""
            },
            "sauce": "algé",
            "supplements": {
                "supplement1": "fromage",
                "supplement2": ""
            },
            "boisson": "eau"
        }];*/
        for (let i = 0; i < commande.length; i++) {
            strgCommande += "<strong>" + commande[i]["name"] + "</strong>" +
                "<br>Size: " + commande[i]["size"] + "<br>Viandes: ";
            for (let j = 0; j < 2; j++) {
                if (commande[i]["viandes"]["viande" + (j + 1)]) {
                    strgCommande += commande[i]["viandes"]["viande" + (j + 1)];
                }
            };
            strgCommande += "<br>Sauce: " + commande[i]["sauce"] + "<br>Supplements: ";
            for (let h = 0; h < 1; h++) {
                if (commande[i]["supplements"]["supplement" + (h + 1)]) {
                    strgCommande += commande[i]["supplements"]["supplement" + (h + 1)];
                }
            };
            strgCommande += "<br>Boisson: " + commande[i]["boisson"] + "<br><br>";
        }
        return strgCommande;
    }

    function sidebar_open() {
        document.getElementById("mySidebar").style.display = "block";
    }

    function sidebar_close() {
        document.getElementById("mySidebar").style.display = "none";
    }


    var images = document.getElementsByClassName("image");
    // La fonction previewPicture
    var previewPicture = function(e) {

        // e.files contient un objet FileList
        const [picture] = e.files

        // "picture" est un objet File
        if (picture) {

            // L'objet FileReader
            var reader = new FileReader();

            // L'événement déclenché lorsque la lecture est complète
            reader.onload = function(e) {
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
</script>

</html>