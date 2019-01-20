<?php
    require_once 'vendor/autoload.php';

    class insert{

        public $faker;
        public $db;

        public function __construct(){
            $this->faker = Faker\Factory::create();
            $this->db = database_connector::new_database_connection();
        }

        public function find_how_many_rows_was_already_inserted_in($table){
            $query = "
                SELECT COUNT(*) FROM \"$table\" "
            ;
            foreach ($this->db->query($query) as $row){
                return $row['count'];
            }
        }

        public function remove_all_data_from_table($table){
            $query = "
                DELETE FROM \"$table\";
            ";
            $this->db->exec($query);
            echo $query;
        }

        /*
            creating query string SECTION
        */
        
        public function create_query_string_for_inserting_into_stadium(){

            $id = $this->find_how_many_rows_was_already_inserted_in('stadium') + 1;
            $name = $this->faker->lastName;
            $capacity = rand( 1 , 10 ) * 10000 ;
            $age = rand( 0 , 100 );
            
            $query = "
                INSERT INTO \"stadium\" ( \"id\" , \"name\" , \"capacity\" , \"age\" )
                VALUES ( $id , '$name' , $capacity , $age ); 
            ";

            return $query;
        }

        public function create_query_string_for_inserting_into_player(){

            $id = $this->find_how_many_rows_was_already_inserted_in('player') + 1;
            $first_name = $this->faker->firstName('male');
            $last_name = $this->faker->lastName;
            $price = rand( 1 , 10 ) * 10000 ;
            $age = rand( 16 , 40 );
            
            $query = "
                INSERT INTO \"player\" ( \"id\" , \"first-name\" , \"last-name\" , \"age\" , \"price\" )
                VALUES ( $id , '$first_name' , '$last_name' , $age , $price ); 
            ";

            return $query;
        }

        public function create_query_string_for_inserting_into_team(){

            $id = $this->find_how_many_rows_was_already_inserted_in('team') + 1;
            $name = $this->faker->lastName;
            $coach = $this->faker->name;
            $captain = $this->faker->name;
            $main_stadium = rand( 1 , $this->find_how_many_rows_was_already_inserted_in('stadium') );
            $budget = rand( 15 , 100 ) * 1000 * 1000 ;
            
            $query = "
                INSERT INTO \"team\" ( \"id\" , \"name\" , \"coach\" ,
                 \"captain\" , \"main-stadium\" , \"budget\" )
                VALUES ( $id , '$name' , '$coach' , '$captain' , $main_stadium , $budget ); 
            ";

            return $query;
        }

        public function create_query_string_for_inserting_into_contract(){

            $id = $this->find_how_many_rows_was_already_inserted_in('contract') + 1;
            $player_id = $this->find_how_many_rows_was_already_inserted_in('contract') + 1;
            $team_id = rand( 1 , $this->find_how_many_rows_was_already_inserted_in('team') );
            $expiration_date = rand( 2019 , 2030 );
            $query = "
                INSERT INTO \"contract\" ( \"id\" , \"player-id\" , \"team-id\" , \"expiration-date\" )
                VALUES ( $id , $player_id , $team_id , $expiration_date ); 
            ";

            return $query;
        }

        public function create_query_string_for_inserting_into_referee(){

            $id = $this->find_how_many_rows_was_already_inserted_in('referee') + 1;
            $first_name = $this->faker->firstName('male');
            $last_name = $this->faker->lastName;
            $age = rand( 23 , 50 );
            $query = "
                INSERT INTO \"referee\" ( \"id\" , \"first-name\" , \"last-name\" , \"age\" )
                VALUES ( $id , '$first_name' , '$last_name' , $age ); 
            ";

            return $query;
        }

        public function create_query_string_for_inserting_into_match(){

            $id = $this->find_how_many_rows_was_already_inserted_in('match') + 1;
            $home_id = rand( 0 , $this->find_how_many_rows_was_already_inserted_in('team') );
            $away_id = rand( 0 , $this->find_how_many_rows_was_already_inserted_in('team') );
            $referee_id = rand( 0 , $this->find_how_many_rows_was_already_inserted_in('referee') );
            $stadium_id = rand( 0 , $this->find_how_many_rows_was_already_inserted_in('stadium') );
            $home_goals = rand( 0 , 5 );
            $away_goals = rand( 0 , 5 );
            $total_attendance = rand( 0 , 100*1000 );
            
            $query = "
                INSERT INTO \"match\" ( \"id\" , \"home-id\" ,
                 \"away-id\" , \"referee-id\" , \"stadium-id\" ,
                  \"home-goals\" , \"away-goals\", \"total-attendance\" )
                VALUES ( $id , '$home_id' , '$away_id' , $referee_id ,
                $stadium_id , $home_goals , $away_goals , $total_attendance ); 
            ";

            return $query;
        }

        public function create_query_string_for_inserting_into($table){{
            switch ($table) {

                case 'stadium':
                    return $this->create_query_string_for_inserting_into_stadium();

                case 'player':
                    return $this->create_query_string_for_inserting_into_player();

                case 'team':
                    return $this->create_query_string_for_inserting_into_team();
                
                case 'contract':
                    return $this->create_query_string_for_inserting_into_contract();

                case 'referee':
                    return $this->create_query_string_for_inserting_into_referee();

                case 'match':
                    return $this->create_query_string_for_inserting_into_match();

                default:
                    return null;
            }
        }}

        public function insert_fake_data_into( $table , $how_many ){
            for( $i = 0 ; $i < $how_many ; $i++ ){
                $query = $this->create_query_string_for_inserting_into($table);
                echo $query;
                try{
                    $this->db->exec($query);
                }
                catch(exception $e){
                    echo "$e </hr>";
                }
            }
        }

        public function ininialize_database_with_fake_data($timeout){
            
            $this->insert_fake_data_into( 'player' , 10 );
            sleep($timeout);
            $this->insert_fake_data_into( 'stadium' , 10 );
            sleep($timeout);
            $this->insert_fake_data_into( 'team' , 10 );
            sleep($timeout);
            $this->insert_fake_data_into( 'contract' , 10 );
            sleep($timeout);
            $this->insert_fake_data_into( 'referee' , 10 );
            sleep($timeout);
            $this->insert_fake_data_into( 'match' , 10 );
        }

    }