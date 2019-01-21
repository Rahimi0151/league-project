<?php
    require_once('model.php');
    require_once('database_connector.php');

    class view{

        public function create_table_for_players(){

            echo '
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Firstname</th>
                        <th scope="col">Lastname</th>
                        <th scope="col">Age</th>
                        <th scope="col">Team</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody>
            ';
            
            $model = new model();
            $players = $model->retrive_all_players();

            while ( $player = $players->fetch()){
                echo "
                    <tr>
                        <th scope=\"row\">" .$player['id'].         "</th>
                        <td>"               .$player['first-name']. "</td>
                        <td>"               .$player['last-name'].  "</td>
                        <td>"               .$player['age'].        "</td>
                        <td>"               .$player['team'].        "</td>
                        <td>"               .$player['price'].      "</td>
                    </tr>
                ";
            }
            echo '
                </tbody>
                </table>
            ';
        }

        public function create_table_for_teams(){
            echo '
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Team Name</th>
                        <th scope="col">Couch</th>
                        <th scope="col">Captain</th>
                        <th scope="col">Main Stadium</th>
                        <th scope="col">Budget</th>
                    </tr>
                </thead>
                <tbody>
            ';
            
            $model = new model();
            $teams = $model->retrive_all_teams();

            while ( $team = $teams->fetch()){
                echo "
                    <tr>
                        <th scope=\"row\">" .$team['id'].       "</th>
                        <td>"               .$team['name'].     "</td>
                        <td>"               .$team['coach'].    "</td>
                        <td>"               .$team['captain'].  "</td>
                        <td>"               .$team['stadium'].  "</td>
                        <td>"               .$team['budget'].   "</td>
                    </tr>
                ";
            }
            echo '
                </tbody>
                </table>
            ';
        }

        public function create_table_for_stadiums(){
            echo '
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Stadium Name</th>
                        <th scope="col">Capacity</th>
                        <th scope="col">Age</th>
                    </tr>
                </thead>
                <tbody>
            ';
            
            $model = new model();
            $stadiums = $model->retrive_all_stadiums();

            while ( $stadium = $stadiums->fetch()){
                echo "
                    <tr>
                        <th scope=\"row\">" .$stadium['id'].        "</th>
                        <td>"               .$stadium['name'].      "</td>
                        <td>"               .$stadium['capacity'].  "</td>
                        <td>"               .$stadium['age'].       "</td>
                    </tr>
                ";
            }
            echo '
                </tbody>
                </table>
            ';
        }
    
        public function create_table_for_matches(){
            echo '
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Home Team</th>
                        <th scope="col">Home Goals</th>
                        <th scope="col">Away Goals</th>
                        <th scope="col">Away Team</th>
                        <th scope="col">Referee Name</th>
                        <th scope="col">Stadium Name</th>
                        <th scope="col">Total Attendance</th>
                    </tr>
                </thead>
                <tbody>
            ';
            
            $model = new model();
            $matches = $model->retrive_all_matches();

            while ( $match = $matches->fetch()){
                echo "
                    <tr>
                        <th scope=\"row\">" .$match['id'].              "</th>
                        <td>"               .$match['home-team'].       "</td>
                        <td>"               .$match['home-goals'].      "</td>
                        <td>"               .$match['away-goals'].      "</td>
                        <td>"               .$match['away-team'].       "</td>
                        <td>"               .$match['referee'].         "</td>
                        <td>"               .$match['stadium'].         "</td>
                        <td>"               .$match['total-attendance']."</td>
                    </tr>
                ";
            }
            echo '
                </tbody>
                </table>
            ';
        }
    
    
    
    
    
    

        
    }