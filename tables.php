<?php
    require "database_connector.php";

    class tables{

        public $db;
    
        public function __construct(){
            $this->db = database_connector::new_database_connection();
        }

        //CREATE

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
                    "coach" VARCHAR(256),
                    "captain" VARCHAR(256),
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
                    "id" INTEGER NOT NULL,
                    "player-id" INTEGER NOT NULL,
                    "team-id" INTEGER NOT NULL,
                    "expiration-date" INTEGER,
                    UNIQUE ( "player-id" ),
                    PRIMARY KEY ( "id" ),
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

        //DROP

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

        //INDEX

        public function create_index_on_player(){
            $query = '
                CREATE INDEX "player_age" ON "player" ("age");
            ';
            $this->db->exec($query);
        }

        public function create_index_on_team(){
            $query = '
                CREATE INDEX "team_budget" ON "team" ("budget");
            ';
            $this->db->exec($query);
        }

        public function create_index_on_contract(){
            $query = '
                CREATE INDEX "contract_expire" ON "contract" ("expiration-date");
            ';
            $this->db->exec($query);
        }

        public function create_index_on_referee(){
            $query = '
                CREATE INDEX "referee_age" ON "referee" ("age");
            ';
            $this->db->exec($query);
        }

        public function create_index_on_stadium(){
            $query = '
                CREATE INDEX "stadium_capacity" ON "stadium" ("capacity");
            ';
            $this->db->exec($query);
        }

        public function create_index_on_standing(){
            $query = '
                CREATE INDEX "standing_point" ON "standing" ("total-points");
            ';
            $this->db->exec($query);
        }

        //TRIGGER

        public function create_trigger_inserting_into_standing_table(){
            $query = '
            CREATE OR REPLACE FUNCTION insert_into_standing ()
            RETURNS trigger AS
            $$
                BEGIN
                    INSERT INTO standing ("team-id" , "goal-for") VALUES ( NEW."home-id" , NEW."home-goals" )
                END
            $$
            LANGUAGE plpgsql;

            CREATE TRIGGER insert_into_standing_trigger 
                AFTER INSERT ON "match" 
                FOR EACH ROW 
                EXECUTE PROCEDURE insert_into_standing();
            ';
            $this->db->exec($query);
        }

        public function create_trigger_dont_insert_or_delete_into_standing(){
            $query = '
            CREATE OR REPLACE FUNCTION dont_insert_or_delete_into_standing ()
                RETURNS trigger AS
                    $$
                        BEGIN
                            RAISE NOTICE '."'cant insert or delete from this table'".';
                            RETURN NULL;
                        END
                    $$
                LANGUAGE plpgsql;

                CREATE TRIGGER dont_insert_or_delete_into_standing 
                    BEFORE INSERT ON "standing" 
                    FOR EACH ROW 
                    EXECUTE PROCEDURE dont_insert_or_delete_into_standing();    
            ';
            $this->db->exec($query);
        }

        public function create_trigger_dont_delete_match(){
            $query = '
            CREATE OR REPLACE FUNCTION dont_delete_match()
                RETURNS trigger AS
                    $$
                        BEGIN
                            RAISE NOTICE '."'Cant remove any match'".';
                            RETURN NULL;
                        END
                    $$
                    LANGUAGE plpgsql;

                CREATE TRIGGER dont_delete_match
                    BEFORE DELETE ON "match" 
                    FOR EACH ROW 
                    EXECUTE PROCEDURE dont_delete_match();

            ';
            $this->db->exec($query);
        }

        public function create_trigger_dont_delete_contract(){
            $query = '
            CREATE OR REPLACE FUNCTION dont_delete_contract()
                RETURNS trigger AS
                    $$
                        BEGIN
                            RAISE NOTICE '."'Cant revoke any contract'".';
                            RETURN NULL;
                        END
                    $$
                    LANGUAGE plpgsql;

                CREATE TRIGGER dont_delete_contract
                    BEFORE DELETE ON "contract" 
                    FOR EACH ROW 
                    EXECUTE PROCEDURE dont_delete_contract();

            ';
            $this->db->exec($query);
        }

        //DROP TRIGGERS

        public function drop_trigger_inserting_into_standing_table(){
            $query = '
                DROP TRIGGER insert_into_standing ON "match";
                DROP FUNCTION insert_into_standing_trigger ();
            ';
            $this->db->exec($query);
        }

        public function drop_trigger_dont_insert_or_delete_into_standing(){
            $query = '
                DROP TRIGGER dont_insert_or_delete_into_standing ON "standing";
                DROP FUNCTION dont_insert_or_delete_into_standing();
            ';
            $this->db->exec($query);
        }

        public function drop_trigger_dont_delete_match(){
            $query = '
                DROP TRIGGER dont_delete_match ON "match";
                DROP FUNCTION dont_delete_match();
            ';
            $this->db->exec($query);
        }

        public function drop_trigger_dont_delete_contract(){
            $query = '
                DROP TRIGGER dont_delete_contract ON "contract";
                DROP FUNCTION dont_delete_contract();
            ';
            $this->db->exec($query);
        }

        //SUM

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

        public function create_all_indexes(){
            $this->create_index_on_player();
            $this->create_index_on_team();
            $this->create_index_on_contract();
            $this->create_index_on_referee();
            $this->create_index_on_stadium();
            $this->create_index_on_standing();
        }

        public function create_all_triggers(){
            $this->create_trigger_inserting_into_standing_table();
            $this->create_trigger_dont_insert_or_delete_into_standing();
            $this->create_trigger_dont_delete_match();
            $this->create_trigger_dont_delete_contract();
        }

        public function drop_all_triggers(){
            $this->drop_trigger_inserting_into_standing_table();
            $this->drop_trigger_dont_insert_or_delete_into_standing();
            $this->drop_trigger_dont_delete_match();
        }
    }