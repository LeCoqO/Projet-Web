<?php

$fonction = $_POST['fonction'];
unset($_POST['fonction']);
$fonction($_POST);



function updateBdd($args)
{
    $table = $args['table'];
    $base = $args['base'];
    $set = $args['set'];
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
    $rq = "UPDATE $table SET $set WHERE $condition";
    $connex->query($rq);
    $connex->commit();
}
/*$rq = "UPDATE $table SET ";
    foreach($champ as $c){
        $rq.= $c." = '$data'";
    }
    $rq.=" WHERE $condition";*/



function selectBdd($args)
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
    $rq = "SELECT $condition FROM $table " . $whereValue;
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
        <div class='header__item'> <a id='heure' class='filter__link' href='#'>Heure de Livraison</a></div>
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
            . "<div class='table-data'>" . $element['HeureDispo'] . "</div>"
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



function selectStocksBdd($args)
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
    printf(
    '<table>
        <tr>
            <td>
                Aliment
            </td>
            <td>
                Quantité
            </td>
        </tr>'
    );
    foreach ($result as $element) {
        printf('<tr>
                    <td> '.
                        $element['NomIngred'] .'
                    </td>
                    <td> '.
                        $element['StockReel'].' '.$element['Unite'] .'
                    </td>
                </td>');
    }
    printf(
    '</table>'
    );
}

function selectListeIngredients($args)
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
    printf('
        <select id="ingredient" onChange="AppelApresIngredient(this.value)" style="width:300px">
            <option selected value="">--Ingrédient--</option>'
    );
    foreach ($result as $element) {
        printf('<option value="'.$element['IdIngred'].'">'
        .$element['NomIngred'].'
        </option>');
    }
    printf(
        '</select>'
    );
}

function selectQteIngredient($args)
{
    $table = $args['table'];
    $base = $args['base'];
    $condition = $args['selectCondition'];
    $id = $args['id'];    //require_once '../connexion.php';
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
    $rq = "SELECT $condition FROM $table WHERE IdIngred = $id";
    $result = $connex->query($rq);
    foreach ($result as $element) {
        printf('<label>'.$element['StockReel'].'</label> <label>'.$element['Unite'].'</label>');
    }
}

function selectUnite($args)
{
    $table = $args['table'];
    $base = $args['base'];
    $condition = $args['selectCondition'];
    $id = $args['id'];    //require_once '../connexion.php';
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
    $rq = "SELECT $condition FROM $table WHERE IdIngred = $id";
    $result = $connex->query($rq);
    foreach ($result as $element) {
        printf('<label>'.$element['Unite'].'</label>');
    }
}


function selectListeUnites($args)
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
    $rq = "SELECT DISTINCT $condition FROM $table";
    $result = $connex->query($rq);
    printf('
        <select id="unites">
            <option selected value="">--Selection Unité--</option>'
    );
    foreach ($result as $element) {
        printf('<option>'.$element['Unite'].'</option>');
    }
    printf(
        '</select>'
    );
}


function selectListeFournisseurs($args)
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
    $rq = "SELECT DISTINCT $condition FROM $table";
    $result = $connex->query($rq);
    printf('
        <select id="unites">
            <option selected value="">--Selection Fournisseur--</option>'
    );
    foreach ($result as $element) {
        printf('<option>'.$element['NomFourn'].'</option>');
    }
    printf(
        '</select>'
    );
}


function getIngrBdd($args)
{
    $table = $args['table'];
    $base = $args['base'];
    $condition = $args['selectCondition'];
    $whereValue =  $args['whereValue'];
    $classOption =  $args['classOption'];

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
    $rq = "SELECT $condition FROM $table" . " " . $whereValue;
    $result = $connex->query($rq);
    foreach ($result as $element) {
        echo '<h3 class="text-center ' . $classOption . '" id="' . $element['NomIngred'] . '">' . $element['NomIngred'] . ' </h3>';
    }
}



function selectLivreur($args)
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

    echo "<select id='selectLivreur' onChange='setIdLivreur()' class='button right select_livreur'>";
    foreach ($result as $element) {
        echo "<option value='" . $element['IdLivreur'] . "'";
        if ($args['IdLivreur'] == $element['IdLivreur']) echo "selected='selected'";
        echo ">" . $element['Prenom'] . " / " . $element['IdLivreur'] . "</option>";
    }
    echo "</select>";
}


/*

function selectBddIngre($args)
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
    $rq = "SELECT $condition FROM $table " . $whereValue;
    $result = $connex->query($rq);

    foreach ($result as $element) {
    echo '<h3 class="text-center burger_pain" id="Pain Sésame">';
    echo $element['NumCom'];
    echo ' </h3>';

}

}
*/


function selectCommande($args)
{
    //$table = $args['table'];
    $base = $args['base'];
    //$condition = $args['selectCondition'];      // 'WHERE NumCom LIKE [num]
    $condition = 'WHERE NumCom LIKE 1';      // 'WHERE NumCom LIKE [num]
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
    //$rq2 = 'SELECT * FROM `Commande` '.$condition.')))';
    //$result2 = $connex->query($rq2);

    $rq = 'SELECT * FROM `produit` WHERE IdProd IN( 
                SELECT IdProd FROM `detail` WHERE Num_OF IN( 
                    SELECT Num_OF FROM `com_det` WHERE NumCom in(
                        SELECT NumCom FROM `Commande` '.$condition.')))';
    $result = $connex->query($rq);

    foreach ($result as $element) {
        echo '<article class="articleCommande"><h3 class="h3Cuisine">Commande N°1:</h3>';
        echo '<div class="nbBurger">';
          echo '<p>Conteint 3 burgers</p></div>
          <div class="heurePrepa">';
        
          echo '<p>Doit être prête pour : ';//.$result2['HeureDispo'].'</p>';
        echo '</div>
        <br /><br /><br /><br />
        <div class="burgerAFaire">
          <div class="apercuCmd">
            <img src="'.$element['Image'].'" class="imgCuisine" />';
            echo '<p>: 2 burgers</p>
          </div>
          <div class="listeCuisine">
            <input
              type="button"
              value="Liste des ingrédients"
              onclick="OnOff();"
              class="btnListeIngredients"
            />';
            echo '<span id="texte" style="visibility: hidden" class="listePrepa">';
            if ($element['IngBase1']) echo $element['IngBase1'].'<br />';
            if ($element['IngBase2']) echo $element['IngBase2'].'<br />';
            if ($element['IngBase3']) echo $element['IngBase3'].'<br />';
            if ($element['IngBase4']) echo $element['IngBase4'].'<br />';
            if ($element['IngOpt1']) echo $element['IngOpt1'].'<br />';
            if ($element['IngOpt2']) echo $element['IngOpt2'].'<br />';
            if ($element['IngOpt3']) echo $element['IngOpt3'].'<br />';
            if ($element['IngOpt4']) echo $element['IngOpt4'].'<br />';
            echo '</span>
          </div>
        </div>';
echo'<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
        <input type="button" value="A préparer" class="aPrepa" />
        <input type="button" value="Commande terminée" class="cmdFinie" />
      </article>';
    }
 
}
