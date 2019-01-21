<?php
    require_once('view.php');
    require_once('navbar.php');

    class all_players{
        public static function retrive(){
            $navbar = new navbar();
            $navbar->create();

            $view = new view();
            $view->create_table_for_players();
        }
    }