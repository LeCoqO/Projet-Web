<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=homburger', 'root', '');
    $pdo->exec("set names utf8");
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage() . '<br />';
    echo 'N° : ' . $e->getCode();
    die();
} 


//A SUPPR
$statement = $pdo->query("SELECT * FROM ingredient");
$ingredients = $statement->fetchAll(PDO::FETCH_BOTH);
print_r(json_encode($ingredients));
echo("<br>");
echo("<br>");
$statement = $pdo->query("SELECT * FROM fournisseur");
$ingredients = $statement->fetchAll(PDO::FETCH_BOTH);
print_r(json_encode($ingredients));
echo("<br>");
echo("<br>");
$statement = $pdo->query("SELECT * FROM commandeFournisseur");
$ingredients = $statement->fetchAll(PDO::FETCH_BOTH);
print_r(json_encode($ingredients));







$statement = $pdo->query("SELECT IdIng , StockMin, StockReel FROM ingredient");
$ingredients = $statement->fetchAll(PDO::FETCH_BOTH);
foreach ($ingredients as $value) {
    if ($value['StockMin'] > $value['StockReel']) {
        $statement = $pdo->query("SELECT NomFourn FROM fourn_ingr WHERE IdIng = " . $value['IdIng'] .";" );
        $fournisseur = $statement->fetchAll(PDO::FETCH_BOTH);
        /*$statement = $pdo->query("'INSERT INTO commandefournisseur (IdIng, NomFourn, QteComFourn, DateLivFourn, DateComFourn) VALUES (" . $value['IdIng'] . ',' . $fournisseur['NomFourn'][0] . ',' . $value[''] + ',"' + dateLiv + '","' + dateAjd +'");', );
        $fournisseur = $statement->fetchAll(PDO::FETCH_BOTH);*/

        print_r($fournisseur);
    }
}
