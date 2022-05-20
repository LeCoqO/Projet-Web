/*------------ADD DATA IN LIVREUR-----------------*/
INSERT INTO `livreur` (`IdLivreur`, `Nom`, `Prenom`, `Tel`, `NumSS`, `DateArchiv`) 
VALUES ('1', 'Page', 'Lilian', '0771718751', '10364123587321', '2022-03-18'),
('2', 'Torres', 'Diego', '0771718751', '10364123587321', '2022-03-18');


/*------------ADD DATA IN COMMANDE----------------*/
INSERT INTO `commande` (`NumCom`, `NomClient`, `TelClient`, `AdrClient`, `CP_Client`, `VilClient`, `Date`, `HeureDispo`, `TypeEmbal`, `A_Livrer`, `EtatLivraison`, `CoutLiv`, `DateArchiv`, `EtatCde`, `TotalTTC`, `IdLivreur`) 
VALUES ('1', 'Torres', '0771718751', '59 grande rue saint cosme', '71100', 'Chalon-sur-Sôane', '2022-03-18', '19:56:51', 'c', 'N', 'N', '3', '2022-03-18', 'A_livrer', '15.5', '1'),
('2', 'Corentin', '0771718751', '01 grande rue saint cosme', '71100', 'Chalon-sur-Sôane', '2022-03-18', '19:56:51', 'c', 'N', 'N', '3', '2022-03-18', 'A_livrer', '15.5', '1');


/*------------ADD DATA IN PRODUIT-----------------*/

INSERT INTO `produit` (`IdProd`, `NomProd`, `Taille`, `NbIngBase`, `NbIngOpt`, `PrixUHT`, `Image`, `IngBase1`, `IngBase2`, `IngBase3`, `IngBase4`, `IngBase5`, `IngOpt1`, `IngOpt2`, `IngOpt3`, `IngOpt4`, `IngOpt5`, `IngOpt6`, `NbOptMax`, `DateArchiv`) 
VALUES ('1', 'Oburger', 'L', '4', '1', '9.99', './img/Oburger.PNG', 'Pain sésame', 'Boeuf', 'Tomate', 'Salade', NULL, 'Sauce Moustache', NULL, NULL, NULL, NULL, NULL, '3', '2022-03-18'),
('2', 'Tac original', 'L', '4', '1', '11.99', './img/Tac_Original.png', 'Pain sésame', 'Pain tacos', 'Boeuf', 'frite', NULL, 'Sauce Blanche', NULL, NULL, NULL, NULL, NULL, '3', '2022-03-18')




/*------------ADD DATA IN COM_DET-----------------*/
INSERT INTO `com_det` (`Num_OF`, `Quant`, `NumCom`) VALUES ('1', '2', '1');
/*------------ADD DATA IN DETAIL------------------*/
/*------------ADD DATA IN DET_INGR----------------*/
/*------------ADD DATA IN FOURNISSEUR-------------*/

INSERT INTO `fournisseur` (`NomFourn`, `Adresse`, `CodePostal`, `Ville`, `Tel`, `DateArchiv`)
VALUES ('MyFoodnisseur', '23 Rue Alphonse Lamartine', '71100', 'Chalon-sur-saône', '0771718751', '2022-03-18');
/*------------ADD DATA IN FOURM_INGR--------------*/
/*------------ADD DATA IN INGREDIENT--------------*/
INSERT INTO `ingredient` (`IdIngred`, `NomIngred`, `Frais`, `TypeDIngr`, `Unite`, `StockMin`, `StockReel`, `PrixUHT_Moyen`, `Q_A_Com`, `DateArchiv`)
VALUES ('1', 'Pain Sesame', 'F', 'P', '\"sans\"', '50', '150', '0.4', '0', '2022-03-18'),
 ('2', 'Pain Ble', 'F', 'P', '\"sans\"', '50', '150', '0.4', '0', '2022-03-18'),
 ('3', 'Boeuf', 'T', 'P', '\"sans\"', '50', '150', '0.8', '0', '2022-03-18'),
 ('4', 'Poulet', 'T', 'P', '\"sans\"', '50', '150', '0.3', '0', '2022-03-18'),
 ('5', 'Salade', 'T', 'P', '\"sans\"', '50', '150', '0.2', '0', '2022-03-18'),
 ('6', 'Tomate', 'T', 'P', '\"sans\"', '50', '150', '0.2', '0', '2022-03-18'),
 ('7', 'Sauce Algérienne', 'F', 'S', '\"sans\"', '50', '150', '0.8', '0', '2022-03-18'),
 ('8', 'Sauce Burger', 'F', 'S', '\"sans\"', '50', '150', '0.3', '0', '2022-03-18'),
 ('9', 'Sauce Moustache', 'F', 'S', '\"sans\"', '50', '150', '0.2', '0', '2022-03-18'),
 ('10', 'Ketchup', 'F', 'S', '\"sans\"', '50', '150', '0.2', '0', '2022-03-18'),
 ('11', 'Barbecue', 'F', 'S', '\"sans\"', '50', '150', '0.2', '0', '2022-03-18'),
 ('12', 'Emmental', 'F', 'S', '\"sans\"', '50', '150', '0.2', '0', '2022-03-18');







/*------------ADD DATA IN PRODUIT_INGR------------*/
