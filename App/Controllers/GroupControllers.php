<?php

namespace App\Controllers;

use App\Lib\DatabaseConnection;
use App\Models\GroupRepository;

class GroupControllers
{
    public static function verifieGroup($group_name) {
        $groupRepository = new GroupRepository;
        $groupRepository->connection = new DatabaseConnection;

        if($groupRepository->verifieGroup(htmlspecialchars($group_name))) {
            return 1;
        } else {
            return 0;
        }
    }
}