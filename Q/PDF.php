<?php
header('Content-Type: text/html; charset=utf-8');
require('tfpdf.php');

class PDF extends TFPDF
{
  // En-tête
  function Header()
  {
    // Logo
    $this->Image('img/logo.png', 10, 6, 60);
    // Police Arial gras 15
    $this->SetFont('Arial', 'B', 15);
    // Décalage à droite
    $this->Cell(60);
    // Titre
    $this->Cell(70, 10, strtoupper(utf8_decode('BON DE COMMANDE n°' . str_replace("PDF", "", $_POST['id']))), 1, 0, 'C');
    // Saut de ligne
    $this->Ln(20);
  }

  // Pied de page
  function Footer()
  {
    // Positionnement à 1,5 cm du bas
    $this->SetY(-15);
    // Police Arial italique 8
    $this->SetFont('Arial', 'I', 8);
    // Numéro de page
    $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
  }
}

//Instanciation des variables issues de $_POST
$table_commande = [];
for ($i = 0; $i < count($_POST['commandefournisseur']); $i++) {
  if ($_POST['commandefournisseur'][$i]['IdComFourn'] == str_replace("PDF", "", $_POST['id'])) {
    $table_commande = $_POST['commandefournisseur'][$i];
  }
}
$table_fournisseur = $_POST['fournisseur'];

$table_ingredient = $_POST['ingredient'];

$id_ing = array_search($table_commande['NomFourn'], array_column($table_ingredient, 'IdIng'));
$id_fourn = array_search($table_commande['IdIng'], array_column($table_fournisseur, 'NomFourn'));

// Instanciation de la classe dérivée
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
// couleur de fond de la cellule : gris clair
$pdf->SetDrawColor(183); // Couleur du fond RVB
$pdf->SetFillColor(221); // Couleur des filets RVB
$pdf->SetTextColor(0); // Couleur du texte noir
// Cellule avec les données du sous-titre sur 2 lignes, pas de bordure mais couleur de fond grise*

$decalageLiv =80;
$decalageFourn =145;
$pdf->SetY(30);
$pdf->SetX($decalageLiv);
$pdf->Cell(60, 6, 'Adresse de livraison', 0, 0, 'L', 1);
$pdf->SetX($decalageFourn);
$pdf->Cell(60, 6, 'FOURNISSEUR', 0, 1, 'L', 1);
$pdf->SetX($decalageLiv);
$pdf->Cell(60, 6,'HOM\'BURGER' , 0, 0, 'L', 1);
$pdf->SetX($decalageFourn);
$pdf->Cell(60, 6,utf8_decode($table_fournisseur[$id_fourn]['NomFourn']) , 0, 1, 'L', 1);
$pdf->SetX($decalageLiv);
$pdf->Cell(60, 6,'59 Grande rue saint Cosme', 0, 0, 'L', 1);
$pdf->SetX($decalageFourn);
$pdf->Cell(60, 6,utf8_decode($table_fournisseur[$id_fourn]['AdresseFourn']) , 0, 1, 'L', 1);
$pdf->SetX($decalageLiv);
$pdf->Cell(60, 6,utf8_decode(71100 . " " . 'Chalon s/Saône'), 0, 0, 'L', 1);
$pdf->SetX($decalageFourn);
$pdf->Cell(60, 6,utf8_decode($table_fournisseur[$id_fourn]['CPFourn']) . " " . utf8_decode($table_fournisseur[$id_fourn]['VilleFourn']), 0, 1, 'L', 1);
$pdf->SetX($decalageLiv);
$pdf->Cell(60, 6,'0771718751' , 0, 0, 'L', 1);
$pdf->SetX($decalageFourn);
$pdf->Cell(60, 6,utf8_decode($table_fournisseur[$id_fourn]['TelFourn']) , 0, 1, 'L', 1);
$pdf->Ln(10); // saut de ligne 10mm

