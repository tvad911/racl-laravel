<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;

class AclUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            'login'      => 'anhduongphuong@gmail.com',
            'username'   => 'administrator',
            'name'       => 'Ánh Dương™',
            'email'      => 'anhduongphuong@gmail.com',
            'group_id'   => '0',
            'password'   => Hash::make('anhphong'),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        );

        // Uncomment the below to run the seeder
        DB::table('acl_users')->insert($users);

        $faker = Faker::create();
        foreach (range(1,100000) as $index) {
            DB::table('acl_users')->insert([
                    'login'      => $faker->email,
                    'username'   => $faker->name,
                    'name'       => $faker->name,
                    'group_id'   => '0',
                    'password'   => Hash::make('anhphong'),
                    'email'      => $faker->email,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                    'status'     => $faker->numberBetween(0,1)
            ]);
        }

    }
}