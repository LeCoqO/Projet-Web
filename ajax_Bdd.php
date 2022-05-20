<?php

$fonction = $_POST['fonction'];
unset($_POST['fonction']);
$fonction($_POST);

function requete($args){
    $requete = $args['requete'];
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=homburger','root','cqfd14sAfe');
        $pdo -> exec("set names utf8");
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage() . '<br />';
        echo 'NÂ° : ' . $e->getCode();
        die();
    }
    $statement = $pdo->prepare($requete);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($results);
    echo $json;
}

function update($args){
    $requete = $args['requete'];
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=homburger','root','cqfd14sAfe');
        $pdo -> exec("set names utf8");
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage() . '<br />';
        echo 'NÂ° : ' . $e->getCode();
        die();
    }
    $statement = $pdo->prepare($requete);
    $statement->execute();
    $statement->fetchAll(PDO::FETCH_ASSOC);
    //echo $requete;
}
