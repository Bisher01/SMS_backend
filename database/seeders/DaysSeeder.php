<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('days')->delete();

        Day::query()->create([
            'name' => 'السبت'
        ]);

        Day::query()->create([
            'name' => 'الاحد'
        ]);

        Day::query()->create([
            'name' => 'الاثنين'
        ]);

        Day::query()->create([
            'name' => 'الثلاثاء'
        ]);

        Day::query()->create([
            'name' => 'الاربعاء'
        ]);

        Day::query()->create([
            'name' => 'الخميس'
        ]);

        Day::query()->create([
            'name' => 'الجمعة'
        ]);


    }
}
