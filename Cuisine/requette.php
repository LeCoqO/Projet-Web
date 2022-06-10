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