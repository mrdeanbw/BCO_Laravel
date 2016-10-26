<?php

use Illuminate\Database\Seeder;

class ChatterTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        
        // CREATE THE CATEGORIES

        \DB::table('chatter_categories')->delete();
        
        \DB::table('chatter_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent_id' => NULL,
                'order' => 1,
                'name' => 'Introductions',
                'color' => '#3498DB',
                'slug' => 'introductions',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'parent_id' => NULL,
                'order' => 2,
                'name' => 'General',
                'color' => '#2ECC71',
                'slug' => 'general',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'parent_id' => NULL,
                'order' => 3,
                'name' => 'Feedback',
                'color' => '#9B59B6',
                'slug' => 'feedback',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'parent_id' => NULL,
                'order' => 4,
                'name' => 'Random',
                'color' => '#E67E22',
                'slug' => 'random',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
     
        
        
    }
}
