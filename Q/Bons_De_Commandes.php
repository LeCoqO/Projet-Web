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
            <div>
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
                <hr>
                <div id="parent" class="clear">
                </div>


                <script>
                    var laFonction = $.ajax({
                        url: 'STOCK_REQUETE.php', //toujours la même page qui est appelée
                        type: 'POST',
                        data: {
                            fonction: 'select', //fonction à executer
                            requete: 'SELECT * FROM commandefournisseur', //On a besoin de TOUS les champs de commandefournisseur, d'ou l'utilisation du * 
                        }
                    });

                    laFonction.done(function(msg) {
                        let resultats = JSON.parse(msg);
                        let resultats2;
                        let autreReq = [];

                        for (var IdIng in resultats) {
                            autreReq.push(IdIng);
                        }

                        var laFonction2 = $.ajax({
                            url: 'STOCK_REQUETE.php', //toujours la même page qui est appelée
                            type: 'POST',
                            data: {
                                fonction: 'select', //fonction à executer
                                requete: 'SELECT NomIng,IdIng,Unite,PrixUHT_Moyen AS PUHT FROM ingredient WHERE IdIng IN (SELECT IdIng FROM commandefournisseur)',
                            }
                        });
                        laFonction2.done(function(msg2) {
                            resultats2 = JSON.parse(msg2);
                            for (i = 0; i < resultats.length; i++) {

                                let laCommande = document.createElement('article');
                                let h3 = document.createElement('h3');
                                let button = document.createElement('button');
                                let tousLesChamps = document.createElement('div');
                                let dateE = document.createElement('div');
                                let dateL = document.createElement('div');
                                let ing = document.createElement('div');
                                let qte = document.createElement('div');
                                let fourn = document.createElement('div');
                                let prix = document.createElement('div');

                                button.innerHTML = "link text";
                                dateE.innerHTML = "Date d'émission : " + resultats[i]['DateComFourn'];
                                dateL.innerHTML = "Date livraison prévue : " + resultats[i]['DateLivFourn'];
                                ing.innerHTML = resultats2[i]['NomIng'];
                                qte.innerHTML = resultats[i]['QteComFourn'] + ' ' + resultats2[i]['Unite'];
                                fourn.innerHTML = resultats[i]['NomFourn'];
                                prix.innerHTML = 'PRIX TOTAL HT : ' + resultats[i]['QteComFourn'] * resultats2[i]['PUHT'] + ' €';

                                laCommande.className = 'left';
                                button.id = 'PDF' + resultats[i]['IdComFourn'];
                                button.href = "https://www.google.com/";
                                button.className = 'button toPDF'
                                tousLesChamps.className = 'bonCompact';
                                dateE.className = 'left';
                                dateL.className = 'right';
                                ing.className = 'clear left';
                                qte.className = 'right';
                                fourn.className = 'clear';
                                prix.className = 'text-center';

                                laCommande.appendChild(h3);
                                h3.appendChild(button);
                                tousLesChamps.appendChild(dateE);
                                tousLesChamps.appendChild(dateL);
                                tousLesChamps.appendChild(ing);
                                tousLesChamps.appendChild(qte);
                                tousLesChamps.appendChild(fourn);
                                tousLesChamps.appendChild(prix);
                                laCommande.appendChild(tousLesChamps);

                                button.addEventListener('click', event => {
                                    console.log(button.id); ///PDF
                                    $.ajax({
                                        url: 'PDF.php', //toujours la même page qui est appelée
                                        type: 'POST',
                                        data: ({
                                            infos: resultats
                                        }),
                                        /*data: {
                                            dateEmission: resultats[i]['DateComFourn'],
                                            dateLivraison: resultats[i]['DateLivFourn'],
                                            idIng: resultats[i]['IdIng'],
                                            nomIng: resultats2[i]['NomIng'],
                                            qteIng: resultats[i]['QteComFourn'],
                                            fournisseur: resultats[i]['NomFourn'],
                                            puht: resultats2[i]['PUHT'],
                                        },*/
                                        success: function(data) {
                                            alert('AJAX call was successful!');
                                        },
                                        error: function() {
                                            alert('There was some error performing the AJAX call!');
                                        },
                                    });
                                });
                                parent = document.getElementById('parent');
                                parent.appendChild(laCommande);
                            }
                            laFonction2.fail(function(dataSQL, statut) {
                                alert("error sqlConnect.js : " + dataSQL.erreur);
                            });
                            laFonction.fail(function(dataSQL, statut) {
                                alert("error sqlConnect.js : " + dataSQL.erreur);
                            });
                            /* 
                            let resultats = JSON.parse(msg);
                            selectIng = document.createElement('select');
                            selectIng[0] = new Option("--Ingrédient--", "", false, false);
                            for (i = 0; i < resultats.length; i++) {
                                selectIng[i + 1] = new Option(resultats[i]['NomIng'], resultats[i]['IdIng'], false, false);
                            };
                            selectIng.id = 'selectIng';
                            selectIng.class = 'column';
                            selectIng.onChange = 'appel(this.value)';
                            document.getElementById('requete').appendChild(selectIng);
                            */

                        });
                    });
                </script>
                </article>
            </div>
        </main>
    </div>
</body>

</html>