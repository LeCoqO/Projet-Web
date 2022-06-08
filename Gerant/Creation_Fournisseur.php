<!DOCTYPE html">
<html lang="fr">

<head>
    <title>Création Fournisseur</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="author" content="PAGE Lilian" />
    <meta name="description" content="Création Fournisseur" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css" />
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>

<body>
    <header>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        <!-- Navigation -->
        <div class="fixed-top">
            <nav class="navbar navbar-expand-lg navbar-dark mx-background-top-linear">
                <div class="container">
                    <a class="navbar-brand" style="text-transform: uppercase;">
                        Hom'Burger
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
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
                                <a class="nav-link" href="#">About</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Fruits</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Sea food</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Vegetables</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Blog</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Contact</a>
                            </li>
                        </ul>
                        <img class="imgNavbar" style="width: 50px;" src="./img/logo.png">
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <br><br><br><br><br><br>
    <fieldset class="Choix centrer">
        <form>
            <br>
            <div class="form__group field">
                <input type="input" class="form__field" placeholder="Nom" name="Nom" id='nom' required />
                <label for="nom" class="form__label">Nom : </label>
            </div>
            <div class="form__group field">
                <input class="form__field" type="text" placeholder="Adresse" id="adr" name="Adresse" value="" size="20"
                    maxlength="20" required>
                <label for="Adresse" class="form__label">Adresse : </label>
            </div>
            <div class="form__group field ">
                <input class="form__field" type="text" placeholder="CodePostal" id="post" name="CodePostal" value=""
                    size="20" maxlength="5" required>
                <label for="CodePostal" class="form__label">CodePostal : </label>
            </div>
            <div class=" form__group field">
                <input class="form__field" type="input" placeholder="Ville" name="Ville" id='ville' required />
                <label class="form__label" for="Ville">Ville : </label>
            </div>
            <div class="form__group field">
                <input class="form__field" type="tel" placeholder="Tel" id="tel" name="tel" pattern="[0-9]{10}"
                    maxlength="10" required>
                <label class="form__label" for="tel">Téléphone:</label>
                <br>
                <small>Format: 12 34 56 78 90</small>
            </div>
            <div class=" form__group field ">
                <input class="form__field" type="input" placeholder="Mail" name="Mail" id='Mail' required />
                <label class="form__label" for="Mail">Mail : </label>
            </div>
            <br>
            <div>
                <button class="button" onclick="nouveaufournisseur()">Envoyer</button>
                <button type="button" class="button"
                    onclick="location.href = 'Gestion_Fournisseur.php';">Retour</button>
            </div>
        </form>
    </fieldset>

    <script>
    function nouveaufournisseur() {
        $.ajax({
            url: 'STOCK_REQUETE.php', //toujours la même page qui est appelée
            type: 'POST',
            data: {
                fonction: 'Update', //fonction à executer
                rq: "INSERT INTO fournisseur (NomFourn, AdresseFourn, CPFourn, VilleFourn, TelFourn, MailFourn, DateArchivFourn) " +
                    "VALUE('" + document.getElementById("nom").value + "', '" + document.getElementById("adr")
                    .value + "', '" +
                    document.getElementById("post").value + "', '" + document.getElementById("ville").value +
                    "', '" +
                    document.getElementById("tel").value + "', '" + document.getElementById("Mail").value +
                    "', null)"
            },
            success: function(data) {
                console.log(data);

            },
            error: function(dataSQL, statut) {
                alert("error sqlConnect.js : " + dataSQL.erreur);
            }
        });

    }
    </script>
</body>

</html>