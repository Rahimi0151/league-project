<?php
    require_once(realpath(dirname(__FILE__) . '/../view.php'));
    require_once(realpath(dirname(__FILE__) . '/../navbar.php'));
    require_once(realpath(dirname(__FILE__) . '/../includes.php'));

    class all_insert_forms{
        public static function retrive(){
            $navbar = new navbar();
            $navbar->create();

            echo '
            <form action = "/DATABASE%20PROJECT/the_hell_with_ajax/submit_inserted_player.php" method = "POST">
            Insert a new player 
                <div class="form-control" >
                    First Name:
                        <input class="form-control-plaintext" type = "text" name = "first-name" />
                    Last Name: 
                        <input class="form-control-plaintext" type = "text" name = "last-name" />
                    Price: 
                        <input class="form-control-plaintext" type = "text" name = "price" />
                    Age: 
                        <input class="form-control-plaintext" type = "text" name = "age" />
                    <input class="btn" type = "submit" />
                </div>
            </form>';
        }
    }

    all_insert_forms::retrive();















