<?php
    require_once("tables.php");
    require_once("insert.php");



    $ali = new tables();
    $ali->drop_all_tables();
    $ali->create_all_tables();

    $arash = new insert();

    $map = [
        ['table_name' => 'player'   , 'count' => 20],
        ['table_name' => 'stadium'  , 'count' => 10],
        ['table_name' => 'team'     , 'count' => 10],
        ['table_name' => 'contract' , 'count' => 10],
        ['table_name' => 'referee'  , 'count' => 10],
        ['table_name' => 'match'    , 'count' => 10]
    ];

    $arash->ininialize_database_with_fake_data($map);

    //$arash->remove_all_data_from_table_player();

    setcookie( 'database_is_populated_flash' , 'yes' , time() + (1), "/");
    setcookie( 'database_is_populated' , 'yes' , time() + (86400), "/");
    header("Location: http://localhost/DATABASE%20PROJECT/ui.php", true, 301);
    exit();




