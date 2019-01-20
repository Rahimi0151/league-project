<?php
    require "tables.php";
    require "insert.php";

    $ali = new tables();
    $ali->drop_all_tables();
    $ali->create_all_tables();

    $arash = new insert();

    $arash->ininialize_database_with_fake_data(0.001);

    //$arash->remove_all_data_from_table_player();







