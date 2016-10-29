<?php

use Illuminate\Database\Seeder;

class NewsItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('news_items')->delete();

        $data = array();
        foreach (range(0, 100) as $index) {
        	array_push($data, 	            
	            array (	                
	                'title' => $index.' Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
	                'user_id' => 1,
	                'pinned' => 0,
	                'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pharetra pharetra ultricies. Donec fermentum auctor lectus, eget pretium ipsum fringilla et. Praesent eu sodales ipsum, a viverra velit. Suspendisse enim metus, commodo ut felis sed, ultricies auctor arcu. Nunc ornare placerat lorem non sagittis. Phasellus sagittis velit id varius auctor. Donec vestibulum, enim et congue dictum, dolor urna consequat dui, vel cursus nunc tortor quis ligula.</p><p>Nunc id convallis diam. In molestie metus sed nisl interdum malesuada. Nunc aliquet turpis sed pulvinar elementum. Praesent interdum convallis elit, ac pulvinar justo bibendum sed. Fusce scelerisque nulla ac vulputate feugiat. Proin eu erat libero. Nam nec pellentesque sem. Aliquam erat volutpat. Sed ut augue diam. Pellentesque lorem sem, scelerisque eget felis sed, ultricies euismod neque.</p>',
	                'created_at' => (new \DateTime())->sub(new \DateInterval('PT'.rand(0, 100).'H')),
	                'updated_at' => NULL
	            ));
            
        }

        \DB::table('news_items')->insert($data);
    }
}
