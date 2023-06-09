<?php

require_once('src/models/migrations/profs.php');
require_once('src/lib/database.php');

function createProfs() {
    try{
        $group_table = new Profs;
        $group_table->connection = new DatabaseConnection();
    
        $group_table->createTableProfs();
    } catch(Exception $e) {
        die('Error : '.$e);
    }
}