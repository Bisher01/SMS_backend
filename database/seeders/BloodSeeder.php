<?php

namespace Database\Seeders;

use App\Models\Blood;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BloodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bloods')->delete();
         $bloods=['A+','A-','B+','B-','O+','O-','AB+','AB-'];
         foreach($bloods as $blood){
             Blood::create(['name'=>$blood]);
         }
        /* DB::table('admins')->insert([
             'email' => Str::random(10).'@gmail.com',
             'password' => Hash::make('password'),
         ]);*/
    }
}
