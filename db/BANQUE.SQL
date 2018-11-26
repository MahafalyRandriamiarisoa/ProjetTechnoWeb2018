DROP DATABASE IF EXISTS MLR7;

CREATE DATABASE IF NOT EXISTS MLR7;
USE MLR7;
# -----------------------------------------------------------------------------
#       TABLE : TYPEMOTIF
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS TYPEMOTIF
 (
   MOTIF CHAR(32) NOT NULL  ,
   PIECE_A_FOURNIR CHAR(32) NULL  
   , PRIMARY KEY (MOTIF) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : OPERATION
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS OPERATION
 (
   NUMOPERATION CHAR(32) NOT NULL  ,
   NUMCLIENT CHAR(32) NOT NULL  ,
   NOMCOMPTE CHAR(32) NOT NULL  ,
   MONTANT CHAR(32) NULL  ,
   DATEOP CHAR(32) NULL  ,
   TYPEOP CHAR(32) NULL  
   , PRIMARY KEY (NUMOPERATION) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE OPERATION
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_OPERATION_COMPTE
     ON OPERATION (NUMCLIENT ASC,NOMCOMPTE ASC);

# -----------------------------------------------------------------------------
#       TABLE : CONTRAT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CONTRAT
 (
   IDCONTRAT INTEGER(2) NOT NULL  ,
   NUMCLIENT CHAR(32) NOT NULL  ,
   DATEOUVERTURE DATE NULL  ,
   LIBELLE CHAR(32) NULL  
   , PRIMARY KEY (IDCONTRAT) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE CONTRAT
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_CONTRAT_CLIENT
     ON CONTRAT (NUMCLIENT ASC);

# -----------------------------------------------------------------------------
#       TABLE : CLIENT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CLIENT
 (
   NUMCLIENT CHAR(32) NOT NULL  ,
   IDEMPLOYE CHAR(32) NOT NULL  ,
   DATENAISSANCE DATE NULL  ,
   NOM CHAR(32) NULL  ,
   PRENOM CHAR(32) NULL  ,
   NUMTEL CHAR(10) NULL  ,
   EMAIL CHAR(64) NULL  
   , PRIMARY KEY (NUMCLIENT) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE CLIENT
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_CLIENT_EMPLOYE
     ON CLIENT (IDEMPLOYE ASC);

# -----------------------------------------------------------------------------
#       TABLE : EMPLOYE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS EMPLOYE
 (
   IDEMPLOYE CHAR(32) NOT NULL  ,
   LOGIN CHAR(32) NULL  ,
   MDP CHAR(32) NULL  ,
   CATEGORIE CHAR(32) NULL  
   , PRIMARY KEY (IDEMPLOYE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : RENDEZVOUS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS RENDEZVOUS
 (
   IDRDV CHAR(32) NOT NULL  ,
   IDEMPLOYE CHAR(32) NOT NULL  ,
   MOTIF CHAR(32) NOT NULL  ,
   NUMCLIENT CHAR(32) NOT NULL  ,
   DATEHEURE DATETIME NULL  
   , PRIMARY KEY (IDRDV) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE RENDEZVOUS
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_RENDEZVOUS_EMPLOYE
     ON RENDEZVOUS (IDEMPLOYE ASC);

CREATE  INDEX I_FK_RENDEZVOUS_TYPEMOTIF
     ON RENDEZVOUS (MOTIF ASC);

CREATE  INDEX I_FK_RENDEZVOUS_CLIENT
     ON RENDEZVOUS (NUMCLIENT ASC);

# -----------------------------------------------------------------------------
#       TABLE : COMPTE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS COMPTE
 (
   NUMCLIENT CHAR(32) NOT NULL  ,
   NOMCOMPTE CHAR(32) NOT NULL  ,
   DATEOUVERTURE DATE NULL  ,
   SOLDE DOUBLE PRECISION(13,2) NULL  ,
   MONTANTDECOUVERT DOUBLE PRECISION(13,2) NULL  
   , PRIMARY KEY (NUMCLIENT,NOMCOMPTE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE COMPTE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_COMPTE_CLIENT
     ON COMPTE (NUMCLIENT ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE OPERATION 
  ADD FOREIGN KEY FK_OPERATION_COMPTE (NUMCLIENT,NOMCOMPTE)
      REFERENCES COMPTE (NUMCLIENT,NOMCOMPTE) ;


ALTER TABLE CONTRAT 
  ADD FOREIGN KEY FK_CONTRAT_CLIENT (NUMCLIENT)
      REFERENCES CLIENT (NUMCLIENT) ;


ALTER TABLE CLIENT 
  ADD FOREIGN KEY FK_CLIENT_EMPLOYE (IDEMPLOYE)
      REFERENCES EMPLOYE (IDEMPLOYE) ;


ALTER TABLE RENDEZVOUS 
  ADD FOREIGN KEY FK_RENDEZVOUS_EMPLOYE (IDEMPLOYE)
      REFERENCES EMPLOYE (IDEMPLOYE) ;


ALTER TABLE RENDEZVOUS 
  ADD FOREIGN KEY FK_RENDEZVOUS_TYPEMOTIF (MOTIF)
      REFERENCES TYPEMOTIF (MOTIF) ;


ALTER TABLE RENDEZVOUS 
  ADD FOREIGN KEY FK_RENDEZVOUS_CLIENT (NUMCLIENT)
      REFERENCES CLIENT (NUMCLIENT) ;


ALTER TABLE COMPTE 
  ADD FOREIGN KEY FK_COMPTE_CLIENT (NUMCLIENT)
      REFERENCES CLIENT (NUMCLIENT) ;

