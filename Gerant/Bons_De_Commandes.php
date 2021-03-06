<?php
ob_start();
session_start();
if (!$_SESSION['valid']) {
    header('Location: login.php');
}
//pour reset: $_SESSION['valid']=false;
?>

<!DOCTYPE html>
<html lang="fr">


<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="author" content="LUSTIERE Quentin" />
    <link rel="stylesheet" href="../CSS/styleGerant.css">
    <link rel="stylesheet" href="../CSS/styleCommun.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css" />
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />
    <title>HOMBURGER - GERANT</title>

    <style>
        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        th,
        td {
            padding: 10px 20px;
            border: 1px solid #000;
        }
    </style>

</head>

<body>
    <header>
        <div class="fixed-top">
            <nav class="navbar navbar-expand-lg navbar-dark mx-background-top-linear">
                <div class="container">
                    <a class="navbar-brand" style="text-transform: uppercase">
                        Hom'Burger
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">
                                    Home
                                    <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../Accueil/">Acceuil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../Cuisine/">Cusinier</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../Gerant/">G??rant</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../Livreur/">Livreur</a>
                            </li>
                        </ul>
                        <img class="imgNavbar" src="../img/logo.png" />
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <br>
    <br>
    <br>


    <hr>
    <div class="container content-container">
        <main role="main">
            <section>
                <h2 class="text-center">Interface G??rant</h2>
                <div class="row text-center">
                    <div class="column2">
                        <button class="button" onclick=window.location.href='commande_fournisseur.php'>Retour</button>
                    </div>
                    <div class="column2">
                        <button class="button" id='supprimer'>Supprimer</button>
                    </div>
                </div>
            </section>
            <div class='clear'></div>
            <br>
            <div id="parent" class="clear">
            </div>
            <script>
                Date.prototype.addDays = function(days) { //Fonction pour les dates
                    var date = new Date(this.valueOf());
                    date.setDate(date.getDate() + days);
                    return date;
                }
                var date = new Date();
                //APPEL DE TTES LES DONNES NECESSAIRES A LA REDACTION D'UN BON DE COMMANDE, POINT DE VUE BON DE COMMANDE
                var laFonction = $.ajax({
                    url: '../STOCK_REQUETE.php', //toujours la m??me page qui est appel??e
                    type: 'POST',
                    data: {
                        fonction: 'select', //fonction ?? executer
                        requete: 'SELECT * FROM commandefournisseur ORDER BY IdIng ASC', //On a besoin de TOUS les champs de commandefournisseur, d'ou l'utilisation du * 
                    }
                });

                laFonction.done(function(msg) {
                    resultats = JSON.parse(msg);
                    var resultats
                    var resultats2;
                    var resultats3;
                    console.log(resultats);

                    for (let i = 0; i < resultats.length; i++) {
                        //APPEL DE TTES LES DONNES NECESSAIRES A LA REDACTION D'UN BON DE COMMANDE, POINT DE VUE FOURNISSEUR
                        var laFonction3 = $.ajax({
                            url: '../STOCK_REQUETE.php', //toujours la m??me page qui est appel??e
                            type: 'POST',
                            data: {
                                fonction: 'select', //fonction ?? executer
                                requete: 'SELECT NomFourn,AdresseFourn,CPFourn,VilleFourn,TelFourn,MailFourn FROM fournisseur WHERE (`NomFourn` = "' + resultats[i]['NomFourn'] + '");',
                            }
                        });
                        laFonction3.done(function(data) {
                            console.log('SELECT NomFourn,AdresseFourn,CPFourn,VilleFourn,TelFourn,MailFourn FROM fournisseur WHERE NomFourn = ' + resultats[i]['NomFourn'] + ';');
                            resultats3 = JSON.parse(data);
                            console.log('fourn');
                            console.log(resultats3);


                            //APPEL DE TTES LES DONNES NECESSAIRES A LA REDACTION D'UN BON DE COMMANDE, POINT DE VUE INGREDIENT
                            var laFonction2 = $.ajax({
                                url: '../STOCK_REQUETE.php', //toujours la m??me page qui est appel??e
                                type: 'POST',
                                data: {
                                    fonction: 'select', //fonction ?? executer
                                    requete: 'SELECT NomIng,IdIng,Unite,PrixUHT_Moyen AS PUHT FROM ingredient WHERE IdIng IN (SELECT IdIng FROM commandefournisseur);', // WHERE IdIng IN (SELECT IdIng FROM commandefournisseur)',
                                }
                            });

                            laFonction2.done(function(msg2) {
                                resultats2 = JSON.parse(msg2);
                                console.log(resultats2);
                                //AFFICHAGE DE CES DONNEES DE MANIERE STRUCTUREE DANS LA PAGE


                                affichageDiv(resultats, resultats2, resultats3, i);


                            });
                            laFonction2.fail(function(dataSQL, statut) {
                                alert("error sqlConnect.js : " + dataSQL.erreur);
                            });
                        });

                        laFonction3.fail(function(dataSQL, statut) {
                            alert("error sqlConnect.js : " + dataSQL.erreur);
                        });


                    }
                });
                laFonction.fail(function(dataSQL, statut) {
                    alert("error sqlConnect.js : " + dataSQL.erreur);
                });


                function affichageDiv($r1, $r2, $r3, $i) {
                    let resultats = $r1;
                    let resultats2 = $r2;
                    let resultats3 = $r3;
                    let i = $i;
                    console.log($r1);
                    console.log($r2);
                    console.log($r3);
                    console.log($i);
                    let laCommande = document.createElement('article');
                    let recapEtBouton = document.createElement('div');
                    let button = document.createElement('button');
                    let button2 = document.createElement('button');
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

                    button.innerHTML = "PDF";
                    button2.innerHTML = "Envoi du bon";
                    dateE.innerHTML = "Date d'??mission : " + resultats[i]['DateComFourn'];
                    dateL.innerHTML = "Date livraison pr??vue : " + resultats[i]['DateLivFourn'];
                    ing.innerHTML = resultats2[i]['NomIng'];
                    qte.innerHTML = resultats[i]['QteComFourn'] + ' ' + resultats2[i]['Unite'];
                    fourn.innerHTML = resultats3[0]['NomFourn'];
                    prix.innerHTML = 'PRIX TOTAL HT : ' + resultats[i]['QteComFourn'] * resultats2[i]['PUHT'] + ' ???';

                    console.log(resultats);
                    console.log(resultats2);
                    console.log(resultats3);

                    laCommande.className = 'left container centered-element commande';
                    button.id = i; //resultats[i]['IdComFourn']
                    button2.className = 'button toPDF left'
                    button2.id = i; //resultats[i]['IdComFourn']
                    button.className = 'button toPDF left'
                    tousLesChamps.className = 'bonCompact';
                    dateE.className = 'left';
                    dateL.className = 'right';
                    ing.className = 'clear left';
                    qte.className = 'right';
                    fourn.className = 'clear';
                    prix.className = 'text-center';
                    clear.className = 'clear';
                    input.type = 'checkbox';
                    input.className = 'checkbox';
                    laCheck.className = 'right vertical-center';
                    input.id = resultats[i]['IdIng'] + "ID";

                    tousLesChamps.appendChild(dateE);
                    tousLesChamps.appendChild(dateL);
                    tousLesChamps.appendChild(ing);
                    tousLesChamps.appendChild(qte);
                    tousLesChamps.appendChild(fourn);
                    tousLesChamps.appendChild(prix);
                    recapEtBouton.appendChild(tousLesChamps);
                    recapEtBouton.appendChild(button);
                    recapEtBouton.appendChild(button2);
                    laCheck.appendChild(input);
                    laCommande.appendChild(recapEtBouton)
                    laCommande.appendChild(laCheck);
                    parent = document.getElementById('parent');
                    parent.appendChild(laCommande);
                    parent.appendChild(clear);

                    button.addEventListener('click', event => {
                        i = button.id;
                        var dateLiv = new Date(resultats[i]['DateLivFourn'].substr(0, 4),
                            resultats[i]['DateLivFourn'].substr(5, 2) - 1, resultats[i][
                                'DateLivFourn'
                            ].substr(8, 2)
                        ); //POIR LES MOIS, il faut -1 car ils vont de 0 ?? 11.
                        var dateCom = new Date(resultats[i]['DateComFourn'].substr(0, 4),
                            resultats[i]['DateComFourn'].substr(5, 2) - 1, resultats[i][
                                'DateComFourn'
                            ].substr(8, 2)
                        ); //POIR LES MOIS, il faut -1 car ils vont de 0 ?? 11.
                        if (dateLiv < date || dateCom.addDays(30) < date) { //TEST DE LA COMMANDE (30J  MAX)
                            alert(
                                'Commande trop ancienne, merci d\'en g??nerer une nouvelle'
                            );
                        } else { //APPEL DE LA CLASSE PDF, GENERANT DES PDF
                            console.log(resultats[i]);
                            console.log(resultats2[i]);
                            console.log(resultats3[0]);

                            $.ajax({
                                url: 'PDF.php', //toujours la m??me page qui est appel??e
                                type: 'POST',
                                data: ({
                                    commandefournisseur: resultats[i],
                                    ingredient: resultats2[i],
                                    indexIng: i,
                                    id: 'PDF' + resultats[i]['IdComFourn'],
                                    fournisseur: resultats3[0]
                                }),
                                success: function(data) {},
                                error: function() {
                                    alert(
                                        'There was some error performing the AJAX call!'
                                    );
                                },
                            });
                            setTimeout(function() {
                                    javascipt: window.open('commandes/PDF' + resultats[i]['IdComFourn'] + '.pdf');
                                },
                                500
                            ); //On attend 500ms avant d'ouvrir le PDF, le temps que se dernier se g??n??re/mette ?? jour
                        }
                    })

                    button2.addEventListener('click', event => {
                        i = button2.id;
                        var dateLiv = new Date(resultats[i]['DateLivFourn'].substr(0, 4),
                            resultats[i]['DateLivFourn'].substr(5, 2) - 1, resultats[i][
                                'DateLivFourn'
                            ].substr(8, 2)
                        ); //POIR LES MOIS, il faut -1 car ils vont de 0 ?? 11.
                        var dateCom = new Date(resultats[i]['DateComFourn'].substr(0, 4),
                            resultats[i]['DateComFourn'].substr(5, 2) - 1, resultats[i][
                                'DateComFourn'
                            ].substr(8, 2)
                        ); //POIR LES MOIS, il faut -1 car ils vont de 0 ?? 11.
                        if (dateLiv < date || dateCom.addDays(30) < date) { //TEST DE LA COMMANDE (30J  MAX)
                            alert(
                                'Commande trop ancienne, merci d\'en g??nerer une nouvelle'
                            );
                        } else { //APPEL DE LA CLASSE PDF, GENERANT DES PDF
                            console.log(resultats[i]);
                            console.log(resultats2[i]);
                            console.log(resultats3[0]);

                            $.ajax({
                                url: 'envoi_mail.php', //toujours la m??me page qui est appel??e
                                type: 'POST',
                                data: ({
                                    id: 'PDF' + resultats[i]['IdComFourn'],
                                    fournisseur: resultats3[0]
                                }),
                                success: function(data) {
                                    alert('Bon de commande envoy??');
                                },
                                error: function() {
                                    alert(
                                        'There was some error performing the AJAX call!'
                                    );
                                },
                            });
                        }
                    })
                }







                //ENVOI DES BONS DE COMMANDE, PUIS RECHARGEMENT DE LA PAGE
                // -----------------------OBSOLETE------------------------------
                /*document.getElementById('commander').addEventListener('click', event => {
                    var selection = false;
                    $(".checkbox").each(function() {
                        console.log($(this).is(":checked"));
                        if ($(this).is(":checked")) {
                            selection = true;
                            alert('Fonctionnalit?? pas encore disponible.');
                            /*$.ajax({
                                url: 'mailSender.php', //toujours la m??me page qui est appel??e
                                type: 'POST',
                                data: {
                                    fournisseurMail: resultats[$(this).attr('id').replace('bis',
                                        '')]['MailFourn'], //fonction ?? executer
                                    commandeID: resultats[$(this).attr('id').replace('bis', '')][
                                        'IdComFourn'
                                    ],
                                },
                                success: function(data) {
                                    console.log('Coooool');
                                },
                                error: function(dataSQL, statut) {
                                    alert("error sqlConnect.js : " + dataSQL.erreur);
                                }
                            })
                        }
                    })

                    if (!selection) {
                        alert('Veuillez s??l??ctionner une ou plusieures commande(s)');
                    }

                    setTimeout(function() {
                        window.location.reload()
                    }, 100);
                });*/

                //SUPPRESSION DES BONS DE COMMANDE, DE LA BASE PUIS RECHARGEMENT DE LA PAGE
                document.getElementById('supprimer').addEventListener('click', event => {
                    var selection = false;
                    $(".checkbox").each(function() {
                            console.log($(this).is(":checked"));
                            if ($(this).is(":checked")) {
                                selection = true; //VERIFICATION QU'IL Y A AU MOINS UNE SELECTION
                                console.log('DELETE FROM commandefournisseur WHERE IdComFourn = ' +
                                    $(this).attr('id').replace('ID', '') + ';');
                                $.ajax({ //SUPPRESSION DE LA COMMANDE DE LA BASE
                                    url: '../STOCK_REQUETE.php', //toujours la m??me page qui est appel??e
                                    type: 'POST',
                                    data: {
                                        fonction: 'update', //fonction ?? executer
                                        requete: 'DELETE FROM commandefournisseur WHERE IdIng = ' +
                                            $(this).attr('id').replace('ID', '') + ';'
                                    },
                                    success: function(data) {},
                                    error: function(dataSQL, statut) {
                                        alert("error sqlConnect.js : " + dataSQL.erreur);
                                    }
                                })
                            }
                        }

                    )

                    if (!selection) { //SI AUCUNE COMMANDE SELECTIONNEE ... 
                        alert('Veuillez s??l??ctionner une ou plusieures commande(s)');
                    }
                    //RECHARGEMENT DE LA PAGE
                    setTimeout(function() {
                        window.location.reload()
                    }, 100);
                });
            </script>
            </article>
        </main>
    </div>
    <footer class="mt-auto footer-basic fixed-bottom">
        <div class="social">
            <a href="https://www.instagram.com/_hom_burger_/?hl=fr">
                <i class="fa fa-instagram" aria-hidden="true"></i>

            </a>
            <a href="https://twitter.com/hom_burger">
                <i class="fa fa-twitter"></i>
            </a>
        </div>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Home</a></li>
            <li class="list-inline-item">
                <a href="equipe.html">Notre ??quipe</a>
            </li>
            <li class="list-inline-item"><a href="#">A propos</a></li>
            <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
        </ul>
        <p class="copyright">Hom'Burger ?? 2022</p>
    </footer>
</body>

</html>