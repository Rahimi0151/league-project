<?php
    require "database_connector.php";

    class tables{

        public $db;
    
        public function __construct(){
            $this->db = database_connector::new_database_connection();
        }

        public function create_player_table(){
            $db = $this->db;
            $query = '
                DROP TABLE IF EXISTS "player";
                CREATE TABLE "player"(
                    "id" INT NOT NULL,
                    "first-name" VARCHAR(64), 
                    "last-name" VARCHAR(64), 
                    "age" INT,
                    "price" INT,
                    PRIMARY KEY ( "id" )
                );
                ';
                $db->exec($query);
        }
            
        public function create_stadium_table(){
            $query = '
                DROP TABLE IF EXISTS "stadium";
                CREATE TABLE "stadium"(
                    "id" INTEGER NOT NULL,
                    "name" VARCHAR(128),
                    "capacity" INTEGER,
                    "age" INTEGER,
                    PRIMARY KEY ( "id" )
                );
            ';
            $this->db->exec($query);
        }

        public function create_team_table(){
            $query = '
                DROP TABLE IF EXISTS "team";
                CREATE TABLE "team"(
                    "id" INTEGER NOT NULL,
                    "name" VARCHAR(256),
                    "coach" INTEGER,
                    "captain" INTEGER,
                    "main-stadium" INTEGER,
                    "budget" INTEGER,
                    PRIMARY KEY ( "id" ),
                    FOREIGN KEY ( "main-stadium" ) REFERENCES "stadium" ( "id" )
                );
            ';
            $this->db->exec($query);
        }

        public function create_contract_table(){
            $query = '
                DROP TABLE IF EXISTS "contract";
                CREATE TABLE "contract"(
                    "player-id" INTEGER NOT NULL,
                    "team-id" INTEGER NOT NULL,
                    "expiration-date" DATE,
                    PRIMARY KEY ( "player-id" , "team-id" ),
                    FOREIGN KEY ( "player-id" ) REFERENCES "player" ( "id" ),
                    FOREIGN KEY ( "team-id" ) REFERENCES "team" ( "id" )
                );            
            ';
            $this->db->exec($query);
        }

        public function create_referee_table(){
            $query = '
                DROP TABLE IF EXISTS "referee";
                CREATE TABLE "referee"(
                    "id" INTEGER NOT NULL,
                    "first-name" VARCHAR(64), 
                    "last-name" VARCHAR(64), 
                    "age" INTEGER,
                    PRIMARY KEY ( "id" )
                );
            ';
            $this->db->exec($query);
        }

        public function create_match_table(){
            $query = '
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
                    PRIMARY KEY ( "id" ),
                    FOREIGN KEY ( "home-id" ) REFERENCES "team" ( "id" ),
                    FOREIGN KEY ( "away-id" ) REFERENCES "team" ( "id" ),
                    FOREIGN KEY ( "referee-id" ) REFERENCES "referee" ( "id" ),
                    FOREIGN KEY ( "stadium-id" ) REFERENCES "stadium" ( "id" )
                );
            ';
            $this->db->exec($query);
        }

        public function create_standing_table(){
            $query = '
                DROP TABLE IF EXISTS "standing";
                CREATE TABLE "standing"(
                    "team-id" INTEGER NOT NULL,
                    "match-played" INTEGER,
                    "match-won" INTEGER,
                    "match-draw" INTEGER,
                    "match-lost" INTEGER,
                    "goal-for" INTEGER,
                    "goal-against" INTEGER,
                    "goal-difference" INTEGER,
                    "total-points" INTEGER,
                    PRIMARY KEY ( "team-id" ),
                    FOREIGN KEY ( "team-id" ) REFERENCES "team" ( "id" )
                );
            ';
            $this->db->exec($query);
        }

        public function drop_player_table(){
            $query = '
                DROP TABLE IF EXISTS "player";
            ';
            $this->db->exec($query);
        }

        public function drop_stadium_table(){
            $query = '
                DROP TABLE IF EXISTS "stadium";
            ';
            $this->db->exec($query);
        }

        public function drop_team_table(){
            $query = '
                DROP TABLE IF EXISTS "team";
            ';
            $this->db->exec($query);
        }

        public function drop_contract_table(){
            $query = '
                DROP TABLE IF EXISTS "contract";
            ';
            $this->db->exec($query);
        }

        public function drop_referee_table(){
            $query = '
                DROP TABLE IF EXISTS "referee";
            ';
            $this->db->exec($query);
        }

        public function drop_match_table(){
            $query = '
                DROP TABLE IF EXISTS "match";
            ';
            $this->db->exec($query);
        }

        public function drop_standing_table(){
            $query = '
                DROP TABLE IF EXISTS "standing";
            ';
            $this->db->exec($query);
        }

        public function create_all_tables(){
            $this->create_player_table();
            $this->create_stadium_table();
            $this->create_team_table();
            $this->create_contract_table();
            $this->create_referee_table();
            $this->create_match_table();
            $this->create_standing_table();
        }

        public function drop_all_tables(){
            $this->drop_standing_table();
            $this->drop_match_table();
            $this->drop_referee_table();
            $this->drop_contract_table();
            $this->drop_team_table();
            $this->drop_stadium_table();
            $this->drop_player_table();
        }
    





    
    }