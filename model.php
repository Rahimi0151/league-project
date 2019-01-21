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
                SELECT * FROM "player"
            ';
            return $this->db->query($query);
        }



    }
















