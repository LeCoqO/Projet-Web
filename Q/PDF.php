<?php
require('fpdf.php');

class PDF extends FPDF
{
// En-tête
function Header()
{
    // Logo
    $this->Image('img/logo.png',10,6,30);
    // Police Arial gras 15
    $this->SetFont('Arial','B',15);
    // Décalage à droite
    $this->Cell(60);
    // Titre
    $this->Cell(70,10,strtoupper(utf8_decode('BON DE COMMANDE n°'.str_replace("PDF","",$_POST['id']))),1,0,'C');
    // Saut de ligne
    $this->Ln(20);
}

// Pied de page
function Footer()
{
    // Positionnement à 1,5 cm du bas
    $this->SetY(-15);
    // Police Arial italique 8
    $this->SetFont('Arial','I',8);
    // Numéro de page
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
// Instanciation de la classe dérivée
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
// couleur de fond de la cellule : gris clair
$pdf->setFillColor(230,230,230);
// Cellule avec les données du sous-titre sur 2 lignes, pas de bordure mais couleur de fond grise
$pdf->Cell(75,6,'Test livraison pour le 5 juin',0,1,'L',1);    
$pdf->Cell(75,6,strtoupper(utf8_decode('La sauce')),0,1,'L',1);        
$pdf->Ln(10); // saut de ligne 10mm


// Fonction en-tête des tableaux en 3 colonnes de largeurs variables
function entete_table($position_entete) {
    global $pdf;
    $pdf->SetDrawColor(183); // Couleur du fond RVB
    $pdf->SetFillColor(221); // Couleur des filets RVB
    $pdf->SetTextColor(0); // Couleur du texte noir
    $pdf->SetY($position_entete);
    // position de colonne 1 (10mm à gauche)  
    $pdf->SetX(10);
    $pdf->Cell(25,8,'ID_INGRED',1,0,'C',1);  // 60 >largeur colonne, 8 >hauteur colonne
    // position de la colonne 2 (70 = 10+60)
    $pdf->SetX(35); 
    $pdf->Cell(100,8,'INGREDIENT',1,0,'C',1);
    // position de la colonne 3 (130 = 70+60)
    $pdf->SetX(135); 
    $pdf->Cell(20,8,'PUHT',1,0,'C',1);
    $pdf->SetX(155); 
    $pdf->Cell(20,8,'QTE',1,0,'C',1);
    $pdf->SetX(175); 
    $pdf->Cell(25,8,'TOTAL HT',1,0,'C',1);
  
    $pdf->Ln(); // Retour à la ligne
  }
  // AFFICHAGE EN-TÊTE DU TABLEAU
  // Position ordonnée de l'entête en valeur absolue par rapport au sommet de la page (70 mm)
  $position_entete = 70;
  // police des caractères
  $pdf->SetFont('Helvetica','',9);
  $pdf->SetTextColor(0);
  // on affiche les en-têtes du tableau
  entete_table($position_entete);



  $position_detail = 78; // Position ordonnée = $position_entete+hauteur de la cellule d'en-tête (60+8)
  $requete2 = "SELECT * FROM gastro WHERE id_voyageur='1'";
  $result2 = mysqli_query($link, $requete2);
  while ($data_visit = mysqli_fetch_array($result2)) {
    // position abcisse de la colonne 1 (10mm du bord)
    $pdf->SetY($position_detail);
    $pdf->SetX(10);
    $pdf->MultiCell(60,8,utf8_decode($data_visit['ville']),1,'C');
      // position abcisse de la colonne 2 (70 = 10 + 60)  
    $pdf->SetY($position_detail);
    $pdf->SetX(70); 
    $pdf->MultiCell(60,8,utf8_decode($data_visit['pays']),1,'C');
    // position abcisse de la colonne 3 (130 = 70+ 60)
    $pdf->SetY($position_detail);
    $pdf->SetX(130); 
    $pdf->MultiCell(30,8,$data_visit['nb_repas'],1,'C');
  
    // on incrémente la position ordonnée de la ligne suivante (+8mm = hauteur des cellules)  
    $position_detail += 8; 
  }
  mysqli_free_result($result2);
                  


$pdf->Cell(40,10,'Hello World ! grosse pute');
$pdf->Ln(10); // saut de ligne 10mm
$pdf->Cell(40,10,str_replace("PDF","",$_POST['id']));
$pdf->Output('F',".\\commandes\\".$_POST['id'].'.pdf');
