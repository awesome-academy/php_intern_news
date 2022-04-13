<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::unguard();
        $admin = User::create([
            'name' => 'Nguyễn Ngọc Công',
            'username' => 'admin',
            'password' => '12345678',
            'email' => 'admin@email.com',
            'status' => User::ACTIVE,
            'is_admin' => true,
            'email_verified_at' => Carbon::now()->toDateTimeString(),
        ]);
        User::reguard();
    }
}
