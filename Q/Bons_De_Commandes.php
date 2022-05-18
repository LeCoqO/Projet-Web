<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="author" content="Diego TORRES" />
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>BulgarKing</title>
</head>
<header>
    <div class="sidebar" id="mySidebar">
        <button class="bar-item button" onclick="sidebar_close()">Close &times;</button>
        <a href="commande.php" class="bar-item button">Commande</a><br>
        <a href="recette.php" class="bar-item button">Link 2</a><br>
        <a href="#" class="bar-item button">Link 3</a>
    </div>
    <button class="button left hide-large" onclick="sidebar_open()">&#9776;</button>
    <h1 class="text-center ">
        <img src="img/logo.png" class="logo" alt="" />
    </h1>

</header>

<body>
    <hr>
    <div class="container content-container">
        <main role="main">
            <section>
                <h2 class="text-center">Interface Gérant</h2>
                <div class="row text-center">
                    <div class="column">
                        <button class="button" onclick=window.location.href='commande_fournisseur.php'>Retour</button>
                    </div>
                    <div class="column">
                        <button class="button" onclick=window.location.href=''>Commander</button>
                    </div>
                    <div class="column">
                        <button class="button" onclick=window.location.href=''>Supprimer</button>
                    </div>
                </div>
            </section>
            <div class='clear'></div>



            <br>
            <!--<div>
                <article>
                    <div class="left">
                        <h3><a href="" id="PDF">link text</a></h3>
                        <div class="bonCompact">
                            <div class="left">Date d'émission : XX/XX/XXXX</div>
                            <div class="right">Date livraison prévue : XX/XX/XXXX</div>
                            <div class="clear left">Nom Ingrédient</div>
                            <div class=right>Quantité Unité</div><br>
                            <div class="clear">Fournisseur</div>
                            <div class="text-center">
                                PRIX TOTAL HT : XXX€
                            </div>
                        </div>
                    </div>
                    <div class="right vertical-center">
                        <input class="" type="checkbox" checked>
                    </div>
                </article>
                <br>
                <br>
                <hr>-->
            <div id="parent" class="clear">
            </div>


            <script>
                Date.prototype.addDays = function(days) { //Fonction pour les dates
                    var date = new Date(this.valueOf());
                    date.setDate(date.getDate() + days);
                    return date;
                }

                var date = new Date();
                console.log(date);
                var resultats
                var resultats2;
                var resultats3;
                var laFonctionn = $.ajax({
                    url: 'STOCK_REQUETE.php', //toujours la même page qui est appelée
                    type: 'POST',
                    data: {
                        fonction: 'select', //fonction à executer
                        requete: 'SELECT NomFourn,AdresseFourn,CPFourn,VilleFourn,TelFourn FROM fournisseur',
                    }
                });
                laFonctionn.done(function(data) {
                    resultats3 = JSON.parse(data);
                });
                laFonctionn.fail(function(dataSQL, statut) {
                    alert("error sqlConnect.js : " + dataSQL.erreur);
                });

                var laFonction = $.ajax({
                    url: 'STOCK_REQUETE.php', //toujours la même page qui est appelée
                    type: 'POST',
                    data: {
                        fonction: 'select', //fonction à executer
                        requete: 'SELECT * FROM commandefournisseur', //On a besoin de TOUS les champs de commandefournisseur, d'ou l'utilisation du * 
                    }
                });

                laFonction.done(function(msg) {
                    resultats = JSON.parse(msg);
                    let autreReq = [];
                    for (var IdIng in resultats) {
                        autreReq.push(IdIng);
                    }

                    var laFonction2 = $.ajax({
                        url: 'STOCK_REQUETE.php', //toujours la même page qui est appelée
                        type: 'POST',
                        data: {
                            fonction: 'select', //fonction à executer
                            requete: 'SELECT NomIng,IdIng,Unite,PrixUHT_Moyen AS PUHT FROM ingredient', // WHERE IdIng IN (SELECT IdIng FROM commandefournisseur)',
                        }
                    });
                    laFonction2.done(function(msg2) {
                        resultats2 = JSON.parse(msg2);
                        for (i = 0; i < resultats.length; i++) {

                            let laCommande = document.createElement('article');
                            let recapEtBouton = document.createElement('div');
                            let button = document.createElement('button');
                            let tousLesChamps = document.createElement('div');
                            let dateE = document.createElement('div');
                            let dateL = document.createElement('div');
                            let ing = document.createElement('div');
                            let qte = document.createElement('div');
                            let fourn = document.createElement('div');
                            let prix = document.createElement('div');
                            let clear = document.createElement('div');
                            let laCheck = document.createElement('div');
                            let input = document.createElement('input');

                            button.innerHTML = "link text";
                            dateE.innerHTML = "Date d'émission : " + resultats[i]['DateComFourn'];
                            dateL.innerHTML = "Date livraison prévue : " + resultats[i]['DateLivFourn'];
                            ing.innerHTML = resultats2[i]['NomIng'];
                            qte.innerHTML = resultats[i]['QteComFourn'] + ' ' + resultats2[i]['Unite'];
                            fourn.innerHTML = resultats[i]['NomFourn'];
                            prix.innerHTML = 'PRIX TOTAL HT : ' + resultats[i]['QteComFourn'] * resultats2[i]['PUHT'] + ' €';

                            laCommande.className = 'left container centered-element commande';
                            button.id = i; //resultats[i]['IdComFourn']
                            button.className = 'button toPDF left'
                            tousLesChamps.className = 'bonCompact';
                            dateE.className = 'left';
                            dateL.className = 'right';
                            ing.className = 'clear left';
                            qte.className = 'right';
                            fourn.className = 'clear';
                            prix.className = 'text-center';
                            clear.className = 'clear';
                            input.id = i + 'bis';
                            input.type = 'checkbox';
                            laCheck.className = 'right vertical-center';

                            tousLesChamps.appendChild(dateE);
                            tousLesChamps.appendChild(dateL);
                            tousLesChamps.appendChild(ing);
                            tousLesChamps.appendChild(qte);
                            tousLesChamps.appendChild(fourn);
                            tousLesChamps.appendChild(prix);
                            recapEtBouton.appendChild(tousLesChamps);
                            recapEtBouton.appendChild(button);
                            laCheck.appendChild(input);
                            laCommande.appendChild(recapEtBouton)
                            laCommande.appendChild(laCheck);
                            parent = document.getElementById('parent');
                            parent.appendChild(laCommande);
                            parent.appendChild(clear);
                            button.addEventListener('click', event => {
                                i = button.id;
                                var dateLiv = new Date(resultats[i]['DateLivFourn'].substr(0, 4), resultats[i]['DateLivFourn'].substr(5, 2) - 1, resultats[i]['DateLivFourn'].substr(8, 2)); //POIR LES MOIS, il faut -1 car ils vont de 0 à 11.
                                var dateCom = new Date(resultats[i]['DateComFourn'].substr(0, 4), resultats[i]['DateComFourn'].substr(5, 2) - 1, resultats[i]['DateComFourn'].substr(8, 2)); //POIR LES MOIS, il faut -1 car ils vont de 0 à 11.
                                if (dateLiv < date || dateCom.addDays(30) < date) {
                                    alert('Commande trop ancienne, merci d\'en génerer une nouvelle');
                                } else {
                                    $.ajax({
                                        url: 'PDF.php', //toujours la même page qui est appelée
                                        type: 'POST',
                                        data: ({
                                            commandefournisseur: resultats,
                                            ingredient: resultats2,
                                            id: 'PDF' + resultats[i]['IdComFourn'],
                                            fournisseur: resultats3
                                        }),
                                        success: function(data) {},
                                        error: function() {
                                            alert('There was some error performing the AJAX call!');
                                        },
                                    });
                                    setTimeout(function() {
                                        javascipt: window.open('commandes/PDF' + resultats[i]['IdComFourn'] + '.pdf');
                                    }, 500); //On attend 500ms avant d'ouvrir le PDF, le temps que se dernier se génère/mette  à jour
                                }
                            });
                        }
                        laFonction2.fail(function(dataSQL, statut) {
                            alert("error sqlConnect.js : " + dataSQL.erreur);
                        });
                        laFonction.fail(function(dataSQL, statut) {
                            alert("error sqlConnect.js : " + dataSQL.erreur);
                        });
                    });
                });
            </script>
            </article>
    </div>
    </main>
    </div>
</body>

</html>