<?php
    require('includes.php');
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
        echo '
            we are ready to go!
        ';
    }
