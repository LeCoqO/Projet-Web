/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  21/06/2021 03:35:23                      */
/*==============================================================*/


drop table if exists CATEGORIE;

drop table if exists COMMANDE;

drop table if exists LIGNECOMMANDE;

drop table if exists PRODUIT;

drop table if exists USER;

/*==============================================================*/
/* Table : CATEGORIE                                            */
/*==============================================================*/
create table CATEGORIE
(
   ID                   char(20) not null,
   NAME_CATEGORIE       varchar(100),
   primary key (ID)
);

/*==============================================================*/
/* Table : COMMANDE                                             */
/*==============================================================*/
create table COMMANDE
(
   IDCOMMANDE           int not null AUTO_INCREMENT,
   IDUSER               int not null,
   DATE                 date,
   primary key (IDCOMMANDE)
);

/*==============================================================*/
/* Table : LIGNECOMMANDE                                        */
/*==============================================================*/
create table LIGNECOMMANDE
(
   SKU                  int not null,
   IDCOMMANDE           int not null,
   QUANTITE             int,
   primary key (SKU, IDCOMMANDE)
);

/*==============================================================*/
/* Table : PRODUIT                                              */
/*==============================================================*/
create table PRODUIT
(
   SKU                  int not null,
   ID                   char(20) not null,
   NAME                 varchar(150),
   TYPE                 varchar(50),
   PRICE                float(8,2),
   UPC                  varchar(30),
   SHIPPING             real,
   DESCRIPTION          text,
   MANUFACTURER         varchar(50),
   MODEL                varchar(30),
   URL                  longtext,
   IMAGE                longtext,
   primary key (SKU)
);

/*==============================================================*/
/* Table : CART                                                 */
/*==============================================================*/

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(250) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*==============================================================*/
/* Table : USER                                                 */
/*==============================================================*/
create table USER
(
   IDUSER               int not null AUTO_INCREMENT,
   NOMUSER              varchar(50),
   PRENOMUSER           varchar(30),
   EMAIL                varchar(100),
   PASSWORD             longtext,
   primary key (IDUSER)
);

alter table COMMANDE add constraint FK_PASSER foreign key (IDUSER)
      references USER (IDUSER) on delete cascade on update cascade;

alter table LIGNECOMMANDE add constraint FK_LIGNECOMMANDE foreign key (IDCOMMANDE)
      references COMMANDE (IDCOMMANDE) on delete cascade on update cascade;

alter table LIGNECOMMANDE add constraint FK_LIGNECOMMANDE2 foreign key (SKU)
      references PRODUIT (SKU) on delete cascade on update cascade;

alter table PRODUIT add constraint FK_APPARTENIR foreign key (ID)
      references CATEGORIE (ID) on delete cascade on update cascade;

ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

