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
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title>HOMBURGER - GERANT</title>
</head>
<header>
  <div class="sidebar" id="mySidebar">
    <button class="bar-item button" onclick="sidebar_close()">Close &times;</button>
    <br /><a href="#" class="bar-item button">Accueil</a>
    <br /><a href="livreur.php" class="bar-item button">Livreur</a>
    <br /><a href="mentionLegale.html" class="bar-item button">Mention légale</a>
  </div>
  <button class="button left hide-large" onclick="sidebar_open()">&#9776;</button>
  <h1 class="text-center ">
    <img src="./img/logo.png" class="logo" alt="" />
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
            <button class="button" onclick=window.location.href='Statistique.php'>Statistiques</button>
          </div>
          <div class="column">
            <button class="button" onclick=window.location.href='Consult_Stocks.php'>Stocks</button>
          </div>
          <div class="column">
            <button class="button" onclick=window.location.href=''>Recettes</button>
          </div>
        </div>
      </section>
    </main>
  </div>
  <div class="footer-basic">
    <footer>
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
          <a href="equipe.html">Notre équipe</a>
        </li>
        <li class="list-inline-item"><a href="#">A propos</a></li>
        <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
      </ul>
      <p class="copyright">Hom'Burger © 2022</p>
    </footer>
  </div>
</body>

</html>