<?php
require('envoi_mail.php');

envoi('trokikoo@gmail.com', "Bon de Commande HOM'BURGER", "Ceci est un mail. Coridalement", "./commandes/" . 'PDF7' . '.pdf');
