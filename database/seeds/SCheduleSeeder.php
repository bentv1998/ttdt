<?php

use App\Models\Classes;
use App\Models\Schedule;
use Illuminate\Database\Seeder;

class SCheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schedule::create([
            'id' => 1,
            'name' => 'Lịch 1',
            'time' => '17:00:00',
            'day' => '["1","3","5"]',
        ]);
        Schedule::create([
            'id' => 2,
            'name' => 'Lịch 2',
            'time' => '18:30:00',
            'day' => '["1","3","5"]',
        ]);
        Schedule::create([
            'id' => 3,
            'name' => 'Lịch 3',
            'time' => '17:00:00',
            'day' => '["2","4","6"]',
        ]);
        Schedule::create([
            'id' => 4,
            'name' => 'Lịch 4',
            'time' => '18:30:00',
            'day' => '["2","4","6"]',
        ]);



        Classes::create([
            'code' => 'L00001',
            'name' => 'Lớp 1',
            'schedule_id' => 1,
            'teacher_id' => 1,
            'tuition' => 400000,
        ]);

        Classes::create([
            'code' => 'L00002',
            'name' => 'Lớp 2',
            'schedule_id' => 2,
            'teacher_id' => 1,
            'tuition' => 400000,
        ]);
    }
}
