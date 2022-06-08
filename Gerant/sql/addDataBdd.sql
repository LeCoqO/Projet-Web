/*------------ADD DATA IN LIVREUR-----------------*/
INSERT INTO `livreur` (`IdLivreur`, `Nom`, `Prenom`, `Tel`, `NumSS`, `DateArchiv`) 
VALUES ('1', 'Page', 'Lilian', '0771718751', '10364123587321', '2022-03-18');


/*------------ADD DATA IN COMMANDE----------------*/
INSERT INTO `commande` (`NumCom`, `NomClient`, `TelClient`, `AdrClient`, `CP_Client`, `VilClient`, `Date`, `HeureDispo`, `TypeEmbal`, `A_Livrer`, `EtatLivraison`, `CoutLiv`, `DateArchiv`, `EtatCde`, `TotalTTC`, `IdLivreur`) 
VALUES ('1', 'Torres', '0771718751', '59 grande rue saint cosme', '71100', 'Chalon-sur-Sôane', '2022-03-18', '19:56:51', 'c', 'N', 'N', '3', '2022-03-18', 'A_livrer', '15.5', '1');

INSERT INTO `commande` (`NumCom`, `NomClient`, `TelClient`, `AdrClient`, `CP_Client`, `VilClient`, `Date`, `HeureDispo`, `TypeEmbal`, `A_Livrer`, `EtatLivraison`, `CoutLiv`, `DateArchiv`, `EtatCde`, `TotalTTC`, `IdLivreur`) 
VALUES ('2', 'Corentin', '0771718751', '01 grande rue saint cosme', '71100', 'Chalon-sur-Sôane', '2022-03-18', '19:56:51', 'c', 'N', 'N', '3', '2022-03-18', 'A_livrer', '15.5', '1');


/*------------ADD DATA IN PRODUIT-----------------*/

INSERT INTO `produit` (`IdProd`, `NomProd`, `Taille`, `NbIngBase`, `NbIngOpt`, `PrixUHT`, `Image`, `IngBase1`, `IngBase2`, `IngBase3`, `IngBase4`, `IngBase5`, `IngOpt1`, `IngOpt2`, `IngOpt3`, `IngOpt4`, `IngOpt5`, `IngOpt6`, `NbOptMax`, `DateArchiv`) 
VALUES ('1', 'Oburger', 'L', '4', '1', '9.99', './img/Oburger.PNG', 'Pain sésame', 'Boeuf', 'Tomate', 'Salade', NULL, 'Sauce Moustache', NULL, NULL, NULL, NULL, NULL, '3', '2022-03-18')

INSERT INTO `produit` (`IdProd`, `NomProd`, `Taille`, `NbIngBase`, `NbIngOpt`, `PrixUHT`, `Image`, `IngBase1`, `IngBase2`, `IngBase3`, `IngBase4`, `IngBase5`, `IngOpt1`, `IngOpt2`, `IngOpt3`, `IngOpt4`, `IngOpt5`, `IngOpt6`, `NbOptMax`, `DateArchiv`) 
VALUES ('2', 'Tac original', 'L', '4', '1', '11.99', './img/Tac_Original.png', 'Pain sésame', 'Pain tacos', 'Boeuf', 'frite', NULL, 'Sauce Blanche', NULL, NULL, NULL, NULL, NULL, '3', '2022-03-18')




/*------------ADD DATA IN COM_DET-----------------*/
/*------------ADD DATA IN DETAIL------------------*/
/*------------ADD DATA IN DET_INGR----------------*/
/*------------ADD DATA IN FOURNISSEUR-------------*/
/*------------ADD DATA IN FOURM_INGR--------------*/
/*------------ADD DATA IN INGREDIENT--------------*/

/*------------ADD DATA IN PRODUIT_INGR------------*/
