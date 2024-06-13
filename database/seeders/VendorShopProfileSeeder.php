<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendorShopProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'vendor@gmail.com')->first();

        DB::table('vendors')->insert([
            [
                'name' => 'vendor shop',
                'banner' => 'uploads/123.jpg',
                'phone' => '123123',
                'email' => 'vendor@gmail.com',
                'address' => 'USA',
                'description' => 'Shop description',
                'user_id' => $user->id
            ],

        ]);
    }
}
