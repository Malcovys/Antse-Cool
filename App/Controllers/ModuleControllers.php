<?php

namespace App\Controllers;

use App\Lib\DatabaseConnection;
use App\Models\ModuleRepository;

class ModuleControllers
{
    public static function verifieModule($module_id) {
        $moduleRepository = new ModuleRepository;
        $moduleRepository->connection = new DatabaseConnection;

        if($moduleRepository->verifieModule(htmlspecialchars($module_id))) {
            return 1;
        } else {
            return 0;
        }
    }
}