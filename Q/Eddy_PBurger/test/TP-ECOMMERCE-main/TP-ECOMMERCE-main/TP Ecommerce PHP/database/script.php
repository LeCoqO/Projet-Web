<?php
include("../Connexion_db.php");
?>

<?php
     ini_set('memory_limit','1024M');    
     set_time_limit(8000); 
        $query='';
        $table_data = '';
        $filename = "products.json";
        $data = file_get_contents($filename); //Read the JSON file in PHP
        $array = json_decode($data, true); //Convert JSON String into PHP Array
        
        //var_dump($array);
            foreach($array as $row)
			{

                
                echo "<br> ------------------------------------------------------------ <br>";
				$sku = (int) $row["sku"] ;;
                $req_exist_prod="SELECT * FROM produit where sku = $sku";
                    $res_exist_prod=$conn->query($req_exist_prod);
                    
					    if(!$res_exist_prod->num_rows)
						{
							foreach($row['category'] as $tab)
							{
								$query .= "".$tab["id"]." ";
								$requette="SELECT * FROM categorie where id ='".$tab["id"]."'";
								$res=$conn->query($requette);
								if(!$res->num_rows){
									$req = "INSERT INTO categorie (id,NAME_CATEGORIE)  VALUES ('".$tab["id"]."', '".$tab["name"]."')";
									$res=$conn->query($req);
									if(!$res){
										echo "error 1 <br>";
									}
									else{ 
										echo "data created 1";
									}
								}
								else{
									echo "allready in db 1";
								}
							
							}
							$name = $row["name"];
							$description = $row["description"];
							$type = $row["type"];
							$price = (double) $row["price"];
							$upc = $row["upc"];
							$shipping = (double) $row["shipping"];
							$description = $row["description"];
							$manufacturer = $row["manufacturer"];
							$model = $row["model"];
							$url = $row["url"];
							$image = $row["image"];
							echo "idcat = '".$tab["id"]."' <br>";   
							$reqProd = "INSERT INTO produit VALUES ($sku,'".$tab["id"]."', '".$name."','".$type."',$price,'".$upc."',$shipping,'".$description."','".$manufacturer."','".$model."','".$url."','".$image."')";
							$resultat=$conn->query($reqProd);
							if(!$resultat){
								echo "errooor";
							}
							else{
								echo "product created ";
							}
						}
						else
						{
							 echo "prod allready in db";
						}

            }

    ?>