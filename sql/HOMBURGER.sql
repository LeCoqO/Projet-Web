#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Fournisseur
#------------------------------------------------------------

CREATE TABLE Fournisseur(
        NomFourn        Char (25) NOT NULL ,
        AdresseFourn    Char (30) NOT NULL ,
        CPFourn         Char (5) NOT NULL ,
        VilleFourn      Char (20) NOT NULL ,
        TelFourn        Char (12) NOT NULL ,
        DateArchivFourn Date
	,CONSTRAINT Fournisseur_PK PRIMARY KEY (NomFourn)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Ingredient
#------------------------------------------------------------

CREATE TABLE Ingredient(
        IdIng         Int  Auto_increment  NOT NULL ,
        NomIng        Char (30) NOT NULL ,
        Frais         Char (1) NOT NULL ,
        Type          Char (1) NOT NULL ,
        Unite         Char (10) NOT NULL ,
        StockMin      Int NOT NULL ,
        StockReel     Float NOT NULL ,
        PrixUHT_Moyen Float NOT NULL ,
        Q_A_Com       Int NOT NULL ,
        DateArchivIng Date
	,CONSTRAINT Ingredient_PK PRIMARY KEY (IdIng)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Livreur
#------------------------------------------------------------

CREATE TABLE Livreur(
        IdLiv         Int  Auto_increment  NOT NULL ,
        NomLiv        Char (20) NOT NULL ,
        PrenomLiv     Char (20) NOT NULL ,
        TelLiv        Char (20) NOT NULL ,
        NumSSLiv      Char (15) NOT NULL ,
        DateArchivLiv Date
	,CONSTRAINT Livreur_PK PRIMARY KEY (IdLiv)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Commande
#------------------------------------------------------------

CREATE TABLE Commande(
        NumCom        Int  Auto_increment  NOT NULL ,
        NomCom        Varchar (25) NOT NULL ,
        TelCom        Varchar (12) NOT NULL ,
        AdrCom        Varchar (30) NOT NULL ,
        CPCom         Char (5) NOT NULL ,
        VilleCom      Char (20) NOT NULL ,
        DateCom       Date NOT NULL ,
        HeureDispo    Time NOT NULL ,
        TypeEmbal     Char (1) NOT NULL ,
        A_Livrer      Char (1) NOT NULL ,
        EtatLivraison Char (1) NOT NULL ,
        CoutLiv       Float NOT NULL ,
        DateArchivCom Date ,
        EtatCde       Char (15) NOT NULL ,
        TotalTTC      Float NOT NULL ,
        IdLiv         Int
	,CONSTRAINT Commande_PK PRIMARY KEY (NumCom)

	,CONSTRAINT Commande_Livreur_FK FOREIGN KEY (IdLiv) REFERENCES Livreur(IdLiv)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Produit
#------------------------------------------------------------

CREATE TABLE Produit(
        IdProd         Int  Auto_increment  NOT NULL ,
        NomProd        Char (20) NOT NULL ,
        Taille         Char (1) NOT NULL ,
        NbIngBase      Int NOT NULL ,
        NbIngOpt       Int NOT NULL ,
        PrixUHT        Float NOT NULL ,
        Image          Char (50) NOT NULL ,
        IngBase1       Char (20) ,
        IngBase2       Char (20) ,
        IngBase3       Char (20) ,
        IngBase4       Char (20) ,
        IngBase5       Char (20) ,
        IngOpti1       Char (20) ,
        IngOpti2       Char (20) ,
        IngOpti3       Char (20) ,
        IngOpti4       Char (20) ,
        IngOpti5       Char (20) ,
        IngOpti6       Char (20) ,
        NbOptMax       Int NOT NULL ,
        DateArchivProd Date ,
        Incontournable Char (1) NOT NULL
	,CONSTRAINT Produit_PK PRIMARY KEY (IdProd)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Detail
#------------------------------------------------------------

CREATE TABLE Detail(
        Num_OF         Int  Auto_increment  NOT NULL ,
        NomProd        Char (30) NOT NULL ,
        Taille         Char (1) NOT NULL ,
        IngBase1       Char (20) ,
        IngBase2       Char (20) ,
        IngBase3       Char (20) ,
        IngBase4       Char (20) ,
        IngOpt1        Char (20) ,
        IngOpt2        Char (20) ,
        IngOpt3        Char (20) ,
        IngOpt4        Char (20) ,
        DateArchivDet  Date ,
        IdProd         Int NOT NULL ,
        Quant          Int NOT NULL ,
        NumCom         Int NOT NULL ,
        IdProd_Produit Int NOT NULL
	,CONSTRAINT Detail_PK PRIMARY KEY (Num_OF)

	,CONSTRAINT Detail_Commande_FK FOREIGN KEY (NumCom) REFERENCES Commande(NumCom)
	,CONSTRAINT Detail_Produit0_FK FOREIGN KEY (IdProd_Produit) REFERENCES Produit(IdProd)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Gerant
#------------------------------------------------------------

CREATE TABLE Gerant(
        IdEmp       Int  Auto_increment  NOT NULL ,
        NomEmp      Varchar (20) NOT NULL ,
        PrenomEmp   Varchar (20) NOT NULL ,
        Identifient Varchar (20) NOT NULL ,
        MDPEmp      Varchar (20) NOT NULL
	,CONSTRAINT Gerant_PK PRIMARY KEY (IdEmp)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: FOURN_INGR
#------------------------------------------------------------

CREATE TABLE FOURN_INGR(
        IdIng    Int NOT NULL ,
        NomFourn Char (25) NOT NULL ,
        PrixUHT  Int NOT NULL
	,CONSTRAINT FOURN_INGR_PK PRIMARY KEY (IdIng,NomFourn)

	,CONSTRAINT FOURN_INGR_Ingredient_FK FOREIGN KEY (IdIng) REFERENCES Ingredient(IdIng)
	,CONSTRAINT FOURN_INGR_Fournisseur0_FK FOREIGN KEY (NomFourn) REFERENCES Fournisseur(NomFourn)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: PROD_INGR
#------------------------------------------------------------

CREATE TABLE PROD_INGR(
        IdIng  Int NOT NULL ,
        IdProd Int NOT NULL ,
        Quant  Int NOT NULL
	,CONSTRAINT PROD_INGR_PK PRIMARY KEY (IdIng,IdProd)

	,CONSTRAINT PROD_INGR_Ingredient_FK FOREIGN KEY (IdIng) REFERENCES Ingredient(IdIng)
	,CONSTRAINT PROD_INGR_Produit0_FK FOREIGN KEY (IdProd) REFERENCES Produit(IdProd)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: DET_INGR
#------------------------------------------------------------

CREATE TABLE DET_INGR(
        Num_OF Int NOT NULL ,
        IdIng  Int NOT NULL
	,CONSTRAINT DET_INGR_PK PRIMARY KEY (Num_OF,IdIng)

	,CONSTRAINT DET_INGR_Detail_FK FOREIGN KEY (Num_OF) REFERENCES Detail(Num_OF)
	,CONSTRAINT DET_INGR_Ingredient0_FK FOREIGN KEY (IdIng) REFERENCES Ingredient(IdIng)
)ENGINE=InnoDB;