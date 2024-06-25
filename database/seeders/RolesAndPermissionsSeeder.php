<?php
namespace Database\Seeders;

use Faker\Factory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = range(1, 51);

        $faker = Factory::create();

        foreach ($count as $count) {

            $user = User::create([
                'name'          => $faker->name(),
                'middlename'          => $faker->name(),
                'surname'          => $faker->word,
                'email'         => $faker->email(),
                'password'      => bcrypt('12345678'),
                'created_at'    => date("Y-m-d H:i:s")
            ]);

            $user->student()->create([
                'department_id' => 6,
                'faculty_id' => 3,
                'locked' => 0,
                "program" => 'BSC',
                "level" => 1,
                "semester" => 1,
                "year_of_admission" => '2021/2022',
                "gender" => $faker->randomElement(["male", "female", "other"]),
            ]);


            $user->update([
                'matric' => app('App\Http\Controllers\Controller')->generateMatric($user),
                'password' => Hash::make(strtoupper($user->surname)),
            ]);

            $user->assignRole('Student');
        }


        // Reset cached roles and permissions
        // app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // // create permissions
        // $role = Role::create(['name' => 'Admin']);
        // $role = Role::create(['name' => 'Student']);
    }
}
