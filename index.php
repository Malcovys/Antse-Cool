<?php

require_once('src/controllers/migrations/group.php');
require_once('src/controllers/migrations/profs.php');


try{ 

    createProfs(); 
    echo 'Done';

} catch(Exception $e) {

    die('Error : '.$e);

}