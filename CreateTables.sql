DROP TABLE IF EXISTS player;

CREATE TABLE player(
	id INT NOT NULL,
	first_name VARCHAR(64), 
	last_name VARCHAR(64), 
	age INT,
	price INT,
	PRIMARY KEY ( id )
);

SELECT * FROM player;


DROP TABLE IF EXISTS player_team;
CREATE TABLE player_team(
	player_id INTEGER NOT NULL,
	team_id INTEGER NOT NULL,
	expiration_date DATE,
	PRIMARY KEY ( player_id , team_id )
);
SELECT * FROM player_team;

DROP TABLE IF EXISTS "team";
CREATE TABLE "team"(
	"id" INTEGER NOT NULL,
	"name" VARCHAR(256),
	"coach" INTEGER,
	"captain" INTEGER,
	"main-stadium" INTEGER,
	"budget" INTEGER,
	PRIMARY KEY ( "id" )
);
SELECT * FROM "team";

DROP TABLE IF EXISTS "referee";
CREATE TABLE "referee"(
	"id" INTEGER NOT NULL,
	"first-name" VARCHAR(64), 
	"last-name" VARCHAR(64), 
	"age" INTEGER,
	PRIMARY KEY ( "id" )
);
SELECT * FROM "referee";

DROP TABLE IF EXISTS "stadium";
CREATE TABLE "stadium"(
	"id" INTEGER NOT NULL,
	"name" VARCHAR(128),
	"capacity" INTEGER,
	"age" INTEGER,
	PRIMARY KEY ( "id" )
);
SELECT * FROM "stadium";


DROP TABLE IF EXISTS "match";
CREATE TABLE "match"(
	"id" INTEGER NOT NULL,
	"home-id" INTEGER NOT NULL,
	"away-id" INTEGER NOT NULL,
	"home-goals" INTEGER NOT NULL,
	"away-goals" INTEGER NOT NULL,
	"referee-id" INTEGER,
	"stadium-id" INTEGER,
	"total-attendance" INTEGER,
	PRIMARY KEY ( "id" )
);
SELECT * FROM "match";



DELETE FROM "stadium";
INSERT INTO "stadium" ( id , name , capacity , age ) VALUES( 1 , 'azadi' , 100000 , 40);
INSERT INTO "stadium" ( id , name , capacity , age ) VALUES( 2 , 'azadi' , 100000 , 40);
SELECT * FROM "stadium";























