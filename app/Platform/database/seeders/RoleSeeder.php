<?php

namespace App\Platform\Database\Seeders;

use App\Platform\Enums\RoleName;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $AdminRole = Role::create(['name' => RoleName::ADMIN->value]);
        $memberRole = Role::create(['name' => RoleName::MEMBER->value]);
    }
}
