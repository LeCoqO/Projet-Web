<?php

$fonction = $_POST['fonction'];
unset($_POST['fonction']);
$fonction($_POST);




function selectFournisseur($args)
{
    $table = $args['table'];
    $base = $args['base'];
    $condition = $args['selectCondition'];
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
    $rq = "SELECT $condition FROM $table Where DateArchiv IS NULL";
    $result = $connex->query($rq);
    echo '<FONT face="arial">';
    echo '<div class="container">';
    echo '<CENTER>';
    echo '<div class="table">';
    echo "<div class='table-header' bgcolor='grey' align='center'>";
    printf(
        "<div class='header__item'> <a id='NomFourn'  class='filter__link' href='#'>Nom Fournisseur</a></div>
<div class='header__item'> <a id='Adresse' class='filter__link' href='#'>Adresse</a></div>
<div class='header__item'> <a id='CodePostal' class='filter__link' href='#'>CodePostal</a></div>
<div class='header__item'> <a id='Ville' class='filter__link' href='#'>Ville</a></div>
<div class='header__item'> <a id='Tel' class='filter__link' href='#'>Telephone</a></div>
<div class='header__item'> <a id='Modif' class='filter__link' href='#'>Modification</a></div>
<div class='header__item'> <a id='Suppr' class='filter__link' href='#'>Supresion</a></div>"


    );
    echo '</div>';
    echo '<div class="table-content">';
    foreach ($result as $element) {
        printf(
            '<div class="table-row">'
                . "<div class='table-data'>" . $element['NomFourn'] . "</div>"
                . "<div class='table-data'>" . $element['AdresseFourn'] . "</div>"
                . "<div class='table-data'>" . $element['CPFourni'] . "</div>"
                . "<div class='table-data'>" . $element['VilleFourn'] . "</div>"
                . "<div class='table-data'>" . $element['TelFourn'] . "</div>"
                . "<div class='table-data'> <input type='image' id='image' class='inputImage'
                src='img/engrenage.png' width='45px' height='45px' onclick= 'modif()'></input> </div>"
                . "<div class='table-data'> <input type='image' id='image' class='inputImage'
                src='img/supprimer.png' width='45px' height='45px' onclick= 'suppressionFournisseur(this)'></input> </div>
                </div>"
        );
    }
    echo '</div>';
    echo '</CENTER>';
    echo '</div>';
    echo '</FONT>';
}

function newFournisseur($args)
{
    $base = $args['base'];
    $nom = $args["nom"];
    $adr = $args["adr"];
    $post = $args["post"];
    $ville = $args["ville"];
    $tel = $args["tel"];
    $dateToday = null;
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
    $rq = "INSERT INTO fournisseur (NomFourn, AdresseFourn, CPFourni, VilleFourn, TelFourn, DateArchiv) 
        VALUE ('" . $nom . "', '" . $adr . "', '" . $post . "', '" . $ville . "', '" . $tel . "', null)";
    $result = $connex->query($rq);
    $connex->commit();
}

function deletFournisseur($args)
{
    $base = $args['base'];
    $NomFourn = $args['NomFourn'];
    $date = date('Y-m-d');
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
    $rq = "UPDATE fournisseur SET DateArchiv = '" . $date . "' WHERE NomFourn = " . $NomFourn;
    $result = $connex->query($rq);
    $connex->commit();
}