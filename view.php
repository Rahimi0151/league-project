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
                    <th scope="col">age</th>
                    <th scope="col">price</th>
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
                        <td>"               .$player['price'].      "</td>
                    </tr>
                ";
            }
            echo '
                </tbody>
                </table>
            ';
        }

    
    
    
    
    
    
    
    
    

        
    }