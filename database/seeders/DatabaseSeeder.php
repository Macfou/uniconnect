<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Creating a user with additional columns
        $user = User::factory()->create([
            'fname' => 'Jay Job',
            'lname' => 'Simp',
            'miname' => 'M',
            'org' => 'CCIS',
            'status' => 'student',
            'yearlevel' => 'fourth-year',
            'section' => 'BCsad',
            'email' => 'jay2@gmail.com', // Add the missing comma here
        ]);

        // Creating listings associated with the user
        Listing::factory(6)->create([
            'user_id' => $user->id
        ]);
    }
}
