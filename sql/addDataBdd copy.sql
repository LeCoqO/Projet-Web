/*------------ADD DATA IN LIVREUR-----------------*/
INSERT INTO `livreur` (`NomLiv`, `PrenomLiv`, `TelLiv`, `NumSSLiv`, `DateArchivLiv`) 
VALUES ('Page', 'Lilian', '0771718751', '10364123587321', '2022-03-18'),
('Torres', 'Diego', '0771718751', '10364123587321', '2022-03-18');


/*------------ADD DATA IN COMMANDE----------------*/
INSERT INTO `commande` (`NomCom`, `TelCom`, `AdrCom`, `CPCom`, `VilleCom`, `DateCom`, `HeureDispo`, `TypeEmbal`, `A_Livrer`, `EtatLivraison`, `CoutLiv`, `DateArchivCom`, `EtatCde`, `TotalTTC`, `IdLiv`) 
VALUES ('Torres', '0771718751', '59 grande rue saint cosme', '71100', 'Chalon-sur-Sôane', '2022-03-18', '19:56:51', 'c', 'N', 'N', '3', '2022-03-18', 'A_livrer', '15.5', '1'),
('Corentin', '0771718751', '01 grande rue saint cosme', '71100', 'Chalon-sur-Sôane', '2022-03-18', '19:56:51', 'c', 'N', 'N', '3', '2022-03-18', 'A_livrer', '15.5', '1');


/*------------ADD DATA IN PRODUIT-----------------*/
INSERT INTO `produit` (`NomProd`, `Taille`, `NbIngBase`, `NbIngOpt`, `PrixUHT`, `Image`, `IngBase1`, `IngBase2`, `IngBase3`, `IngBase4`, `IngBase5`, `IngOpti1`, `IngOpti2`, `IngOpti3`, `IngOpti4`, `IngOpti5`, `IngOpti6`, `NbOptMax`, `DateArchivProd`, `Incontournable`) VALUES ('Oburger', 'L', '4', '1', '9.99', './img/Oburger.PNG', 'Pain sésame', 'Boeuf', 'Tomate', 'Salade', NULL, 'Sauce Moustache', NULL, NULL, NULL, NULL, NULL, '3', '2022-03-18', 'o'), ('Tac original', 'L', '4', '1', '11.99', './img/Tac_Original.png', 'Pain sésame', 'Pain tacos', 'Boeuf', 'frite', NULL, 'Sauce Blanche', NULL, NULL, NULL, NULL, NULL, '3', '2022-03-18', 'n')


/*------------ADD DATA IN DETAIL------------------*/


/*------------ADD DATA IN DET_INGR----------------*/
/*------------ADD DATA IN FOURNISSEUR-------------*/

INSERT INTO `fournisseur` (`NomFourn`, `AdresseFourn`, `CPFourn`, `VilleFourn`, `TelFourn`, `DateArchivFourn`)
VALUES ('MyFoodnisseur', '23 Rue Alphonse Lamartine', '71100', 'Chalon-sur-saône', '0771718751', '2022-03-18');
/*------------ADD DATA IN FOURM_INGR--------------*/
/*------------ADD DATA IN INGREDIENT--------------*/
INSERT INTO `ingredient` (`NomIng`, `Frais`, `Type`, `Unite`, `StockMin`, `StockReel`, `PrixUHT_Moyen`, `Q_A_Com`, `DateArchivIng`)
VALUES ('Pain Sesame', 'F', 'P', '\"sans\"', '50', '150', '0.4', '0', '2022-03-18'),
 ('Pain Ble', 'F', 'P', '\"sans\"', '50', '150', '0.4', '0', '2022-03-18'),
 ('Boeuf', 'T', 'P', '\"sans\"', '50', '150', '0.8', '0', '2022-03-18'),
 ('Poulet', 'T', 'P', '\"sans\"', '50', '150', '0.3', '0', '2022-03-18'),
 ('Salade', 'T', 'P', '\"sans\"', '50', '150', '0.2', '0', '2022-03-18'),
 ('Tomate', 'T', 'P', '\"sans\"', '50', '150', '0.2', '0', '2022-03-18'),
 ('Sauce Algérienne', 'F', 'S', '\"sans\"', '50', '150', '0.8', '0', '2022-03-18'),
 ('Sauce Burger', 'F', 'S', '\"sans\"', '50', '150', '0.3', '0', '2022-03-18'),
 ('Sauce Moustache', 'F', 'S', '\"sans\"', '50', '150', '0.2', '0', '2022-03-18'),
 ('Ketchup', 'F', 'S', '\"sans\"', '50', '150', '0.2', '0', '2022-03-18'),
 ('Barbecue', 'F', 'S', '\"sans\"', '50', '150', '0.2', '0', '2022-03-18'),
 ('Emmental', 'F', 'S', '\"sans\"', '50', '150', '0.2', '0', '2022-03-18');







/*------------ADD DATA IN PRODUIT_INGR------------*/
