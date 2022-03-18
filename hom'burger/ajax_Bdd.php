<?php

$fonction = $_POST['fonction'];
unset($_POST['fonction']);
$fonction($_POST);



function updateBdd($args)
{
    $table = $args['table'];
    $base = $args['base'];
    $data = $args['data'];
    $champ = $args['champ'];
    $condition = $args['condition'];
    //require_once '../connexion.php';
    try {
        $connex = new PDO(
            'mysql:host=' . 'localhost' .
                ';dbname=' . $base,
            'root',
            'cqfd14sAfe',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage() . '<br />';
        echo 'N° : ' . $e->getCode();
        die();
    }
    $connex->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
    $connex->beginTransaction(); //début
    $rq = "UPDATE $table SET $champ = '$data' WHERE $condition";
    $connex->query($rq);
    $connex->commit();
}


function selectBdd($args)
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
            'cqfd14sAfe',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage() . '<br />';
        echo 'N° : ' . $e->getCode();
        die();
    }
    $connex->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
    $connex->beginTransaction(); //début
    $rq = "SELECT $condition FROM $table";
    $result = $connex->query($rq);
    echo '<FONT face="arial">';
    echo '<div class="container">';
    echo '<CENTER>';
    echo '<div class="table">';
    echo "<div class='table-header' bgcolor='grey' align='center'>";
    printf(
        "<div class='header__item'> <a id='ncom' class='filter__link' href='#'>Numéro Commande</a></div>
        <div class='header__item'> <a id='ncli'  class='filter__link' href='#'>Nom Client</a></div>
        <div class='header__item'> <a id='date' class='filter__link' href='#'>TEL</a></div>
        <div class='header__item'> <a id='iti' class='filter__link' href='#'>Adresse</a></div>
        <div class='header__item'> <a id='prix' class='filter__link' href='#'>Prix</a></div>
        <div class='header__item'> <a id='statut' class='filter__link' href='#'>Statut</a></div>"
    );
    echo '</div>';
    echo '<div class="table-content">';
    foreach ($result as $element) {
        printf('<div class="table-row">'
            . "<div class='table-data'>" . $element['NumCom'] . "</div>"
            . "<div class='table-data'>" . $element['NomClient'] . "</div>"
            . "<div class='table-data'>" . $element['TelClient'] . "</div>"
            . "<div class='table-data buttonItineraire'>" . $element['AdrClient'] . "</div>"
            . "<div class='table-data'>" . $element['TotalTTC'] . "</div>"
            . "<div class='table-data'>
                    <select class='select_Statut select_Statut_N' onChange='selectStatut(this)'>    
                        <option class='select_Statut_N' value='N' ");
        if ($element['EtatLivraison'] == "N") echo "selected='selected'";
        "selected='selected'";
        printf(">Libre</option><option class='select_Statut_E' value='E'");
        if ($element['EtatLivraison'] == "E") echo "selected='selected'";
        printf(">En cours</option>
                        <option class='select_Statut_T' value='T'");
        if ($element['EtatLivraison'] == "T") echo "selected='selected'";
        printf(">Livrée</option>
                    </select>
                </div>"
            . '</div>');
    }
    echo '</div>';
    echo '</CENTER>';
    echo '</div>';
    echo '</FONT>';
}



function selectProduitBdd($args)
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
            'cqfd14sAfe',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage() . '<br />';
        echo 'N° : ' . $e->getCode();
        die();
    }
    $connex->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
    $connex->beginTransaction(); //début
    $rq = "SELECT $condition FROM $table";
    $result = $connex->query($rq);
    echo '<FONT face="arial">';
    echo '<div class="container">';
    echo '<CENTER>';
    echo '<div class="table">';
    echo "<div class='table-header' bgcolor='grey' align='center'>";
    printf(
        "<div class='header__item'> <a id='recette' class='filter__link' href='#'>Numéro Recette</a></div>
<div class='header__item'> <a id='nom'  class='filter__link' href='#'>Nom recette</a></div>
<div class='header__item'> <a id='ingr' class='filter__link' href='#'>Ingrédients</a></div>
<div class='header__item'> <a id='prix' class='filter__link' href='#'>Prix</a></div>"
    );
    echo '</div>';
    echo '<div class="table-content">';
    foreach ($result as $element) {
        printf('<div class="table-row">'
            . "<div class='table-data'>" . $element['IdProd'] . "</div>"
            . "<div class='table-data'>" . $element['NomProd'] . "</div>
             <div class='table-data'>");
        for ($j = 1; $j < intval($element['NbIngBase']) + 1; $j++) {
            printf($element['IngBase' . $j] . ", ");
        }
        for ($k = 1; $k < intval($element['NbIngOpt']) + 1; $k++) {
            printf($element['IngOpt' . $k] . ", ");
        }
        printf("</div><div class='table-data'>" . $element['PrixUHT'] . "</div>"
            . '</div>');
    }
    echo '</div>';
    echo '</CENTER>';
    echo '</div>';
    echo '</FONT>';
}

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
    $rq = "SELECT $condition FROM $table";
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
<div class='header__item'> <a id='Modif' class='filter__link' href='#'></a></div>
<div class='header__item'> <a id='Suppr' class='filter__link' href='#'></a></div>"


    );
    echo '</div>';
    echo '<div class="table-content">';
    foreach ($result as $element) {
        printf(
            '<div class="table-row">'
                . "<div class='table-data'>" . $element['NomFourn'] . "</div>"
                . "<div class='table-data'>" . $element['Adresse'] . "</div>"
                . "<div class='table-data'>" . $element['CodePostal'] . "</div>"
                . "<div class='table-data'>" . $element['Ville'] . "</div>"
                . "<div class='table-data'>" . $element['Tel'] . "</div>"
                . "<div class='table-data'> <input type='image' id='image'
                src='img/engrenage.png' width='50px' height='50px'></input> </div>"
                . "<div class='table-data'> <input type='image' id='image'
                src='img/supprimer.png' width='50px' height='50px'></input> </div>"
        );
    }
    echo '</div>';
    echo '</CENTER>';
    echo '</div>';
    echo '</FONT>';
}