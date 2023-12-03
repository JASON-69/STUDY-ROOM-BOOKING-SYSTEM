<?php

namespace App\Enums;

enum UserRolesEnum : int {
    case User = 0;
    case Admin = 1;

    public static function getRoleName(int $role_id): string {
        if($role_id == UserRolesEnum::User->value) {
            return "User";
        } else if($role_id == UserRolesEnum::Admin->value) {
            return "Admin";
        } else {
            return "Unknown";
        }
    }
}