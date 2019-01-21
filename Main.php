<?php
    require "tables.php";
    require "insert.php";

    $ali = new tables();
    $ali->drop_all_tables();
    $ali->create_all_tables();

    $arash = new insert();

    $map = [
        ['table_name' => 'player'   , 'count' => 300],
        ['table_name' => 'stadium'  , 'count' => 10],
        ['table_name' => 'team'     , 'count' => 18],
        ['table_name' => 'contract' , 'count' => 290],
        ['table_name' => 'referee'  , 'count' => 10],
        ['table_name' => 'match'    , 'count' => 250]
    ];

    $arash->ininialize_database_with_fake_data($map);

    //$arash->remove_all_data_from_table_player();







