<?php
    class database_connector{
        public static function new_database_connection(){            
            $host='localhost';
            $database = 'test';
            $username = 'postgres';
            $password = 'postgres';
            $dsn = "pgsql:host=$host;port=5433;dbname=$database;user=$username;password=$password";
            return new PDO($dsn);
        }
    }