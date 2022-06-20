<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=homburger', 'root', '');
    $pdo->exec("set names utf8");
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage() . '<br />';
    echo 'N° : ' . $e->getCode();
    die();
}

$statement = $pdo->query("SELECT IdIng , StockMin, StockReel FROM ingredient");
$ingredients = $statement->fetchAll(PDO::FETCH_BOTH);
foreach ($ingredients as $value) {
    if ($value['StockMin'] > $value['StockReel']) {
        $statement = $pdo->query("SELECT NomFourn FROM fourn_ingr WHERE IdIng = " . $value['IdIng'] . ";");
        $fournisseur = $statement->fetchAll(PDO::FETCH_BOTH);
        $statement = $pdo->query("INSERT INTO commandefournisseur (IdIng, NomFourn, QteComFourn, DateLivFourn, DateComFourn) VALUES (" . $value['IdIng'] . ',"' . $fournisseur[0]['NomFourn'] . '",' . $value['StockMin'] . ',"'
            . date_format(date_add(date_create(date('Y-m-d')), date_interval_create_from_date_string("7 days")), 'Y-m-d') . '","' . date('Y-m-d') . '");');
    }
}
