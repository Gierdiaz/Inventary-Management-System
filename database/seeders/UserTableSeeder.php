<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Inserir admin
        $adminId = DB::table('users')->insertGetId([
            'name'     => 'Állison',
            'email'    => 'allison@email.com',
            'password' => bcrypt('password'),
        ]);

        // Anexar papel de admin ao usuário
        DB::table('role_user')->insert([
            'role_id' => Role::where('name', 'admin')->value('id'),
            'user_id' => $adminId,
        ]);

        // Inserir usuário
        $userId = DB::table('users')->insertGetId([
            'name'     => 'José',
            'email'    => 'jose@email.com',
            'password' => bcrypt('password'),
        ]);

        // Anexar papel de usuário ao usuário
        DB::table('role_user')->insert([
            'role_id' => Role::where('name', 'user')->value('id'),
            'user_id' => $userId,
        ]);

        // Anexar perfil ao usuário
        DB::table('profile_users')->insert([
            'profile_id' => DB::table('profiles')->where('name', 'Manager')->value('id'),
            'user_id'    => $adminId,
        ]);
    }
}
