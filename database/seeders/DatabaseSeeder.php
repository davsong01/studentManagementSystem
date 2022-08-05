<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);

        // $user = User::create([
        //     'name'          => 'Admin',
        //     'middlename'          => 'Admin',
        //     'surname'          => 'Admin',
        //     'matric'          => '12345678',
        //     'email'         => 'admin@demo.com',
        //     'password'      => bcrypt('12345678'),
        //     'created_at'    => date("Y-m-d H:i:s")
        // ]);
        // $user->assignRole('Admin');

        // $user2 = User::create([
        //     'name'          => 'Teacher',
        //     'middlename'          => 'Teacher',
        //     'surname'          => 'Teacher',
        //     'email'         => 'teacher@demo.com',
        //     'password'      => bcrypt('12345678'),
        //     'created_at'    => date("Y-m-d H:i:s")
        // ]);
        // $user2->assignRole('Teacher');

        // $user3 = User::create([
        //     'name'          => 'Parent',
        //     'email'         => 'parent@demo.com',
        //     'password'      => bcrypt('12345678'),
        //     'created_at'    => date("Y-m-d H:i:s")
        // ]);
        // $user3->assignRole('Parent');
        for ($i=51; $i < 51; $i++) {
            $faker = Factory::create();

            DB::table("students")->insert([
                "name" => $faker->name(),
                "email" => $faker->safeEmail,
                "mobile" => $faker->phoneNumber,
                "age" => $faker->numberBetween(25, 50),
                "gender" => $faker->randomElement(["male", "female", "others"]),
                "address_info" => $faker->address,
            ]);
            $user = User::create([
                'name'          => $faker->name(),
                'middlename'          => $faker->name(),
                'surname'          => $faker->name(),
                'email'         => 'admin@demo.com',
                'password'      => bcrypt('12345678'),
                'created_at'    => date("Y-m-d H:i:s")
            ]);
            $user->update([
                'matric' => app('App\Http\Controllers\FunctionsController')->
            ])
            $user->assignRole('Student');
        } 
        
       


        // DB::table('teachers')->insert([
        //     [
        //         'user_id'           => $user2->id,
        //         'gender'            => 'male',
        //         'phone'             => '0123456789',
        //         'dateofbirth'       => '1993-04-11',
        //         'current_address'   => 'Dhaka-1215',
        //         'permanent_address' => 'Dhaka-1215',
        //         'created_at'        => date("Y-m-d H:i:s")
        //     ]
        // ]);

        // DB::table('parents')->insert([
        //     [
        //         'user_id'           => $user3->id,
        //         'gender'            => 'male',
        //         'phone'             => '0123456789',
        //         'current_address'   => 'Dhaka-1215',
        //         'permanent_address' => 'Dhaka-1215',
        //         'created_at'        => date("Y-m-d H:i:s")
        //     ]
        // ]);

        // DB::table('grades')->insert([
        //     'teacher_id'        => 1,
        //     'class_numeric'     => 1,
        //     'class_name'        => 'One',
        //     'class_description' => 'class one'
        // ]);

        // DB::table('students')->insert([
        //     [
        //         'user_id'           => $user4->id,
        //         'parent_id'         => 1,
        //         'class_id'          => 1,
        //         'roll_number'       => 1,
        //         'gender'            => 'male',
        //         'phone'             => '0123456789',
        //         'dateofbirth'       => '1993-04-11',
        //         'current_address'   => 'Dhaka-1215',
        //         'permanent_address' => 'Dhaka-1215',
        //         'created_at'        => date("Y-m-d H:i:s")
        //     ]
        // ]);

    }
}
