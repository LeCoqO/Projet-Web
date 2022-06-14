<?php

$fonction = $_POST['fonction'];
unset($_POST['fonction']);
$fonction($_POST);

function select($args){
    $requete = $args['requete'];
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=homburger','root','');
        $pdo -> exec("set names utf8");
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage() . '<br />';
        echo 'N° : ' . $e->getCode();
        die();
    }
    $statement = $pdo->query($requete);;
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($results);
    echo $json;
}

function update($args){
    $requete = $args['requete'];
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=homburger','root','');
        $pdo -> exec("set names utf8");
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage() . '<br />';
        echo 'N° : ' . $e->getCode();
        die();
    }
    $statement = $pdo->prepare($requete);
    $statement->execute();
  if($statement){
    echo 'Les données ont bien été mises à jour';
  }else{
    echo "Une erreur est survenue !";
  }
}

function insert($args){
    $requete = $args['requete'];
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=homburger','root','');
        $pdo -> exec("set names utf8");
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage() . '<br />';
        echo 'N° : ' . $e->getCode();
        die();
    }
    $statement = $pdo->prepare($requete);
    $statement->execute();
  if($statement){
    echo 'Les données ont bien été insérés';
  }else{
    echo "Une erreur est survenue !";
  }
}

function selectProduit2Bdd($args)
{
    $table = $args['table'];
    $base = $args['base'];
    $condition = $args['selectCondition'];
    $whereValue =  $args['whereValue'];
    //require_once '../connexion.php';
    try {
        $connex = new PDO(
            'mysql:host=' . 'localhost' .
                ';dbname=' . $base,
            'root',
            '',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage() . '<br />';
        echo 'N° : ' . $e->getCode();
        die();
    }
    $connex->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
    $connex->beginTransaction(); //début
    $rq = "SELECT $condition FROM $table " . $whereValue;
    $result = $connex->query($rq);
    foreach ($result as $element) {
        echo '<div id="' . $element['IdProd'] . '|' . $element['NomProd'] . '|' . $element['PrixUHT'] . '|' . $element['Taille'] . '|' . $element['IngBase1'] . '|' . $element['IngBase2'] . '|' . $element['IngBase3'] . '|' . $element['IngBase4'] . '|' . $element['IngOpti1'] . '|' . $element['IngOpti2'] . '|' . $element['IngOpti3'] . '|' . $element['IngOpti4'] . '" class="item">            
                <img src="' . $element['Image'] . '">' .
            '<div class="item-infos">' .
            '<h3>' . $element['NomProd'] . '</h3>' .
            '<hr>
                    <p>';
        for ($j = 1; $j < intval($element['NbIngBase']) + 1; $j++) {
            printf($element['IngBase' . $j] . ", ");
        }
        echo '</p>' .
            '<p class="taille">Taille :  ' . $element['Taille'] . '</p>' .
            '</p>' .
            '<p class="prix">Prix : ' . $element['PrixUHT'] . '</p>
                </div>
                <img src="../img/panier.png" class="imgpanier ">
            </div>';  //onclick = "RecupPanier(this)"    
    }
}