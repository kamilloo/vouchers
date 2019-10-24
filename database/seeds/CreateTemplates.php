<?php

use Illuminate\Database\Seeder;

class CreateTemplates extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 5; $i++)
        {
//            \DB::table('templates')->truncate();
            \App\Models\Template::create([
                'title' => 'title'.$i,
                'slug' => 'title'.$i,
                'description' => 'title'.$i,
                'price' => 100,
                'thumbnail' => "/storage/templates/template-{$i}.png",
            ]);
        }
    }
}
