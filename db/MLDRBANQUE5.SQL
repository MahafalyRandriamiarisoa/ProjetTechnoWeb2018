DROP DATABASE IF EXISTS MLDRBANQUE5;

CREATE DATABASE IF NOT EXISTS MLDRBANQUE5;
USE MLDRBANQUE5;
# -----------------------------------------------------------------------------
#       TABLE : TYPEMOTIF
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS TYPEMOTIF
 (
   IDPIECE_A_FOURNIR INTEGER NOT NULL  ,
   IDMOTIF INTEGER NOT NULL AUTO_INCREMENT ,
   LIBELLEMOTIF CHAR(32) NULL  
   , PRIMARY KEY (IDPIECE_A_FOURNIR,IDMOTIF) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : OPERATION
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS OPERATION
 (
   NUMOP INTEGER NOT NULL AUTO_INCREMENT ,
   NUMCLIENT INTEGER NOT NULL  ,
   NOMCOMPTE CHAR(32) NOT NULL  ,
   MONTANT DOUBLE PRECISION(13,2) NULL  ,
   DATEHEUREOP DATETIME NULL  ,
   TYPEOP CHAR(32) NULL  
   , PRIMARY KEY (NUMOP) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : CONTRAT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CONTRAT
 (
   IDCONTRAT INTEGER NOT NULL AUTO_INCREMENT ,
   LIBELLE CHAR(32) NULL  
   , PRIMARY KEY (IDCONTRAT) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : CLIENT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CLIENT
 (
   NUMCLIENT INTEGER NOT NULL AUTO_INCREMENT ,
   IDEMPLOYE INTEGER NOT NULL  ,
   NOM CHAR(32) NULL  ,
   PRENOM CHAR(32) NULL  ,
   DATEDENAISSANCE DATE NULL  ,
   ADRESSE TEXT NULL  ,
   EMAIL CHAR(32) NULL  ,
   NUMEROTELEPHONE CHAR(14) NULL  ,
   SITUATIONFAMILIALE CHAR(32) NULL  ,
   PROFESSION CHAR(32) NULL  
   , PRIMARY KEY (NUMCLIENT) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : PIECES_A_FOURNIR
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS PIECES_A_FOURNIR
 (
   IDPIECE_A_FOURNIR INTEGER NOT NULL AUTO_INCREMENT ,
   LIBELLE_PIECES_A_FOURNIR CHAR(32) NULL  
   , PRIMARY KEY (IDPIECE_A_FOURNIR) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : EMPLOYE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS EMPLOYE
 (
   IDEMPLOYE INTEGER NOT NULL AUTO_INCREMENT ,
   LOGIN CHAR(32) NULL  ,
   MDP CHAR(32) NULL  ,
   CATEGORIE CHAR(32) NULL  ,
   NOMEMPLOYE CHAR(32) NULL  
   , PRIMARY KEY (IDEMPLOYE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : RENDEZVOUS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS RENDEZVOUS
 (
   IDRDV BIGINT(4) NOT NULL AUTO_INCREMENT ,
   IDEMPLOYE INTEGER NOT NULL  ,
   IDPIECE_A_FOURNIR INTEGER NOT NULL  ,
   IDMOTIF INTEGER NOT NULL  ,
   NUMCLIENT INTEGER NOT NULL  ,
   DATEHEURERDV DATETIME NULL  
   , PRIMARY KEY (IDRDV) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : COMPTE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS COMPTE
 (
   NOMCOMPTE CHAR(32) NOT NULL  
   , PRIMARY KEY (NOMCOMPTE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : COMPTECLIENT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS COMPTECLIENT
 (
   NUMCLIENT INTEGER NOT NULL  ,
   NOMCOMPTE CHAR(32) NOT NULL  ,
   DATEOUVERTURE DATE NULL  ,
   SOLDE DOUBLE PRECISION(13,2) NULL  ,
   MONTANTDECOUVERT DOUBLE PRECISION(13,2) NULL  
   , PRIMARY KEY (NUMCLIENT,NOMCOMPTE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : CONTRATCLIENT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CONTRATCLIENT
 (
   IDCONTRAT INTEGER NOT NULL  ,
   NUMCLIENT INTEGER NOT NULL  ,
   DATEOUVERTURECONTRAT DATE NULL  ,
   TARIFMENSUEL DOUBLE PRECISION(13,2) NULL  
   , PRIMARY KEY (IDCONTRAT,NUMCLIENT) 
 ) 
 comment = "";


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
  ADD FOREIGN KEY FK_RENDEZVOUS_TYPEMOTIF (IDPIECE_A_FOURNIR,IDMOTIF)
      REFERENCES TYPEMOTIF (IDPIECE_A_FOURNIR,IDMOTIF) ;


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

