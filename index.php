<?php

require_once('src/controllers/migrations/group.php');

try{ 

    createGroup(); 
    
} catch(Exception $e) {

    die('Error : '.$e);

}