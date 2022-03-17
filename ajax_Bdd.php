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
        <div class='header__item'> <a id='ncli'  class='filter__link' href='#'>Numéro Client</a></div>
        <div class='header__item'> <a id='date' class='filter__link' href='#'>Date</a></div>
        <div class='header__item'> <a id='iti' class='filter__link' href='#'>Adresse</a></div>
        <div class='header__item'> <a id='iti' class='filter__link' href='#'>Statut</a></div>"
    );
    echo '</div>';
    echo '<div class="table-content">';
    foreach ($result as $element) {
        printf('<div class="table-row">'
            . "<div class='table-data'>" . $element['NCOM'] . "</div>"
            . "<div class='table-data'>" . $element['NCLI'] . "</div>"
            . "<div class='table-data'>" . $element['DATECOM'] . "</div>"
            . "<div class='table-data buttonItineraire'>26 rue de mirande Dijon</div>"
            . "<div class='table-data'>
                    <select class='select_Statut select_Statut_Libre' onChange='selectStatut(this)'>    
                        <option class='select_Statut_Libre' value='Libre'>Libre</option>
                        <option class='select_Statut_En_Cours' value='En_Cours'>En cours</option>
                        <option class='select_Statut_livree' value='Livree'>Livrée</option>
                    </select>
                </div>"
            . '</div>');
    }
    echo '</div>';
    echo '</CENTER>';
    echo '</div>';
    echo '</FONT>';
}
