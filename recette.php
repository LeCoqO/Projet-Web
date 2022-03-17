<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="author" content="Diego TORRES" />
    <link href="style.css" rel="stylesheet">
    <script src="script_bdd.js"></script>
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
    <h1 class="text-center">
        <img src="./img/logo.jpg" class="logo" alt="" />
    </h1>
</header>

<body>
    <p class="text-center">
        <button onclick="liste_open()">Liste des recettes</button>
        <button onclick="creation_open()">Ajout d'une recette</button>
    </p>
    <div id="panier" class="panier_fermee" onclick="showPanier()">
        <p id="content" class="text-center">
            <small>R<br>E<br>C<br>E<br>T<br>T<br>E</small>
        </p>
    </div>



    <div class="container content-container">
        <main id="main">
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
        <main id="main2" style="display: none; width: 100%">
            <h2 class="text-center">Création d'un menu:</h2>
            <div class="left" style="margin-left: 18%;">
                <h2>Nom du menu</h2>
                <input class="text-center" type="text" id="name" name="name" required pain="10">
            </div>

            <div class="half left" style="margin-left: 15%;">
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
                    <h2 class="small text-center">Choisissez le pain</h2>
                    <h3 class="text-center burger_pain" id="Pain Sésame">
                        Pain Sésame
                    </h3>
                    <h3 class="text-center burger_pain" id="Pain Blé">
                        Pain Blé
                    </h3>
                </article>
            </section>
            <section class="left">
                <article class="left">
                    <h2 class="small text-center">Choisissez vos ingrédients <br /> principaux</h2>
                    <h3 class="text-center burger-viande" id="Filet de poulet nature ou mariné">
                        Filet de poulet nature ou mariné
                    </h3>
                    <h3 class="text-center burger-viande" id="Viande hachée">
                        Viande hachée
                    </h3>
                    <h3 class="text-center burger-viande" id="Cordon Bleu">
                        Cordon Bleu
                    </h3>
                    <h3 class="text-center burger-viande" id="Nuggets">
                        Nuggets
                    </h3>
                    <h3 class="text-center burger-viande" id="Merguez">
                        Merguez
                    </h3>
                    <h3 class="text-center burger-viande" id="Tenders">
                        Tenders
                    </h3>
                    <h3 class="text-center burger-viande" id="Falafels">
                        Falafels
                    </h3>
                </article>
            </section>

            <section class="left">
                <article class="col-md-6 d-flex flex-column justify-content-center">
                    <h2 class="small text-center">Choisissez vos ingrédients <br />secondaires</h2>
                    <h3 class="text-center burger-sauce" id="Algerienne">
                        Algerienne
                    </h3>
                    <h3 class="text-center burger-sauce" id="Barbecue">
                        Barbecue
                    </h3>
                    <h3 class="text-center burger-sauce" id="Burger">
                        Burger
                    </h3>
                    <h3 class="text-center burger-sauce" id="Chili thai">
                        Chili thai
                    </h3>
                    <h3 class="text-center burger-sauce" id="Ketchup">
                        Ketchup
                    </h3>
                    <h3 class="text-center burger-sauce" id="Mayonnaise">
                        Mayonnaise
                    </h3>
                    <h3 class="text-center burger-sauce" id="Fuego">
                        Fuego
                    </h3>
                </article>
            </section>
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
        </main>

    </div>

</body>
<script>
    var menu = {
        "name": "",
        "pain": "",
        "viandes": {
            "viande1": "",
            "viande2": "",
            "viande3": ""
        },
        "sauce": "",
    };
    var commande = [];

    for (var i = 0; i < $("h3").length; i++) {
        $("h3")[i].addEventListener('click', function(e) {
            if ((this.className).includes("burger_pain")) {
                tabburgerpain = document.getElementsByClassName("burger_pain");
                for (let i = 0; i < tabburgerpain.length; i++) {
                    tabburgerpain[i].classList.remove("pain-selected");
                }
                this.classList.add("pain-selected");
            }
            if (document.getElementsByClassName("pain-selected")[0]) {
                if ((this.className).includes("burger-viande")) {
                    if ((this.className).includes("burger-viande-selected")) {
                        this.classList.remove("burger-viande-selected");
                    }
                    this.classList.add("burger-viande-selected");
                }
                if ((this.className).includes("burger-sauce")) {
                    if (document.getElementsByClassName("burger-viande-selected")[0]) {
                        if ((this.className).includes("burger-sauce-selected")) {
                            this.classList.remove("burger-sauce-selected");
                        } else {
                            let tabburgerSauce = document.getElementsByClassName("burger-sauce");
                            for (let i = 0; i < tabburgerSauce.length; i++) {
                                tabburgerSauce[i].classList.remove("burger-sauce-selected");
                            }
                            this.classList.add("burger-sauce-selected");
                        }
                    }
                }

            }

        })
    }

    function genererMenuJSON() {
        if (document.getElementsByClassName("pain-selected")[0] &&
            document.getElementsByClassName("burger-viande-selected")[0] &&
            document.getElementsByClassName("burger-sauce-selected")[0]) {
            menu["name"] = document.getElementById("name").value;
            menu["pain"] = document.getElementsByClassName("pain-selected")[0].id;
            menu["viandes"]["viande1"] = document.getElementsByClassName("burger-viande-selected")[0].id;
            if (document.getElementsByClassName("burger-viande-selected")[1]) {
                menu["viandes"]["viande2"] = document.getElementsByClassName("burger-viande-selected")[1].id;
            }
            if (document.getElementsByClassName("burger-viande-selected")[2]) {
                menu["viandes"]["viande3"] = document.getElementsByClassName("burger-viande-selected")[2].id;
            }
            menu["sauce"] = document.getElementsByClassName("burger-sauce-selected")[0].id;
            if (document.getElementsByClassName("burger-supplement-selected")[0]) {
                menu["supplements"]["supplement1"] = document.getElementsByClassName("burger-supplement-selected")[0].id;
            }
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
            "pain": "",
            "viandes": {
                "viande1": "",
                "viande2": "",
                "viande3": ""
            },
            "sauce": "",

        };
        let tabburgerpain = document.getElementsByClassName("burger_pain");
        for (let i = 0; i < tabburgerpain.length; i++) {
            tabburgerpain[i].classList.remove("pain-selected");
        }
        let tabburgerViande = document.getElementsByClassName("burger-viande");
        for (let i = 0; i < tabburgerViande.length; i++) {
            tabburgerViande[i].classList.remove("burger-viande-selected");
        }
        let tabburgerSauce = document.getElementsByClassName("burger-sauce");
        for (let i = 0; i < tabburgerSauce.length; i++) {
            tabburgerSauce[i].classList.remove("burger-sauce-selected");
        }
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
            "pain": "M",
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
                "<br>pain: " + commande[i]["pain"] + "<br>Viandes: ";
            for (let j = 0; j < 2; j++) {
                if (commande[i]["viandes"]["viande" + (j + 1)]) {
                    strgCommande += commande[i]["viandes"]["viande" + (j + 1)];
                }
            };
            strgCommande += "<br>Sauce: " + commande[i]["sauce"];
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

    function creation_open() {
        document.getElementById("main").style.display = "none";
        document.getElementById("main2").style.display = "block";

    }

    function liste_open() {
        document.getElementById("main").style.display = "block";
        document.getElementById("main2").style.display = "none";
    }
</script>

</html>