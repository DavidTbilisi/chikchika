<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Following;
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
        // all seeders
        $this->call([
            UserSeeder::class,
            TweetsSeeder::class,
            CommentsSeeder::class,
            LikesSeeder::class,
            FollowingSeeder::class,
        ]);
    }
}
