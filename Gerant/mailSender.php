<?php

/*

-----------------------------NON FONCTIONNEL---------------------------------
NECESSITE DES MODIFICATIONS AU NIVEAU DU PHP.INI
MODIFICATIONS COMPLIQUEES ET NE PEUT TOURNER SUR UNE AUTRE MACHINE
RECHERCHE D'UNE ALTERNATIVE EN COURS

*/




//$toFourni = $_POST['fournisseurMail'];
$toGerant = 'diego.publicmail@gmail.com';
$subject = 'HOMBURGER - Bon de commande n°';//+ $_POST['commandeID'];
$message = 'Ceci est un texte pacifique';
$headers = 'From: diego.publicmail@gmail.com' . "\r\n" .
'Reply-To: diego.publicmail@gmail.com' . "\r\n" .
'X-Mailer: PHP/' . phpversion();

//mail($toFourni,$subject,$message,$headers);
mail($toGerant,$subject,$message,$headers);