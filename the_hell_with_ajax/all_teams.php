<?php
    require_once('../view.php');
    require_once('../navbar.php');
    require_once('../includes.php');

    class all_players{
        public static function retrive(){
            $navbar = new navbar();
            $navbar->create();

            $view = new view();
            $view->create_table_for_teams();
        }
    }

    all_players::retrive();