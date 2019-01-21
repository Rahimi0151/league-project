<?php
    require_once 'vendor/autoload.php';

    class insert{

        public $faker;
        public $db;

        public function __construct(){
            $this->faker = Faker\Factory::create();
            $this->db = database_connector::new_database_connection();
        }

        public function remove_quotation_mark_of($string){
            return str_replace( "'" , "" , $string );
        }

        public function find_how_many_rows_was_already_inserted_in($table){
            $query = "
                SELECT COUNT(*) FROM \"$table\" "
            ;
            foreach ($this->db->query($query) as $row){
                return $row['count'];
            }
        }

        public function find_last_inserted_id_in($table){
            $query = "
                SELECT MAX(id) FROM \"$table\" "
            ;
            foreach ($this->db->query($query) as $row){
                return $row['max'];
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

        public function create_this_many_query_string_for_inserting_into_stadium($how_many){

            $id = $this->find_how_many_rows_was_already_inserted_in('stadium');
            $query = '';

            for ( $i = 0 ; $i < $how_many ; $i++ ){
                $id++;
                $name = $this->remove_quotation_mark_of($this->faker->lastName);
                $capacity = rand( 1 , 10 ) * 10000 ;
                $age = rand( 0 , 100 );
            
                $query .= "
                    INSERT INTO \"stadium\" ( \"id\" , \"name\" , \"capacity\" , \"age\" )
                    VALUES ( $id , '$name' , $capacity , $age ); 
                ";
            }
            return $query;
        }

        public function create_this_many_query_string_for_inserting_into_player($how_many){

            $id = $this->find_last_inserted_id_in('player');
            $query = '';

            for ( $i = 0 ; $i < $how_many ; $i++ ){
                $id++;
                $first_name = $this->remove_quotation_mark_of($this->faker->firstName('male'));
                $last_name = $this->remove_quotation_mark_of($this->faker->lastName);
                $price = rand( 1 , 10 ) * 10000 ;
                $age = rand( 16 , 40 );
                
                $query .= "
                    INSERT INTO \"player\" ( \"id\" , \"first-name\" , \"last-name\" , \"age\" , \"price\" )
                    VALUES ( $id , '$first_name' , '$last_name' , $age , $price ); 
                ";
            }
            return $query;
        }

        public function create_this_many_query_string_for_inserting_into_team($how_many){

            $id = $this->find_last_inserted_id_in('team');
            $stadium_count = $this->find_how_many_rows_was_already_inserted_in('stadium');
            $query = '';

            for ( $i = 0 ; $i < $how_many ; $i++ ){
                $id++;
                $name = $this->remove_quotation_mark_of( $this->faker->lastName );
                $coach = $this->remove_quotation_mark_of( $this->faker->name );
                $captain = $this->remove_quotation_mark_of( $this->faker->name );
                $main_stadium = rand( 1 , $stadium_count );
                $budget = rand( 15 , 100 ) * 1000 * 1000 ;
                
                $query .= "
                    INSERT INTO \"team\" ( \"id\" , \"name\" , \"coach\" ,
                     \"captain\" , \"main-stadium\" , \"budget\" )
                    VALUES ( $id , '$name' , '$coach' , '$captain' , $main_stadium , $budget ); 
                ";
            }
            return $query;
        }

        public function create_this_many_query_string_for_inserting_into_contract($how_many){

            $team_count = $this->find_how_many_rows_was_already_inserted_in('team');

            $id = $this->find_how_many_rows_was_already_inserted_in('contract');
            $player_id = $this->find_how_many_rows_was_already_inserted_in('contract');     
            $query = '';
            
            for ( $i = 0 ; $i < $how_many ; $i++ ){
                $id++;
                $player_id++;
                $team_id = rand( 1 , $team_count );
                $expiration_date = rand( 2019 , 2030 );
                
                $query .= "
                    INSERT INTO \"contract\" ( \"id\" , \"player-id\" , \"team-id\" , \"expiration-date\" )
                    VALUES ( $id , $player_id , $team_id , $expiration_date ); 
                ";
            }

            return $query;
        }

        public function create_this_many_query_string_for_inserting_into_referee($how_many){

            $id = $this->find_how_many_rows_was_already_inserted_in('referee');
            $query = '';

            for ( $i = 0 ; $i < $how_many ; $i++ ){
                $id++;
                $first_name = $this->remove_quotation_mark_of($this->faker->firstName('male'));
                $last_name = $this->remove_quotation_mark_of($this->faker->lastName);
                $age = rand( 23 , 50 );

                $query .= "
                    INSERT INTO \"referee\" ( \"id\" , \"first-name\" , \"last-name\" , \"age\" )
                    VALUES ( $id , '$first_name' , '$last_name' , $age ); 
                ";
            }
            return $query;
        }

        public function create_this_many_query_string_for_inserting_into_match($how_many){

            $id = $this->find_how_many_rows_was_already_inserted_in('match');
            $team_count = $this->find_how_many_rows_was_already_inserted_in('team');
            $referee_count = $this->find_how_many_rows_was_already_inserted_in('referee');
            $stadium_count = $this->find_how_many_rows_was_already_inserted_in('stadium');
            $query = '';

            for ( $i = 0 ; $i < $how_many ; $i++ ){
                $id++;
                $home_id = rand( 1 , $team_count );
                $away_id = rand( 1 , $team_count );
                $referee_id = rand( 1 , $referee_count );
                $stadium_id = rand( 1 , $stadium_count );
                $home_goals = rand( 0 , 5 );
                $away_goals = rand( 0 , 5 );
                $total_attendance = rand( 0 , 100*1000 );
                
                $query .= "
                    INSERT INTO \"match\" ( \"id\" , \"home-id\" ,
                     \"away-id\" , \"referee-id\" , \"stadium-id\" ,
                      \"home-goals\" , \"away-goals\", \"total-attendance\" )
                    VALUES ( $id , '$home_id' , '$away_id' , $referee_id ,
                    $stadium_id , $home_goals , $away_goals , $total_attendance ); 
                ";
            }
            return $query;
        }

        /*
            END OF creating query string SECTION
        */

        public function create_query_string_for_inserting_into($table , $how_many){
            switch ($table) {

                case 'stadium':
                    return $this->create_this_many_query_string_for_inserting_into_stadium($how_many);

                case 'player':
                    return $this->create_this_many_query_string_for_inserting_into_player($how_many);

                case 'team':
                    return $this->create_this_many_query_string_for_inserting_into_team($how_many);
                
                case 'contract':
                    return $this->create_this_many_query_string_for_inserting_into_contract($how_many);

                case 'referee':
                    return $this->create_this_many_query_string_for_inserting_into_referee($how_many);

                case 'match':
                    return $this->create_this_many_query_string_for_inserting_into_match($how_many);

                default:
                    return null;
            }
        }

        public function insert_fake_data_into( $table , $how_many ){
            $query = $this->create_query_string_for_inserting_into($table , $how_many);
            echo $query;
            $this->db->exec($query);
        }

        public function ininialize_database_with_fake_data($map){
            foreach ( $map as $table )
                $this->insert_fake_data_into( $table['table_name'] , $table['count'] );
        }

    }