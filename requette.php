<?php

$fonction = $_POST['fonction'];
unset($_POST['fonction']);
$fonction($_POST);

function select($args){
    $requete = $args['requete'];
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=homeburger','root','');
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
?>