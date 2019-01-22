<?php
    require_once(realpath(dirname(__FILE__) . '/../view.php'));
    require_once(realpath(dirname(__FILE__) . '/../navbar.php'));
    require_once(realpath(dirname(__FILE__) . '/../includes.php'));

    class all_insert_forms{

        public static function echo_form_for_inserting_a_new_player(){
            echo '
            <form action = "/DATABASE%20PROJECT/the_hell_with_ajax/submit_inserted_player.php" method = "POST">
            Insert a new player 
                <div class="col-md-5">
                    <div class="form-control" >
                        First Name:
                        <input class="form-control-plaintext" type = "text" name = "first-name" />
                        Last Name: 
                            <input class="form-control-plaintext" type = "text" name = "last-name" />
                        Price: 
                        <input class="form-control-plaintext" type = "text" name = "price" />
                        Age: 
                        <input class="form-control-plaintext" type = "text" name = "age" />
                        <input class="btn btn-primary" type = "submit" />
                    </div>
                </div>
            </form>';
        }

        public static function echo_form_for_searching_for_a_player(){
            echo '
            <form action = "/DATABASE%20PROJECT/the_hell_with_ajax/searched_players.php" method = "POST">
            Insert a new player 
                <div class="col-md-5">
                    <div class="form-control" >
                        First Name:
                        <input class="form-control-plaintext" type = "text" name = "first-name" />
                        Last Name: 
                            <input class="form-control-plaintext" type = "text" name = "last-name" />
                        Minimum Price: 
                            <input class="form-control-plaintext" type = "text" name = "min-price" />
                        Maximum Price: 
                            <input class="form-control-plaintext" type = "text" name = "max-price" />
                        Minimum Age: 
                            <input class="form-control-plaintext" type = "text" name = "min-age" />
                        Maximum Age: 
                            <input class="form-control-plaintext" type = "text" name = "max-age" />
                        Team Name: 
                            <input class="form-control-plaintext" type = "text" name = "team" />
                        <input class="btn btn-primary" type = "submit" />
                    </div>
                </div>
            </form>';
        }

        public static function retrive(){
            $navbar = new navbar();
            $navbar->create();

            all_insert_forms::echo_form_for_inserting_a_new_player();
            all_insert_forms::echo_form_for_searching_for_a_player();

            }
    }

    all_insert_forms::retrive();















