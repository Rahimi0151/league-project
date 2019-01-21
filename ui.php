<?php
    require_once('includes.php');
    require_once('view.php');
    require_once('the_hell_with_ajax/all_players.php');

    session_start();

    if ( isset($_COOKIE['database_is_populated_flash'])){
        echo '
            <div class="container" style="text-align: center" >
                <div 
                    class="alert alert-success"
                    style="margin-top:100px"
                    >
                    You have successfully populated your database</div>
            </div>
        ';
    }
    if ( !isset($_COOKIE['database_is_populated']) ){
        echo '
            <div class="container" style="text-align: center" >
                <form action="main.php" method="post">
                    <input 
                    type="submit" 
                    class="btn btn-primary" 
                    name="someAction" 
                    style="margin-top: 100px" 
                    value="Populate DataBase With Dummy Data" />
                </form>
            </div>
        ';
    }
    else{
        //view::create_table_for_players();
        all_players::retrive();
        

        


       
}