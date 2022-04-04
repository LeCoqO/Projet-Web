<?php

$servername ="localhost";
$username = "root";
$password = "";
$dbname = "boutique";
$conn = mysqli_connect($servername, $username, $password);
if(!$conn)
{ 
	echo "desolé ,connexion $ local host impossible" ;
}
if(!mysqli_select_db($conn,$dbname)) {
	echo "desolé , acces a la base impossible "; 
	exit;

}
?>