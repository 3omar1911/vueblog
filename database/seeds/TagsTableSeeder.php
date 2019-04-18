<?php

use Illuminate\Database\Seeder;

use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$tags = ['sports', 'edu', 'medical'];

    	foreach($tags as $tag) {
    		Tag::firstOrCreate(['title' => $tag]);
    	}
    }
}
