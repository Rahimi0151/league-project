<?php
    require_once(realpath(dirname(__FILE__) . '/../database_connector.php'));
    require_once(realpath(dirname(__FILE__) . '/../insert.php'));
    require_once(realpath(dirname(__FILE__) . '/../navbar.php'));
    require_once(realpath(dirname(__FILE__) . '/../includes.php'));

    class submit_inserted_player{

        public $db;
        public $insert;

        public function submit(){
            $this->db = database_connector::new_database_connection();
            $this->insert = new insert();

            $id = $this->insert->find_last_inserted_id_in('player') + 1;
            $first_name = $_POST['first-name'];
            $last_name = $_POST['last-name'];
            $price = $_POST['price'];
            $age = $_POST['age'];
            
            $query = "
                    INSERT INTO \"player\" ( \"id\" , \"first-name\" , \"last-name\" , \"age\" , \"price\" )
                    VALUES ( $id , '$first_name' , '$last_name' , $age , $price ); 
                ";
            $this->db->exec($query);
            echo "
                <div class=\"alert alert-info\">
                    The RAW Query ::: $query
                </div>
            ";

        }
        
    }
    $submit = new submit_inserted_player();
    $submit->submit();
    
    $navbar = new navbar();
    $navbar->create();

    echo '
        <div            
            style="text-align: center;"
        >
            <div 
                class="col-md-6 offset-md-3"
                style="text-align: center;"

            >
            
                <div class="alert alert-success">Player was sucsessfully inserted</div>
                <form action="/DATABASE%20PROJECT/the_hell_with_ajax/all_insert_forms.php">
                    <input 
                        class="btn btn-success"
                        type="submit" 
                        value="Go Back"
                    />
                </form>
            </div>
        </div>
    ';

    
