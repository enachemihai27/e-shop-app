<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminProfileSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'admin@gmail.com')->first();

        DB::table('vendors')->insert([
            [
                'name' => 'Admin user',
                'banner' => 'uploads/123.jpg',
                'phone' => '123123',
                'email' => 'admin@gmail.com',
                'address' => 'USA',
                'description' => 'Shop description',
                'user_id' => $user->id
            ],

        ]);
    }
}
