<?php


use App\Models\Mail;
use App\Models\ParentModel;
use App\Models\Teacher;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('123456'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'email_verified_at' => Carbon::now()
        ])->syncRoles('Admin');


        User::create([
            'id' => 2,
            'name' => 'Student',
            'email' => 'student@example.com',
            'password' => bcrypt('123456'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'email_verified_at' => Carbon::now()
        ])->syncRoles('Student');
        \App\Models\Student::create([
            'code' => 'HS00002',
            'name' => 'Lê Ý Nhi',
            'birth' => '02/02/2014',
            'parent_id' => 1,
        ]);


        User::create([
            'id' => 3,
            'name' => 'Parent',
            'email' => 'parent@example.com',
            'password' => bcrypt('123456'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'email_verified_at' => Carbon::now()
        ])->syncRoles('Parent');
        ParentModel::create([
            'code' => 'PH00003',
            'phone' => '1122334455',
            'email' => 'parent@example.com',
            'user_id' => 3,
        ]);


        User::create([
            'id' => 4,
            'name' => 'Teacher',
            'email' => 'teacher@example.com',
            'password' => bcrypt('123456'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'email_verified_at' => Carbon::now()
        ])->syncRoles('Teacher');
        Teacher::create([
            'code' => 1,
            'phone' => '123456789',
            'birth' => '13/09/1992',
            'user_id' => 4,
        ]);


        User::create([
            'id' => 5,
            'name' => 'Staff',
            'email' => 'staff@example.com',
            'password' => bcrypt('123456'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'email_verified_at' => Carbon::now()
        ])->syncRoles('Staff');


        Mail::create([
            'key' => 'Mail Báo Vắng',
            'header' => 'Thông Báo vắng',
            'body' => '### Thông Báo Vắng
                Chúng tôi xin phép thông tin đến quý phụ huynh rằng hôm hay bé {name} không tham gia buổi học tại trung tâm chúng tôi.'
        ]);

    }
}
