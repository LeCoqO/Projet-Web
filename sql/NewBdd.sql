#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Fournisseur
#------------------------------------------------------------

CREATE TABLE Fournisseur(
        IdFourn      Int  Auto_increment  NOT NULL ,
        NomFourn     Char (25) NOT NULL ,
        AdresseFourn Char (30) NOT NULL ,
        CPFourni     Char (5) NOT NULL ,
        VilleFourn   Char (20) NOT NULL ,
        TelFourn     Char (12) NOT NULL ,
        DateArchiv   Date NOT NULL
	,CONSTRAINT Fournisseur_PK PRIMARY KEY (IdFourn)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Ingredient
#------------------------------------------------------------

CREATE TABLE Ingredient(
        IdIngred      Int NOT NULL ,
        NomIngred     Char (30) NOT NULL ,
        Frais         Char (1) NOT NULL ,
        TypeIngred    Char (1) NOT NULL ,
        Unite         Char (10) NOT NULL ,
        StockMin      Int NOT NULL ,
        StockReel     Float NOT NULL ,
        PrixUHT_Moyen Float NOT NULL ,
        Q_A_Com       Int NOT NULL ,
        DateArchiv    Date NOT NULL ,
        TypeDIngr     Char (1) NOT NULL
	,CONSTRAINT Ingredient_PK PRIMARY KEY (IdIngred)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Livreur
#------------------------------------------------------------

CREATE TABLE Livreur(
        IdLivreur  Int NOT NULL ,
        NomLiv     Char (20) NOT NULL ,
        PrenomLiv  Char (20) NOT NULL ,
        TelLiv     Char (20) NOT NULL ,
        NumSSLiv   Char (15) NOT NULL ,
        DateArchiv Date NOT NULL
	,CONSTRAINT Livreur_PK PRIMARY KEY (IdLivreur)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Commande
#------------------------------------------------------------

CREATE TABLE Commande(
        NumCom          Int  Auto_increment  NOT NULL ,
        NomClient       Varchar (25) NOT NULL ,
        TelClient       Varchar (12) NOT NULL ,
        AdrClient       Varchar (30) NOT NULL ,
        CP_Client       Char (5) NOT NULL ,
        VilClient       Char (20) NOT NULL ,
        Date            Date NOT NULL ,
        HeureDispo      Time NOT NULL ,
        TypeEmbal       Char (1) NOT NULL ,
        A_Livrer        Char (1) NOT NULL ,
        EtatLivraison   Char (1) NOT NULL ,
        CoutLiv         Float NOT NULL ,
        DateArchiv      Date NOT NULL ,
        EtatCde         Char (15) NOT NULL ,
        TotalTTC        Float NOT NULL ,
        IdLivreur       Int NOT NULL ,
        IdLivreur_Livre Int
	,CONSTRAINT Commande_PK PRIMARY KEY (NumCom)

	,CONSTRAINT Commande_Livreur_FK FOREIGN KEY (IdLivreur_Livre) REFERENCES Livreur(IdLivreur)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Produit
#------------------------------------------------------------

CREATE TABLE Produit(
        IdProd         Int NOT NULL ,
        NomProd        Char (20) NOT NULL ,
        TailleProd     Char (1) NOT NULL ,
        NbIngBase      Int NOT NULL ,
        NbIngOpt       Int NOT NULL ,
        PrixUHT        Float NOT NULL ,
        Image          Char (50) NOT NULL ,
        IngBase1       Char (20) NOT NULL ,
        IngBase2       Char (20) NOT NULL ,
        IngBase3       Char (20) NOT NULL ,
        IngBase4       Char (20) NOT NULL ,
        IngBase5       Char (20) NOT NULL ,
        IngOpti1       Char (20) NOT NULL ,
        IngOpti2       Char (20) NOT NULL ,
        IngOpti3       Char (20) NOT NULL ,
        IngOpti4       Char (20) NOT NULL ,
        IngOpti5       Char (20) NOT NULL ,
        IngOpti6       Char (20) NOT NULL ,
        NbOptMax       Int NOT NULL ,
        DateArchiv     Date NOT NULL ,
        Incontournable Char (1) NOT NULL
	,CONSTRAINT Produit_PK PRIMARY KEY (IdProd)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Detail
#------------------------------------------------------------

CREATE TABLE Detail(
        Num_OF         Int NOT NULL ,
        NomProd        Char (30) NOT NULL ,
        Taille         Char (1) NOT NULL ,
        IngBase1       Char (20) NOT NULL ,
        IngBase2       Char (20) NOT NULL ,
        IngBase3       Char (20) NOT NULL ,
        IngBase4       Char (20) NOT NULL ,
        IngOpt1        Char (20) NOT NULL ,
        IngOpt2        Char (20) NOT NULL ,
        IngOpt3        Char (20) NOT NULL ,
        IngOpt4        Char (20) NOT NULL ,
        DateArchiv     Date NOT NULL ,
        IdProd         Int NOT NULL ,
        Quant          Int NOT NULL ,
        NumCom         Int NOT NULL ,
        IdProd_Produit Int NOT NULL
	,CONSTRAINT Detail_PK PRIMARY KEY (Num_OF)

	,CONSTRAINT Detail_Commande_FK FOREIGN KEY (NumCom) REFERENCES Commande(NumCom)
	,CONSTRAINT Detail_Produit0_FK FOREIGN KEY (IdProd_Produit) REFERENCES Produit(IdProd)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Provient
#------------------------------------------------------------

CREATE TABLE Provient(
        IdIngred Int NOT NULL ,
        IdFourn  Int NOT NULL ,
        PrixUHT  Int NOT NULL
	,CONSTRAINT Provient_PK PRIMARY KEY (IdIngred,IdFourn)

	,CONSTRAINT Provient_Ingredient_FK FOREIGN KEY (IdIngred) REFERENCES Ingredient(IdIngred)
	,CONSTRAINT Provient_Fournisseur0_FK FOREIGN KEY (IdFourn) REFERENCES Fournisseur(IdFourn)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Comporte
#------------------------------------------------------------

CREATE TABLE Comporte(
        IdIngred Int NOT NULL ,
        IdProd   Int NOT NULL ,
        Quant    Int NOT NULL
	,CONSTRAINT Comporte_PK PRIMARY KEY (IdIngred,IdProd)

	,CONSTRAINT Comporte_Ingredient_FK FOREIGN KEY (IdIngred) REFERENCES Ingredient(IdIngred)
	,CONSTRAINT Comporte_Produit0_FK FOREIGN KEY (IdProd) REFERENCES Produit(IdProd)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Utilise
#------------------------------------------------------------

CREATE TABLE Utilise(
        Num_OF   Int NOT NULL ,
        IdIngred Int NOT NULL
	,CONSTRAINT Utilise_PK PRIMARY KEY (Num_OF,IdIngred)

	,CONSTRAINT Utilise_Detail_FK FOREIGN KEY (Num_OF) REFERENCES Detail(Num_OF)
	,CONSTRAINT Utilise_Ingredient0_FK FOREIGN KEY (IdIngred) REFERENCES Ingredient(IdIngred)
)ENGINE=InnoDB;

