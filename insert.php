<?php
    require_once 'vendor/autoload.php';

    class insert{

        public $faker;

        public function __construct(){
            $this->faker = Faker\Factory::create();
        }

        public function insert_fake_data_into_stadium(){
            echo $this->faker->name;
        }
    }


