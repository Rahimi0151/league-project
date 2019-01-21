<?php
    
    require_once('database_connector.php');

    class model{
        public $db;

        public function __construct(){
            $database = new database_connector();
            $this->db = $database->neww_database_connection();
        }

        public function retrive_all_players(){
            $query = '
                SELECT p.id , p."first-name" , p."last-name" , p.age , p.price , t.name as team
                FROM "player" p , "contract" c , "team" t
                WHERE c."team-id" = t.id AND c."player-id" = p.id;
            ';
            return $this->db->query($query);
        }

        public function retrive_all_teams(){
            $query = '
                SELECT t.id , t.name , t.coach , t.captain , t.budget , s.name as stadium 
                FROM "team" t , "stadium" s
                WHERE t.id = s.id;
            ';
            return $this->db->query($query);
        }


        public function retrive_all_stadiums(){
            $query = '
                SELECT * FROM "stadium";
            ';
            return $this->db->query($query);
        }

        public function retrive_all_matches(){
            $query = '
                SELECT 
                m.id , 
                t1.name AS "home-team" , 
                t2.name AS "away-team" , 
                m."home-goals" , 
                m."away-goals" , 
                r."last-name" AS referee , 
                s.name AS stadium , 
                m."total-attendance"
            FROM 
                "match" m , 
                "team" t1 , 
                "team" t2 , 
                "referee" r , 
                "stadium" s
            WHERE 
                m."home-id" = t1.id AND 
                m."away-id" = t2.id AND
                m."referee-id" = r.id AND
                m."stadium-id" = s.id;
            ';
            return $this->db->query($query);
        }






        



    }
