/*$decalageFourn =145;
$pdf->SetX($decalageFourn);
$pdf->Cell(60, 6, 'FOURNISSEUR', 0, 1, 'L', 1);
$pdf->SetX($decalageFourn);
$pdf->Cell(60, 6,utf8_decode($table_fournisseur[$id_fourn]['NomFourn']) , 0, 1, 'L', 1);
$pdf->SetX($decalageFourn);
$pdf->Cell(60, 6,utf8_decode($table_fournisseur[$id_fourn]['AdresseFourn']) , 0, 1, 'L', 1);
$pdf->SetX($decalageFourn);
$pdf->Cell(60, 6,utf8_decode($table_fournisseur[$id_fourn]['CPFourn']) . " " . utf8_decode($table_fournisseur[$id_fourn]['VilleFourn']), 0, 1, 'L', 1);
$pdf->SetX($decalageFourn);
$pdf->Cell(60, 6,utf8_decode($table_fournisseur[$id_fourn]['TelFourn']) , 0, 1, 'L', 1);
$pdf->Ln(10); // saut de ligne 10mm*/


// Fonction en-tête des tableaux en 3 colonnes de largeurs variables
function entete_table($position_entete)
{
  global $pdf;
  $pdf->SetDrawColor(183); // Couleur du fond RVB
  $pdf->SetFillColor(221); // Couleur des filets RVB
  $pdf->SetTextColor(0); // Couleur du texte noir
  $pdf->SetY($position_entete);
  // position de colonne 1 (10mm à gauche)  
  $pdf->SetX(10);
  $pdf->Cell(25, 8, 'ID_INGRED', 1, 0, 'C', 1);  // 60 >largeur colonne, 8 >hauteur colonne
  // position de la colonne 2 (70 = 10+60)
  $pdf->SetX(35);
  $pdf->Cell(100, 8, 'INGREDIENT', 1, 0, 'C', 1);
  // position de la colonne 3 (130 = 70+60)
  $pdf->SetX(135);
  $pdf->Cell(20, 8, 'PUHT', 1, 0, 'C', 1);
  $pdf->SetX(155);
  $pdf->Cell(20, 8, 'QTE', 1, 0, 'C', 1);
  $pdf->SetX(175);
  $pdf->Cell(25, 8, 'TOTAL HT', 1, 0, 'C', 1);

  $pdf->Ln(); // Retour à la ligne
}


$pdf->Ln(10); // saut de ligne 10mm
$pdf->Ln(10); // saut de ligne 10mm
$pdf->SetDrawColor(255); // Couleur du fond RVB
$pdf->SetFillColor(255); // Couleur des filets RVB
$pdf->SetTextColor(0); // Couleur du texte noir
$pdf->SetX(0); //N'a pad d'influence 
$pdf->SetY(70);
$pdf->Cell(0, 8,"Date de commade : " . $table_commande['DateComFourn'] . "                                                                            " . "Date de Livraison : " . $table_commande['DateLivFourn'], 1, 0, 'C', 1);

// AFFICHAGE EN-TÊTE DU TABLEAU
// Position ordonnée de l'entête en valeur absolue par rapport au sommet de la page (70 mm)
$position_entete = 80;
// police des caractères
$pdf->SetFont('Helvetica', '', 9);
$pdf->SetTextColor(0);
// on affiche les en-têtes du tableau
entete_table($position_entete);

$pdf->SetFillColor(255); // Couleur des filets RVB
$pdf->SetX(10);
$pdf->Cell(25, 8, $table_commande['IdIng'], 1, 0, 'C', 1);
$pdf->SetX(35);
$pdf->Cell(100, 8, $table_ingredient[$id_ing]['NomIng'], 1, 0, 'C', 1);
$pdf->SetX(135);
$pdf->Cell(20, 8, $table_ingredient[$id_ing]['PUHT'] . chr(128), 1, 0, 'C', 1);
$pdf->SetX(155);
$pdf->Cell(20, 8, $table_commande['QteComFourn'], 1, 0, 'C', 1);
$pdf->SetX(175);
$pdf->Cell(25, 8, $table_commande['QteComFourn'] * $table_ingredient[$id_ing]['PUHT'] . chr(128), 1, 0, 'C', 1);
$pdf->Ln(); // Retour à la ligne
//$pdf->MultiCell(0, 5, print_r($_POST, true)); //DEBUG
//Enregistrement du document
$pdf->Output('F', ".\\commandes\\" . $_POST['id'] . '.pdf');
