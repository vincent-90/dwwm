#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: dwwm_grades
#------------------------------------------------------------

CREATE TABLE dwwm_grades(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (30) NOT NULL
	,CONSTRAINT dwwm_grades_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: dwwm_users
#------------------------------------------------------------

CREATE TABLE dwwm_users(
        id             Int  Auto_increment  NOT NULL ,
        username       Varchar (30) NOT NULL ,
        mail           Varchar (100) NOT NULL ,
        password       Char (100) NOT NULL ,
        avatar         Varchar (255) NOT NULL ,
        id_dwwm_grades Int NOT NULL
	,CONSTRAINT dwwm_users_PK PRIMARY KEY (id)

	,CONSTRAINT dwwm_users_dwwm_grades_FK FOREIGN KEY (id_dwwm_grades) REFERENCES dwwm_grades(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: dwwm_status
#------------------------------------------------------------

CREATE TABLE dwwm_status(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (30) NOT NULL
	,CONSTRAINT dwwm_status_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: dwwm_consoles
#------------------------------------------------------------

CREATE TABLE dwwm_consoles(
        id             Int  Auto_increment  NOT NULL ,
        name           Varchar (100) NOT NULL ,
        image          Varchar (255) NOT NULL ,
        summary        Text NOT NULL ,
        date           Date NOT NULL ,
        id_dwwm_status Int NOT NULL ,
        id_dwwm_users  Int NOT NULL
	,CONSTRAINT dwwm_consoles_PK PRIMARY KEY (id)

	,CONSTRAINT dwwm_consoles_dwwm_status_FK FOREIGN KEY (id_dwwm_status) REFERENCES dwwm_status(id)
	,CONSTRAINT dwwm_consoles_dwwm_users0_FK FOREIGN KEY (id_dwwm_users) REFERENCES dwwm_users(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: dwwm_games
#------------------------------------------------------------

CREATE TABLE dwwm_games(
        id               Int  Auto_increment  NOT NULL ,
        image            Varchar (255) NOT NULL ,
        title            Varchar (100) NOT NULL ,
        summary          Text NOT NULL ,
        date             Date NOT NULL ,
        id_dwwm_users    Int NOT NULL ,
        id_dwwm_consoles Int NOT NULL ,
        id_dwwm_status   Int NOT NULL
	,CONSTRAINT dwwm_games_PK PRIMARY KEY (id)

	,CONSTRAINT dwwm_games_dwwm_users_FK FOREIGN KEY (id_dwwm_users) REFERENCES dwwm_users(id)
	,CONSTRAINT dwwm_games_dwwm_consoles0_FK FOREIGN KEY (id_dwwm_consoles) REFERENCES dwwm_consoles(id)
	,CONSTRAINT dwwm_games_dwwm_status1_FK FOREIGN KEY (id_dwwm_status) REFERENCES dwwm_status(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: dwwm_comments
#------------------------------------------------------------

CREATE TABLE dwwm_comments(
        id               Int  Auto_increment  NOT NULL ,
        text             Text NOT NULL ,
        dateHour         Datetime NOT NULL ,
        id_dwwm_users    Int NOT NULL ,
        id_dwwm_games    Int NOT NULL ,
        id_dwwm_consoles Int NOT NULL ,
        id_dwwm_status   Int NOT NULL
	,CONSTRAINT dwwm_comments_PK PRIMARY KEY (id)

	,CONSTRAINT dwwm_comments_dwwm_users_FK FOREIGN KEY (id_dwwm_users) REFERENCES dwwm_users(id)
	,CONSTRAINT dwwm_comments_dwwm_games0_FK FOREIGN KEY (id_dwwm_games) REFERENCES dwwm_games(id)
	,CONSTRAINT dwwm_comments_dwwm_consoles1_FK FOREIGN KEY (id_dwwm_consoles) REFERENCES dwwm_consoles(id)
	,CONSTRAINT dwwm_comments_dwwm_status2_FK FOREIGN KEY (id_dwwm_status) REFERENCES dwwm_status(id)
)ENGINE=InnoDB;

