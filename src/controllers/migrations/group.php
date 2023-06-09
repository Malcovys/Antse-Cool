<?php

require_once('src/models/migrations/goupes.php');
require_once('src/lib/database.php');

function createGroup() {
    try{
        $group_table = new Groupe;
        $group_table->connection = new DatabaseConnection();
    
        $group_table->createTableGroup();
    } catch(Exception $e) {
        die('Error : '.$e);
    }
}


