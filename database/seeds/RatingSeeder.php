<?php

use Illuminate\Database\Seeder;
use App\Models\Rating;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rating::create([
            'rating' => 'E',
            'older_than' => 0,
            'private' => 0,
            'description' => 'Everyone'
        ]);
        
        Rating::create([
            'rating' => 'T',
            'older_than' => 13,
            'private' => 1,
            'description' => 'Older than 13 years old'
        ]);
        
        Rating::create([
            'rating' => 'M',
            'older_than' => 18,
            'private' => 1,
            'description' => 'Older than 18 years old'
        ]);
    }
}
