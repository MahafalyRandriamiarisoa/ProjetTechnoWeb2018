DROP DATABASE IF EXISTS BANQUE3;

CREATE DATABASE IF NOT EXISTS BANQUE3;
USE BANQUE3;
# -----------------------------------------------------------------------------
#       TABLE : TYPEMOTIF
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS TYPEMOTIF
 (
   MOTIF DB_TEXT, 32 NOT NULL  ,
   IDPIECE_A_FOURNIR DB_INTEGER(2) NOT NULL  ,
   LIBELLEMOTIF DB_TEXT, 32 NULL  
   , PRIMARY KEY (MOTIF) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE TYPEMOTIF
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_TYPEMOTIF_PIECES_A_FOURNIR
     ON TYPEMOTIF (IDPIECE_A_FOURNIR ASC);

# -----------------------------------------------------------------------------
#       TABLE : OPERATION
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS OPERATION
 (
   NUMOP DB_TEXT, 32 NOT NULL  ,
   NUMCLIENT DB_TEXT, 32 NOT NULL  ,
   NOMCOMPTE DB_TEXT, 32 NOT NULL  ,
   MONTANT DB_DOUBLE(13,2) NULL  ,
   DATEHEUREOP DB_DATE(12) NULL  ,
   TYPEOP DB_TEXT, 32 NULL  
   , PRIMARY KEY (NUMOP) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE OPERATION
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_OPERATION_CLIENT
     ON OPERATION (NUMCLIENT ASC);

CREATE  INDEX I_FK_OPERATION_COMPTE
     ON OPERATION (NOMCOMPTE ASC);

# -----------------------------------------------------------------------------
#       TABLE : CONTRAT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CONTRAT
 (
   IDCONTRAT DB_INTEGER(2) NOT NULL AUTO_INCREMENT ,
   DATEOUVERTURE DB_DATE(8) NULL  ,
   LIBELLE DB_TEXT, 32 NULL  
   , PRIMARY KEY (IDCONTRAT) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : CLIENT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CLIENT
 (
   NUMCLIENT DB_TEXT, 32 NOT NULL  ,
   IDEMPLOYE DB_INTEGER(2) NOT NULL  ,
   NOM DB_TEXT, 32 NULL  ,
   PRENOM DB_TEXT, 32 NULL  ,
   DATEDENAISSANCE DB_DATE(8) NULL  ,
   ADRESSE DB_TEXT(1000) NULL  ,
   EMAIL DB_TEXT, 32 NULL  ,
   NUMEROTELEPHONE DB_TEXT, 10 NULL  ,
   SITUATIONFAMILIALE DB_TEXT, 32 NULL  ,
   PROFESSION DB_TEXT, 32 NULL  
   , PRIMARY KEY (NUMCLIENT) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE CLIENT
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_CLIENT_EMPLOYE
     ON CLIENT (IDEMPLOYE ASC);

# -----------------------------------------------------------------------------
#       TABLE : PIECES_A_FOURNIR
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS PIECES_A_FOURNIR
 (
   IDPIECE_A_FOURNIR DB_INTEGER(2) NOT NULL AUTO_INCREMENT ,
   LIBELLE_PIECES_A_FOURNIR DB_TEXT, 32 NULL  
   , PRIMARY KEY (IDPIECE_A_FOURNIR) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : EMPLOYE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS EMPLOYE
 (
   IDEMPLOYE DB_INTEGER(2) NOT NULL AUTO_INCREMENT ,
   LOGIN DB_TEXT, 32 NULL  ,
   MDP DB_TEXT, 32 NULL  ,
   CATEGORIE DB_TEXT, 32 NULL  
   , PRIMARY KEY (IDEMPLOYE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : RENDEZVOUS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS RENDEZVOUS
 (
   IDRDV DB_LONG(4) NOT NULL  ,
   IDEMPLOYE DB_INTEGER(2) NOT NULL  ,
   MOTIF DB_TEXT, 32 NOT NULL  ,
   NUMCLIENT DB_TEXT, 32 NOT NULL  ,
   DATEHEURE DB_DATE(12) NULL  
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
   NOMCOMPTE DB_TEXT, 32 NOT NULL  
   , PRIMARY KEY (NOMCOMPTE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : COMPTECLIENT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS COMPTECLIENT
 (
   NUMCLIENT DB_TEXT, 32 NOT NULL  ,
   NOMCOMPTE DB_TEXT, 32 NOT NULL  ,
   DATEOUVERTURE DB_DATE(8) NULL  ,
   SOLDE DB_DOUBLE(13,2) NULL  ,
   MONTANTDECOUVERT DB_DOUBLE(13,2) NULL  
   , PRIMARY KEY (NUMCLIENT,NOMCOMPTE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE COMPTECLIENT
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_COMPTECLIENT_CLIENT
     ON COMPTECLIENT (NUMCLIENT ASC);

CREATE  INDEX I_FK_COMPTECLIENT_COMPTE
     ON COMPTECLIENT (NOMCOMPTE ASC);

# -----------------------------------------------------------------------------
#       TABLE : CONTRATCLIENT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CONTRATCLIENT
 (
   IDCONTRAT DB_INTEGER(2) NOT NULL  ,
   NUMCLIENT DB_TEXT, 32 NOT NULL  ,
   DATEOUVERTURECONTRAT DB_DATE(8) NULL  ,
   TARIFMENSUEL DB_DOUBLE(13,2) NULL  
   , PRIMARY KEY (IDCONTRAT,NUMCLIENT) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE CONTRATCLIENT
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_CONTRATCLIENT_CONTRAT
     ON CONTRATCLIENT (IDCONTRAT ASC);

CREATE  INDEX I_FK_CONTRATCLIENT_CLIENT
     ON CONTRATCLIENT (NUMCLIENT ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE TYPEMOTIF 
  ADD FOREIGN KEY FK_TYPEMOTIF_PIECES_A_FOURNIR (IDPIECE_A_FOURNIR)
      REFERENCES PIECES_A_FOURNIR (IDPIECE_A_FOURNIR) ;


ALTER TABLE OPERATION 
  ADD FOREIGN KEY FK_OPERATION_CLIENT (NUMCLIENT)
      REFERENCES CLIENT (NUMCLIENT) ;


ALTER TABLE OPERATION 
  ADD FOREIGN KEY FK_OPERATION_COMPTE (NOMCOMPTE)
      REFERENCES COMPTE (NOMCOMPTE) ;


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


ALTER TABLE COMPTECLIENT 
  ADD FOREIGN KEY FK_COMPTECLIENT_CLIENT (NUMCLIENT)
      REFERENCES CLIENT (NUMCLIENT) ;


ALTER TABLE COMPTECLIENT 
  ADD FOREIGN KEY FK_COMPTECLIENT_COMPTE (NOMCOMPTE)
      REFERENCES COMPTE (NOMCOMPTE) ;


ALTER TABLE CONTRATCLIENT 
  ADD FOREIGN KEY FK_CONTRATCLIENT_CONTRAT (IDCONTRAT)
      REFERENCES CONTRAT (IDCONTRAT) ;


ALTER TABLE CONTRATCLIENT 
  ADD FOREIGN KEY FK_CONTRATCLIENT_CLIENT (NUMCLIENT)
      REFERENCES CLIENT (NUMCLIENT) ;

