<?php

//CLASSE PERMETTANT DE GENERER DES PDF AVEC TFPDF
header('Content-Type: text/html; charset=utf-8');
require('tfpdf.php');
require('envoi_mail.php');

class PDF extends TFPDF
{
  // En-tête
  function Header()
  {
    // Logo
    $this->Image('img/logo.png', 10, 6, 60);
    $this->SetFont('Arial', 'B', 15);
    $this->Cell(60);
    // Titre
    $this->Cell(70, 10, strtoupper(utf8_decode('BON DE COMMANDE n°' . str_replace("PDF", "", $_POST['id']))), 1, 0, 'C');
    $this->Ln(20);
  }

  // Pied de page
  function Footer()
  {
    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    // Numéro de page
    $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
  }
}

$table_commande = $_POST['commandefournisseur'];

$table_fournisseur = $_POST['fournisseur'];

$table_ingredient = $_POST['ingredient'];

$id_ing =array_search($table_commande['NomFourn'], array_column($table_ingredient, 'IdIng'));// $_POST['i']; //array_search($table_commande['NomFourn'], array_column($table_ingredient, 'IdIng'));
$id_fourn = array_search($table_commande['IdIng'], array_column($table_fournisseur, 'NomFourn'));


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
$pdf->SetDrawColor(183);
$pdf->SetFillColor(221);
$pdf->SetTextColor(0);

$decalageLiv = 80;
$decalageFourn = 145;
$pdf->SetY(30);
$pdf->SetX($decalageLiv);
$pdf->Cell(60, 6, 'Adresse de livraison', 0, 0, 'L', 1);
$pdf->SetX($decalageFourn);
$pdf->Cell(60, 6, 'FOURNISSEUR', 0, 1, 'L', 1);
$pdf->SetX($decalageLiv);
$pdf->Cell(60, 6, 'HOM\'BURGER', 0, 0, 'L', 1);
$pdf->SetX($decalageFourn);
$pdf->Cell(60, 6, utf8_decode($table_fournisseur['NomFourn']), 0, 1, 'L', 1);
$pdf->SetX($decalageLiv);
$pdf->Cell(60, 6, '59 Grande rue saint Cosme', 0, 0, 'L', 1);
$pdf->SetX($decalageFourn);
$pdf->Cell(60, 6, utf8_decode($table_fournisseur['AdresseFourn']), 0, 1, 'L', 1);
$pdf->SetX($decalageLiv);
$pdf->Cell(60, 6, utf8_decode(71100 . " " . 'Chalon s/Saône'), 0, 0, 'L', 1);
$pdf->SetX($decalageFourn);
$pdf->Cell(60, 6, utf8_decode($table_fournisseur['CPFourn']) . " " . utf8_decode($table_fournisseur['VilleFourn']), 0, 1, 'L', 1);
$pdf->SetX($decalageLiv);
$pdf->Cell(60, 6, '0771718751', 0, 0, 'L', 1);
$pdf->SetX($decalageFourn);
$pdf->Cell(60, 6, utf8_decode($table_fournisseur['TelFourn']), 0, 1, 'L', 1);
$pdf->Ln(10);

function entete_table($position_entete)
{
  global $pdf;
  $pdf->SetDrawColor(183);
  $pdf->SetFillColor(221);
  $pdf->SetTextColor(0);
  $pdf->SetY($position_entete);
  $pdf->SetX(10);
  $pdf->Cell(25, 8, 'ID_INGRED', 1, 0, 'C', 1);
  $pdf->SetX(35);
  $pdf->Cell(100, 8, 'INGREDIENT', 1, 0, 'C', 1);
  $pdf->SetX(135);
  $pdf->Cell(20, 8, 'PUHT', 1, 0, 'C', 1);
  $pdf->SetX(155);
  $pdf->Cell(20, 8, 'QTE', 1, 0, 'C', 1);
  $pdf->SetX(175);
  $pdf->Cell(25, 8, 'TOTAL HT', 1, 0, 'C', 1);

  $pdf->Ln();
}


$pdf->Ln(10);
$pdf->Ln(10);
$pdf->SetDrawColor(255);
$pdf->SetFillColor(255);
$pdf->SetTextColor(0);
$pdf->SetX(0);
$pdf->SetY(70);
$pdf->Cell(0, 8, "Date de commade : " . $table_commande['DateComFourn'] . "                                                                            " . "Date de Livraison : " . $table_commande['DateLivFourn'], 1, 0, 'C', 1);


$position_entete = 80;
//$pdf->SetFont('Helvetica', '', 9);
$pdf->SetTextColor(0);

entete_table($position_entete);

$pdf->SetFillColor(255);
$pdf->SetX(10);
$pdf->Cell(25, 8, $table_commande['IdIng'], 1, 0, 'C', 1);
$pdf->SetX(35);
$pdf->Cell(100, 8, utf8_decode($table_ingredient['NomIng']), 1, 0, 'C', 1);
$pdf->SetX(135);
$pdf->Cell(20, 8, $table_ingredient['PUHT'] . chr(128), 1, 0, 'C', 1);
$pdf->SetX(155);
$pdf->Cell(20, 8, $table_commande['QteComFourn'], 1, 0, 'C', 1);
$pdf->SetX(175);
$pdf->Cell(25, 8, $table_commande['QteComFourn'] * $table_ingredient['PUHT'] . chr(128), 1, 0, 'C', 1);
$pdf->Ln();

envoi('trokikoo@gmail.com', "Bon de Commande HOM'BURGER", "Ceci est un mail. Coridalement", "./commandes/" . 'PDF7' . '.pdf');

$pdf->Output('F', ".\\commandes\\" . $_POST['id'] . '.pdf');
//envoi("'".$table_fournisseur['MailFourn']."'","Bon de Commande HOM'BURGER","Ceci est un mail. Coridalement",".\\commandes\\" . $_POST['id'] . '.pdf');
